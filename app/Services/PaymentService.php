<?php

namespace App\Services;

use App\Models\Transaction;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction as MidtransTransaction;

class PaymentService
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$clientKey = config('services.midtrans.client_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createSnapToken(Transaction $transaction): string
    {
        $itemDetails = [
            [
                'id'       => $transaction->package_id,
                'price'    => (int) $transaction->amount,
                'quantity' => 1,
                'name'     => $transaction->package?->name ?? 'Package'
            ]
        ];

        $customerDetails = [
            'first_name' => $transaction->first_name,
            'last_name'  => $transaction->last_name,
            'email'      => $transaction->email,
            'phone'      => $transaction->phone,
        ];

        $params = [
            'transaction_details' => [
                'order_id'     => 'TRX-' . $transaction->id . '-' . time(),
                'gross_amount' => (int) $transaction->amount,
            ],
            'item_details'      => $itemDetails,
            'customer_details'  => $customerDetails,
            'callbacks' => [
                'finish' => route('payment.finish'),
            ],
        ];

        return Snap::getSnapToken($params);
    }

    public function handleNotification(array $notification): ?Transaction
    {
        $orderId = $notification['order_id'] ?? null;
        if (!$orderId) return null;

        $parts = explode('-', $orderId);
        $transactionId = $parts[1] ?? null;
        if (!$transactionId) return null;

        $transaction = Transaction::find($transactionId);
        if (!$transaction) return null;

        $transactionId = $notification['transaction_id'] ?? null;
        $transactionStatus = $notification['transaction_status'] ?? null;
        $paymentType = $notification['payment_type'] ?? null;
        $fraudStatus = $notification['fraud_status'] ?? null;

        $transaction->midtrans_transaction_id = $transactionId;
        $transaction->midtrans_payment_type = $paymentType;
        $transaction->midtrans_raw_response = json_encode($notification);

        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            if ($fraudStatus == 'accept' || $fraudStatus == null) {
                $transaction->status = 'success';
                $transaction->midtrans_status = 'settlement';
            }
        } elseif ($transactionStatus == 'pending') {
            $transaction->status = 'pending';
            $transaction->midtrans_status = 'pending';
        } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire', 'failure'])) {
            $transaction->status = 'failed';
            $transaction->midtrans_status = $transactionStatus;
        }

        $transaction->save();
        return $transaction;
    }
}
