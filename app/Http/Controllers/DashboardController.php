<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Ticket;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (Gate::allows('admin')) {
            $stats = [
                'newOrders' => Transaction::count(),
                'revenues' => Transaction::where('status', 'success')->sum('amount'),
                'ticketsSold' => Ticket::count(),
            ];
            $packages = Package::all();
            return view('admin.dashboard', compact('stats', 'packages'));
        }

        $tickets = Ticket::with(['transaction.package'])
            ->whereHas('transaction', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();

        $transactions = Transaction::with(['package'])
            ->where('user_id', $user->id)->get();

        $stats = [
            'totalTickets' => $tickets->count(),
            'totalTransactions' => $transactions->count(),
            'totalSpending' => $transactions->where('status', 'success')->sum('amount'),
        ];

        return view('dashboard', compact('tickets', 'transactions', 'stats'));
    }
}
