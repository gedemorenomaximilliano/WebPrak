<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Transaction;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'package'])->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    public function userIndex()
    {
        $transactions = Transaction::with(['package'])
            ->where('user_id', Auth::id())
            ->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create(Package $package)
    {
        return view('transactions.create', compact('package'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'pax_count' => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'phone' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
        ]);

        $package = Package::findOrFail($request->package_id);

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'package_id' => $package->id,
            'pax_count' => $request->pax_count,
            'payment_method' => $request->payment_method,
            'phone' => $request->phone,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'status' => 'success',
            'amount' => $package->price * $request->pax_count,
            'travel_date' => now()->addDays(7),
        ]);

        Ticket::create([
            'ticket_code' => 'TKT-' . strtoupper(Str::random(8)),
            'transaction_id' => $transaction->id,
            'status' => 'active',
        ]);

        return redirect()->route('transactions.index')->with('status', 'Package booked successfully!');
    }
}
