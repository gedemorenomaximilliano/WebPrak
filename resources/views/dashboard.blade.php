<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Banyuwangi - Dashboard</title>
    <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>
<body class="font-[Montserrat] bg-[#121212] text-white min-h-screen overflow-hidden">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#7EA6C4] flex flex-col py-8 px-6 rounded-r-[3rem] z-10">
            <div class="mb-12">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="w-48">
                </a>
            </div>

            <nav class="flex-grow space-y-4">
                <button onclick="switchTab('dashboard')" id="tab-dashboard" class="nav-item active w-full flex items-center gap-4 px-6 py-3 rounded-2xl transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    <span class="font-semibold text-lg">Dashboard</span>
                </button>
                <button onclick="switchTab('tickets')" id="tab-tickets" class="nav-item w-full flex items-center gap-4 px-6 py-3 rounded-2xl transition-all duration-300 text-white/80 hover:bg-white/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    <span class="font-semibold text-lg">My Tickets</span>
                </button>
                <button onclick="switchTab('transactions')" id="tab-transactions" class="nav-item w-full flex items-center gap-4 px-6 py-3 rounded-2xl transition-all duration-300 text-white/80 hover:bg-white/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    <span class="font-semibold text-lg">Transaction</span>
                </button>
            </nav>

            <div class="mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-4 px-6 py-3 rounded-2xl transition-all duration-300 text-white/80 hover:bg-white/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span class="font-semibold text-lg">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow relative overflow-y-auto bg-dashboard">
            <!-- Top Bar -->
            <div class="flex justify-between items-center p-10">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center border-4 border-white/20">
                        <svg class="w-8 h-8 text-black" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    </div>
                    <span class="text-2xl font-bold">{{ Auth::user()->name }}</span>
                </div>
            </div>

            <!-- Views Container -->
            <div class="px-10 pb-10">
                <!-- Dashboard View -->
                <div id="view-dashboard" class="view active">
                    <div class="mb-10">
                        <h1 class="text-4xl font-bold mb-2">Hello {{ Auth::user()->name }} !</h1>
                        <p class="text-white/60 text-lg">Welcome Back and Explore The Sunrise of Java</p>
                    </div>
                    
                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                        <div class="glass-card rounded-[2.5rem] p-8 border border-white/10">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-blue-500/20 rounded-2xl flex items-center justify-center text-blue-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                </div>
                                <span class="text-white/60 font-semibold">Total Tickets</span>
                            </div>
                            <div class="text-4xl font-bold">{{ $stats['totalTickets'] }}</div>
                        </div>
                        
                        <div class="glass-card rounded-[2.5rem] p-8 border border-white/10">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-purple-500/20 rounded-2xl flex items-center justify-center text-purple-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                </div>
                                <span class="text-white/60 font-semibold">Transactions</span>
                            </div>
                            <div class="text-4xl font-bold">{{ $stats['totalTransactions'] }}</div>
                        </div>

                        <div class="glass-card rounded-[2.5rem] p-8 border border-white/10">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-green-500/20 rounded-2xl flex items-center justify-center text-green-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <span class="text-white/60 font-semibold">Total Spent</span>
                            </div>
                            <div class="text-4xl font-bold">Rp{{ number_format($stats['totalSpending'], 0, ',', '.') }}</div>
                        </div>
                    </div>

                    <!-- Recent Activity Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="glass-card rounded-[2.5rem] p-8 border border-white/10">
                            <div class="flex justify-between items-center mb-8">
                                <h2 class="text-2xl font-bold">Recent Tickets</h2>
                                <button onclick="switchTab('tickets')" class="text-[#7EA6C4] font-bold hover:underline">View All</button>
                            </div>
                            <div class="space-y-6">
                                @forelse($tickets->take(3) as $ticket)
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-4">
                                            <img src="{{ asset('images/' . $ticket->transaction->package->image) }}" class="w-12 h-12 rounded-xl object-cover">
                                            <div>
                                                <h4 class="font-bold">{{ $ticket->transaction->package->name }}</h4>
                                                <p class="text-xs text-white/40">{{ $ticket->transaction->travel_date }}</p>
                                            </div>
                                        </div>
                                        <span class="text-xs bg-green-500/10 text-green-400 px-3 py-1 rounded-full border border-green-500/20 font-bold uppercase">{{ $ticket->status }}</span>
                                    </div>
                                @empty
                                    <p class="text-white/40 italic">No tickets found.</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="glass-card rounded-[2.5rem] p-8 border border-white/10">
                            <h2 class="text-2xl font-bold mb-8">Latest Transactions</h2>
                            <div class="space-y-6">
                                @forelse($transactions->take(3) as $transaction)
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="font-bold">#TRX-{{ $transaction->id }}</h4>
                                            <p class="text-xs text-white/40">{{ $transaction->created_at->format('M d, Y') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-sm">IDR {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                                            <p class="text-[10px] {{ $transaction->status == 'success' ? 'text-green-400' : 'text-yellow-400' }} uppercase font-bold">{{ $transaction->status }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-white/40 italic">No transactions found.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tickets View -->
                <div id="view-tickets" class="view hidden">
                    <h1 class="text-4xl font-bold mb-10">My Tickets</h1>
                    @forelse($tickets as $ticket)
                        <div class="glass-card rounded-[2rem] p-8 border border-white/10 flex justify-between items-center mb-6">
                            <div class="flex items-center gap-8">
                                <img src="{{ asset('images/' . $ticket->transaction->package->image) }}" alt="Ticket" class="w-32 h-32 rounded-2xl object-cover">
                                <div>
                                    <h3 class="text-2xl font-bold mb-2">{{ $ticket->transaction->package->name }}</h3>
                                    <p class="text-white/60 mb-4">Date: {{ $ticket->transaction->travel_date }}</p>
                                    <span class="bg-green-500/20 text-green-400 px-4 py-1 rounded-full text-sm font-bold border border-green-500/30 uppercase">{{ $ticket->status }}</span>
                                </div>
                            </div>
                            <button onclick="showQRCode('{{ $ticket->ticket_code }}', '{{ $ticket->transaction->package->name }}')" class="bg-[#7EA6C4] text-white px-8 py-3 rounded-2xl font-bold hover:scale-105 transition">View QR Code</button>
                        </div>
                    @empty
                        <p class="text-white/60">You don't have any tickets yet.</p>
                    @endforelse
                </div>

                <!-- Transactions View -->
                <div id="view-transactions" class="view hidden">
                    <h1 class="text-4xl font-bold mb-10">Transaction History</h1>
                    <div class="glass-card rounded-[2rem] overflow-hidden border border-white/10">
                        <table class="w-full text-left">
                            <thead class="bg-white/5 border-b border-white/10">
                                <tr>
                                    <th class="p-6 font-bold">Transaction ID</th>
                                    <th class="p-6 font-bold">Package</th>
                                    <th class="p-6 font-bold">Date</th>
                                    <th class="p-6 font-bold">Amount</th>
                                    <th class="p-6 font-bold">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">
                                @forelse($transactions as $transaction)
                                    <tr class="hover:bg-white/5 transition">
                                        <td class="p-6">#TRX-{{ $transaction->id }}</td>
                                        <td class="p-6">{{ $transaction->package->name }}</td>
                                        <td class="p-6">{{ $transaction->created_at->format('M d, Y') }}</td>
                                        <td class="p-6">IDR {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                        <td class="p-6"><span class="{{ $transaction->status == 'success' ? 'text-green-400' : 'text-red-400' }} font-bold uppercase">{{ $transaction->status }}</span></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="p-6 text-center">No transactions found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- QR Code Modal -->
    <div id="qrModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-6 bg-black/60 backdrop-blur-md">
        <div class="glass-card max-w-md w-full rounded-[3rem] p-10 border border-white/20 flex flex-col items-center text-center animate-fade-up">
            <h2 id="qrModalTitle" class="text-3xl font-bold mb-2">Ticket QR</h2>
            <p id="qrModalDesc" class="text-white/60 mb-8 font-medium">Present this code at the meeting point</p>
            
            <div class="bg-white p-6 rounded-[2rem] shadow-2xl mb-8">
                <div id="qrcode"></div>
            </div>
            
            <p id="qrCodeText" class="text-sm font-black tracking-widest text-[#7EA6C4] mb-10 uppercase">TKT-LOADING</p>
            
            <button onclick="hideQRCode()" class="w-full bg-white text-black py-4 rounded-2xl font-bold hover:bg-white/80 transition">Close</button>
        </div>
    </div>

    <script>
        let qrCodeInstance = null;

        function showQRCode(code, packageName) {
            document.getElementById('qrModalTitle').textContent = packageName;
            document.getElementById('qrCodeText').textContent = code;
            
            const qrContainer = document.getElementById('qrcode');
            qrContainer.innerHTML = ''; // Clear previous
            
            qrCodeInstance = new QRCode(qrContainer, {
                text: code,
                width: 200,
                height: 200,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });

            const modal = document.getElementById('qrModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function hideQRCode() {
            const modal = document.getElementById('qrModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function switchTab(tabId) {
            document.querySelectorAll('.view').forEach(v => v.classList.add('hidden'));
            document.querySelectorAll('.view').forEach(v => v.classList.remove('active'));
            document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active', 'bg-white/20'));
            
            document.getElementById('view-' + tabId).classList.remove('hidden');
            document.getElementById('view-' + tabId).classList.add('active');
            document.getElementById('tab-' + tabId).classList.add('active', 'bg-white/20');
        }

        // Handle URL fragments
        window.addEventListener('load', () => {
            if (window.location.hash === '#view-tickets') {
                setTimeout(() => switchTab('tickets'), 100);
            }
        });
    </script>
</body>
</html>
