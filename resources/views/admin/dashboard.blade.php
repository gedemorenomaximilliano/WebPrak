<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Banyuwangi - Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('base.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-dashboard.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-[Montserrat] bg-[#121212] text-white min-h-screen overflow-hidden">
    <div class="flex h-screen">
        @include('layouts.admin_sidebar')
        <main class="flex-grow relative overflow-y-auto">
            <!-- Header -->
            <div class="flex justify-between items-center p-8 pb-0">
                <div class="flex items-center gap-6">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 text-white/50 hover:text-white transition px-4 py-2 rounded-2xl hover:bg-white/5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span class="text-sm font-semibold">Home</span>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold">Dashboard</h1>
                        <p class="text-white/50 mt-1">Welcome back, {{ Auth::user()->name }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center border-2 border-white/20">
                        <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
            </div>

            <div class="p-8 pt-6 space-y-8">

                {{-- ── Stat Cards ── --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
                    <div class="glass-card p-6 rounded-[2rem] border border-white/10 flex flex-col gap-2">
                        <div class="flex items-center gap-3">
                            <svg class="w-7 h-7 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <span class="text-sm font-semibold text-white/60 uppercase tracking-wider">Orders</span>
                        </div>
                        <p class="text-3xl font-black">{{ $stats['totalOrders'] }}</p>
                    </div>
                    <div class="glass-card p-6 rounded-[2rem] border border-white/10 flex flex-col gap-2">
                        <div class="flex items-center gap-3">
                            <svg class="w-7 h-7 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-sm font-semibold text-white/60 uppercase tracking-wider">Revenue</span>
                        </div>
                        <p class="text-3xl font-black">Rp {{ number_format($stats['revenues'], 0, ',', '.') }}</p>
                    </div>
                    <div class="glass-card p-6 rounded-[2rem] border border-white/10 flex flex-col gap-2">
                        <div class="flex items-center gap-3">
                            <svg class="w-7 h-7 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                            <span class="text-sm font-semibold text-white/60 uppercase tracking-wider">Tickets</span>
                        </div>
                        <p class="text-3xl font-black">{{ $stats['ticketsSold'] }}</p>
                    </div>
                    <div class="glass-card p-6 rounded-[2rem] border border-white/10 flex flex-col gap-2">
                        <div class="flex items-center gap-3">
                            <svg class="w-7 h-7 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="text-sm font-semibold text-white/60 uppercase tracking-wider">Customers</span>
                        </div>
                        <p class="text-3xl font-black">{{ $stats['totalUsers'] }}</p>
                    </div>
                    <div class="glass-card p-6 rounded-[2rem] border border-white/10 flex flex-col gap-2">
                        <div class="flex items-center gap-3">
                            <svg class="w-7 h-7 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-sm font-semibold text-white/60 uppercase tracking-wider">Pending</span>
                        </div>
                        <p class="text-3xl font-black text-yellow-400">{{ $stats['pendingOrders'] }}</p>
                    </div>
                    <div class="glass-card p-6 rounded-[2rem] border border-white/10 flex flex-col gap-2">
                        <div class="flex items-center gap-3">
                            <svg class="w-7 h-7 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            <span class="text-sm font-semibold text-white/60 uppercase tracking-wider">This Month</span>
                        </div>
                        <p class="text-3xl font-black">Rp {{ number_format($stats['monthlyRevenue'], 0, ',', '.') }}</p>
                    </div>
                </div>

                {{-- ── Charts Row 1 ── --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {{-- Revenue Trend --}}
                    <div class="glass-card p-8 rounded-[2rem] border border-white/10">
                        <h3 class="text-xl font-bold mb-6">Revenue Trend</h3>
                        <canvas id="revenueChart" height="280"></canvas>
                    </div>
                    {{-- Order Status --}}
                    <div class="glass-card p-8 rounded-[2rem] border border-white/10">
                        <h3 class="text-xl font-bold mb-6">Order Status</h3>
                        <div class="flex justify-center" style="max-width: 340px; margin: 0 auto;">
                            <canvas id="statusChart" height="280"></canvas>
                        </div>
                    </div>
                </div>

                {{-- ── Charts Row 2 ── --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {{-- Users by Month --}}
                    <div class="glass-card p-8 rounded-[2rem] border border-white/10">
                        <h3 class="text-xl font-bold mb-6">User Registrations</h3>
                        <canvas id="usersChart" height="220"></canvas>
                    </div>
                    {{-- Top Packages --}}
                    <div class="glass-card p-8 rounded-[2rem] border border-white/10">
                        <h3 class="text-xl font-bold mb-6">Top Packages</h3>
                        <canvas id="packagesChart" height="220"></canvas>
                    </div>
                </div>

                {{-- ── Tables Row ── --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {{-- Recent Customers --}}
                    <div class="glass-card rounded-[2rem] border border-white/10 overflow-hidden">
                        <div class="p-6 pb-4 flex justify-between items-center">
                            <h3 class="text-xl font-bold">Recent Customers</h3>
                            <span class="text-sm text-white/50">+{{ $stats['newUsersThisMonth'] }} this month</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-white/5 border-y border-white/10">
                                    <tr>
                                        <th class="px-6 py-3 text-xs font-bold text-white/50 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-xs font-bold text-white/50 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-3 text-xs font-bold text-white/50 uppercase tracking-wider">Joined</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/10">
                                    @forelse($recentUsers as $u)
                                        <tr class="hover:bg-white/5 transition">
                                            <td class="px-6 py-4 font-semibold">{{ $u->name }}</td>
                                            <td class="px-6 py-4 text-white/70">{{ $u->email }}</td>
                                            <td class="px-6 py-4 text-white/50 text-sm">{{ $u->created_at->format('M d, Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="3" class="px-6 py-8 text-center text-white/30">No users yet.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Recent Transactions --}}
                    <div class="glass-card rounded-[2rem] border border-white/10 overflow-hidden">
                        <div class="p-6 pb-4 flex justify-between items-center">
                            <h3 class="text-xl font-bold">Recent Transactions</h3>
                            <a href="{{ route('admin.transactions.index') }}" class="text-sm text-[#7EA6C4] hover:underline">View all</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-white/5 border-y border-white/10">
                                    <tr>
                                        <th class="px-6 py-3 text-xs font-bold text-white/50 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 text-xs font-bold text-white/50 uppercase tracking-wider">Customer</th>
                                        <th class="px-6 py-3 text-xs font-bold text-white/50 uppercase tracking-wider">Package</th>
                                        <th class="px-6 py-3 text-xs font-bold text-white/50 uppercase tracking-wider">Amount</th>
                                        <th class="px-6 py-3 text-xs font-bold text-white/50 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/10">
                                    @forelse($recentTransactions as $t)
                                        <tr class="hover:bg-white/5 transition">
                                            <td class="px-6 py-4 text-sm text-white/70">#TRX-{{ $t->id }}</td>
                                            <td class="px-6 py-4 font-semibold">{{ $t->user?->name ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 text-white/70">{{ $t->package?->name ?? 'Deleted' }}</td>
                                            <td class="px-6 py-4">Rp {{ number_format($t->amount, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4">
                                                <span class="text-xs font-bold uppercase px-3 py-1 rounded-full {{ $t->status === 'success' ? 'bg-green-500/20 text-green-400' : ($t->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-red-500/20 text-red-400') }}">
                                                    {{ $t->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="px-6 py-8 text-center text-white/30">No transactions yet.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    {{-- ── Chart.js Init ── --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const col = '#7EA6C4';
            const colGrid = (a) => `rgba(126, 166, 196, ${a})`;

            // ── Revenue Trend ──
            const revCtx = document.getElementById('revenueChart')?.getContext('2d');
            if (revCtx) {
                const revLabels = @json($revenueByMonth->keys());
                const revData   = @json($revenueByMonth->values());
                new Chart(revCtx, {
                    type: 'line',
                    data: {
                        labels: revLabels,
                        datasets: [{
                            label: 'Revenue (Rp)',
                            data: revData,
                            borderColor: col,
                            backgroundColor: colGrid(0.15),
                            borderWidth: 2,
                            fill: true,
                            tension: 0.35,
                            pointRadius: 4,
                            pointBackgroundColor: col,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false },
                        },
                        scales: {
                            x: {
                                ticks: { color: 'rgba(255,255,255,0.5)' },
                                grid: { color: 'rgba(255,255,255,0.05)' },
                            },
                            y: {
                                ticks: {
                                    color: 'rgba(255,255,255,0.5)',
                                    callback: v => 'Rp ' + (v / 1000).toFixed(0) + 'k'
                                },
                                grid: { color: 'rgba(255,255,255,0.05)' },
                            }
                        },
                        color: 'rgba(255,255,255,0.7)',
                    }
                });
            }

            // ── Order Status Doughnut ──
            const statCtx = document.getElementById('statusChart')?.getContext('2d');
            if (statCtx) {
                const labels = @json($statusBreakdown->keys());
                const data   = @json($statusBreakdown->values());
                const colors = {
                    success: '#22c55e',
                    pending: '#eab308',
                    failed:  '#ef4444',
                    cancelled: '#6b7280',
                };
                new Chart(statCtx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: labels.map(l => colors[l] || col),
                            borderWidth: 0,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { color: 'rgba(255,255,255,0.7)', padding: 16 }
                            }
                        },
                        cutout: '55%',
                    }
                });
            }

            // ── Users by Month ──
            const usrCtx = document.getElementById('usersChart')?.getContext('2d');
            if (usrCtx) {
                const labels = @json($usersByMonth->keys());
                const data   = @json($usersByMonth->values());
                new Chart(usrCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'New Users',
                            data: data,
                            backgroundColor: colGrid(0.7),
                            borderColor: col,
                            borderWidth: 1,
                            borderRadius: 4,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false },
                        },
                        scales: {
                            x: {
                                ticks: { color: 'rgba(255,255,255,0.5)' },
                                grid: { display: false },
                            },
                            y: {
                                ticks: { color: 'rgba(255,255,255,0.5)', stepSize: 1 },
                                grid: { color: 'rgba(255,255,255,0.05)' },
                            }
                        },
                        color: 'rgba(255,255,255,0.7)',
                    }
                });
            }

            // ── Top Packages ──
            const pkgCtx = document.getElementById('packagesChart')?.getContext('2d');
            if (pkgCtx) {
                const pkgs = @json($topPackages);
                const labels = pkgs.map(p => p.name);
                const data   = pkgs.map(p => p.count);
                new Chart(pkgCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Bookings',
                            data: data,
                            backgroundColor: [colGrid(0.8), colGrid(0.6), colGrid(0.5), colGrid(0.4), colGrid(0.3)],
                            borderColor: col,
                            borderWidth: 1,
                            borderRadius: 4,
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        plugins: {
                            legend: { display: false },
                        },
                        scales: {
                            x: {
                                ticks: { color: 'rgba(255,255,255,0.5)', stepSize: 1 },
                                grid: { color: 'rgba(255,255,255,0.05)' },
                            },
                            y: {
                                ticks: { color: 'rgba(255,255,255,0.7)' },
                                grid: { display: false },
                            }
                        },
                        color: 'rgba(255,255,255,0.7)',
                    }
                });
            }
        });
    </script>

</body>
</html>
