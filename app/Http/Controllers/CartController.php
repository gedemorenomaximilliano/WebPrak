<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\Ticket;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        $cartItems = CartItem::with('package')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum(fn($item) => $item->package->price * $item->quantity);

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function checkout()
    {
        $user = Auth::user();

        if (!$user->isProfileComplete()) {
            return redirect()->route('profile.edit')
                ->with('error', 'Please complete your profile (phone and address) before checking out.');
        }

        $cartItems = CartItem::with('package')
            ->where('user_id', $user->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(fn($item) => $item->package->price * $item->quantity);
        $tax = $total * 0.1;
        $grandTotal = $total + $tax;

        return view('cart.checkout', compact('cartItems', 'total', 'tax', 'grandTotal'));
    }

    public function processCheckout(Request $request)
    {
        $user = Auth::user();

        if (!$user->isProfileComplete()) {
            return redirect()->route('profile.edit')
                ->with('error', 'Please complete your profile before checking out.');
        }

        $request->validate([
            'payment_method' => 'required|in:BCA,Mandiri,E-Wallet,BRIVA',
            'phone' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'travel_date' => 'nullable|date|after:today',
        ]);

        $cartItems = CartItem::with('package')
            ->where('user_id', $user->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $totalAmount = $cartItems->sum(fn($item) => ($item->package->price * $item->quantity) * 1.1);
        $packageNames = $cartItems->pluck('package.name')->implode(', ');

        $transaction = Transaction::create([
            'user_id'        => $user->id,
            'package_id'     => $cartItems->first()->package_id,
            'pax_count'      => $cartItems->sum('quantity'),
            'payment_method' => $request->payment_method,
            'phone'          => $request->phone,
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'email'          => $request->email,
            'status'         => 'pending',
            'amount'         => (int) $totalAmount,
            'travel_date'    => $request->travel_date ?? now()->addDays(7),
        ]);

        foreach ($cartItems as $cartItem) {
            Ticket::createWithRetry([
                'ticket_code'    => 'TKT-' . strtoupper(Str::random(8)),
                'transaction_id' => $transaction->id,
                'status'         => 'active',
            ]);
        }

        CartItem::where('user_id', $user->id)->delete();

        // Generate Midtrans Snap token
        try {
            $snapToken = $this->paymentService->createSnapToken($transaction);
            session(['snap_token' => $snapToken, 'pending_transaction_id' => $transaction->id]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'snap_token' => $snapToken,
                    'transaction_id' => $transaction->id,
                    'redirect_url' => route('payment.finish', [
                        'order_id' => 'TRX-' . $transaction->id . '-' . time(),
                    ]),
                ]);
            }

            return redirect()->route('payment.finish', [
                'order_id' => 'TRX-' . $transaction->id . '-' . time(),
                'snap_token' => $snapToken,
            ]);
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
            return redirect()->route('payment.pending', $transaction)
                ->with('error', 'Order created. Please complete payment via your dashboard.');
        }
    }

    public function add(Request $request, Package $package)
    {
        $user = Auth::user();
        if (!$user) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Please login first.'], 401);
            }
            return redirect()->route('login');
        }

        $cartItem = CartItem::where('user_id', $user->id)
            ->where('package_id', $package->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'user_id'    => $user->id,
                'package_id' => $package->id,
                'quantity'   => 1,
            ]);
        }

        $count = CartItem::where('user_id', $user->id)->count();

        if ($request->ajax()) {
            return response()->json([
                'success'   => true,
                'message'   => 'Package added to cart successfully!',
                'cartCount' => $count,
            ]);
        }

        return redirect()->back()->with('success', 'Package added to cart successfully!');
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            CartItem::where('user_id', Auth::id())
                ->where('package_id', $request->id)
                ->delete();

            session()->flash('success', 'Package removed successfully');
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            CartItem::where('user_id', Auth::id())
                ->where('package_id', $request->id)
                ->update(['quantity' => $request->quantity]);

            session()->flash('success', 'Cart updated successfully');
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }
}
