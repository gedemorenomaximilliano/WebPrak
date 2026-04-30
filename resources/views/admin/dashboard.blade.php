<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Banyuwangi - Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('base.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-dashboard.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-[Montserrat] bg-[#121212] text-white min-h-screen overflow-hidden">
    <div class="flex h-screen">
        @include('layouts.admin_sidebar')
        <main class="flex-grow relative overflow-y-auto">
            <!-- Header -->
            <div class="flex justify-between items-center p-10">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-yellow-400 rounded-full flex items-center justify-center border-4 border-white/20">
                        <svg class="w-8 h-8 text-black" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    </div>
                    <span class="text-2xl font-bold">{{ Auth::user()->name }}</span>
                </div>
            </div>

            <div class="px-10 pb-10">
                <div id="stats-container" class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div class="glass-card p-8 rounded-[2rem] border border-white/10 flex flex-col gap-4">
                        <div class="flex items-center gap-4">
                            <svg class="w-10 h-10 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <h3 class="text-xl font-bold">New Orders</h3>
                        </div>
                        <p class="text-5xl font-black">{{ $stats['newOrders'] }}</p>
                    </div>
                    <div class="glass-card p-8 rounded-[2rem] border border-white/10 flex flex-col gap-4">
                        <div class="flex items-center gap-4">
                            <svg class="w-10 h-10 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            <h3 class="text-xl font-bold">Revenues</h3>
                        </div>
                        <p class="text-5xl font-black">Rp. {{ number_format($stats['revenues'], 0, ',', '.') }}</p>
                    </div>
                    <div class="glass-card p-8 rounded-[2rem] border border-white/10 flex flex-col gap-4">
                        <div class="flex items-center gap-4">
                            <svg class="w-10 h-10 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                            <h3 class="text-xl font-bold">Tickets Sold</h3>
                        </div>
                        <p class="text-5xl font-black">{{ $stats['ticketsSold'] }}</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
