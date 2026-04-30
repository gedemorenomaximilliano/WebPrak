<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Transaction;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.checkout', compact('cart', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'phone' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        foreach ($cart as $id => $details) {
            $package = Package::find($id);
            if (!$package) continue;

            $amount = $details['price'] * $details['quantity'];
            $tax = $amount * 0.1;
            $total_amount = $amount + $tax;

            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'package_id' => $id,
                'pax_count' => $details['quantity'],
                'payment_method' => $request->payment_method,
                'phone' => $request->phone,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'status' => 'success',
                'amount' => $total_amount,
                'travel_date' => now()->addDays(7),
            ]);

            Ticket::create([
                'ticket_code' => 'TKT-' . strtoupper(Str::random(8)),
                'transaction_id' => $transaction->id,
                'status' => 'active',
            ]);
        }

        session()->forget('cart');

        return redirect()->route('transactions.index')->with('status', 'Checkout successful! Your bookings have been confirmed.');
    }

    public function add(Request $request, Package $package)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$package->id])) {
            $cart[$package->id]['quantity']++;
        } else {
            $cart[$package->id] = [
                "name" => $package->name,
                "quantity" => 1,
                "price" => $package->price,
                "image" => $package->image,
                "destination" => $package->destination
            ];
        }

        session()->put('cart', $cart);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Package added to cart successfully!',
                'cartCount' => count($cart)
            ]);
        }

        return redirect()->back()->with('success', 'Package added to cart successfully!');
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Package removed successfully');
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                $cart[$request->id]["quantity"] = $request->quantity;
                session()->put('cart', $cart);
                session()->flash('success', 'Cart updated successfully');
                return response()->json(['success' => true]);
            }
        }
        return response()->json(['success' => false], 400);
    }
}
