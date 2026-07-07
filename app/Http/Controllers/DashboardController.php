<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Ticket;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (Gate::allows('admin')) {
            $now = now();

            $stats = [
                'totalOrders'       => Transaction::count(),
                'revenues'          => Transaction::where('status', 'success')->sum('amount'),
                'ticketsSold'       => Ticket::count(),
                'totalUsers'        => User::count(),
                'pendingOrders'     => Transaction::where('status', 'pending')->count(),
                'monthlyRevenue'    => Transaction::where('status', 'success')
                    ->whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year)
                    ->sum('amount'),
                'newUsersThisMonth' => User::whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year)
                    ->count(),
            ];

            // Revenue by month (last 12 months)
            $revenueByMonth = Transaction::where('status', 'success')
                ->where('created_at', '>=', $now->copy()->subMonths(12))
                ->get()
                ->groupBy(fn($t) => $t->created_at->format('Y-m'))
                ->map(fn($g) => $g->sum('amount'));

            // Orders by month (last 12 months)
            $ordersByMonth = Transaction::where('created_at', '>=', $now->copy()->subMonths(12))
                ->get()
                ->groupBy(fn($t) => $t->created_at->format('Y-m'))
                ->map(fn($g) => $g->count());

            // Status breakdown
            $statusBreakdown = Transaction::get()
                ->groupBy('status')
                ->map(fn($g) => $g->count());

            // Top packages by bookings
            $topPackages = Transaction::with('package:id,name')
                ->get()
                ->groupBy('package_id')
                ->map(fn($g) => [
                    'name'  => $g->first()->package?->name ?? 'Deleted',
                    'count' => $g->count(),
                ])
                ->sortByDesc('count')
                ->take(5)
                ->values();

            // Users registered by month
            $usersByMonth = User::where('created_at', '>=', $now->copy()->subMonths(12))
                ->get()
                ->groupBy(fn($u) => $u->created_at->format('Y-m'))
                ->map(fn($g) => $g->count());

            // Recent users
            $recentUsers = User::latest()->take(5)->get(['id', 'name', 'email', 'created_at']);

            // Recent transactions
            $recentTransactions = Transaction::with(['user:id,name', 'package:id,name'])
                ->latest()
                ->take(5)
                ->get();

            $packages = Package::all();

            return view('admin.dashboard', compact(
                'stats',
                'packages',
                'revenueByMonth',
                'ordersByMonth',
                'statusBreakdown',
                'topPackages',
                'usersByMonth',
                'recentUsers',
                'recentTransactions',
            ));
        }

        $tickets = Ticket::with(['transaction.package'])
            ->whereHas('transaction', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();

        $transactions = Transaction::with(['package'])
            ->where('user_id', $user->id)->get();

        $stats = [
            'totalTickets'       => $tickets->count(),
            'totalTransactions'  => $transactions->count(),
            'totalSpending'      => $transactions->where('status', 'success')->sum('amount'),
        ];

        $profileComplete = $user->isProfileComplete();

        return view('dashboard', compact('tickets', 'transactions', 'stats', 'profileComplete'));
    }
}
