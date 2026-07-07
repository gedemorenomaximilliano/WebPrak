<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function snapToken(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        try {
            $token = $this->paymentService->createSnapToken($transaction);
            return response()->json(['snap_token' => $token]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
    {
        $notification = $request->all();
        $this->paymentService->handleNotification($notification);
        return response()->json(['status' => 'ok']);
    }

    public function finish(Request $request)
    {
        $orderId = $request->order_id;
        $parts = explode('-', $orderId);
        $transactionId = $parts[1] ?? null;

        if ($transactionId) {
            $transaction = Transaction::find($transactionId);
            if ($transaction && $transaction->status === 'success') {
                return redirect()->route('payment.success', $transaction);
            }
            return redirect()->route('payment.pending', $transaction ?? $transactionId);
        }

        return redirect()->route('home');
    }

    public function success(Transaction $transaction)
    {
        return view('payment.success', compact('transaction'));
    }

    public function pending(Transaction $transaction)
    {
        return view('payment.pending', compact('transaction'));
    }
}
