<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Banyuwangi - Transaction</title>
    <link rel="stylesheet" href="{{ asset('style4.css') }}">
    <link rel="stylesheet" href="{{ asset('base.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-[Montserrat] bg-[#1a3a4a] text-white min-h-screen overflow-x-hidden">
    <!--Navigation Bar-->
    <header class="w-full flex justify-center py-6 relative z-[60]"> 
        <nav class="flex justify-between items-center w-[92%] py-2 border-b-2 z-50 border-white/30">
            <div class="w-[387px]">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Logo.png') }}" alt="Logo">
                </a>
            </div>
            <ul class="flex items-center gap-[6vw] font-bold text-xl text-white">
                <li><a href="{{ route('home') }}" class="hover:text-white/70 transition">Home</a></li>
                <li><a href="{{ route('packages.index') }}" class="hover:text-white/70 transition">Packages</a></li>
                <li><a href="{{ route('home') }}#explore" class="hover:text-white/70 transition">Explore</a></li>
                <li><a href="{{ route('home') }}#about" class="hover:text-white/70 transition">About</a></li>
            </ul>
            
            <div id="auth-container" class="w-[200px] flex justify-end">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-white font-bold text-xl text-black rounded-full px-6 py-2">Dashboard</a>
                @else
                    <div class="p-[2px] rounded-full" style="background: linear-gradient(to right, #4CB7FF, #FFFFFF, #EFEB6C)">
                        <button onclick="location.href='{{ route('login') }}'" class="bg-white font-bold text-xl text-black rounded-full w-[182px] h-[48px] cursor-pointer transform hover:scale-110 duration-300">
                            Get Started
                        </button>
                    </div>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Main Transaction Screen -->
    <div id="transaction-screen" class="min-h-[calc(100vh-100px)] flex items-center justify-center p-6 transition-all duration-500">
        <div class="w-full max-w-6xl glass-card rounded-[3rem] p-12 bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl">
            <h1 class="text-4xl font-extrabold mb-10">My Transaction History</h1>

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
                                <td class="p-6 font-semibold">{{ $transaction->package->name }}</td>
                                <td class="p-6">{{ $transaction->created_at->format('M d, Y') }}</td>
                                <td class="p-6">IDR {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                <td class="p-6"><span class="{{ $transaction->status == 'success' ? 'text-green-400' : 'text-red-400' }} font-bold uppercase">{{ $transaction->status }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="p-6 text-center text-white/50">No transactions found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
