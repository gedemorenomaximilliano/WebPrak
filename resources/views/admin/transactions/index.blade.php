<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Banyuwangi - Transactions</title>
    <link rel="stylesheet" href="{{ asset('base.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-dashboard.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-[Montserrat] bg-[#121212] text-white min-h-screen overflow-hidden">
    <div class="flex h-screen">
        @include('layouts.admin_sidebar')
        <main class="flex-grow relative overflow-y-auto p-10">
            <h1 class="text-4xl font-bold mb-10">Transaction History</h1>
            <div class="glass-card rounded-[2rem] overflow-hidden border border-white/10">
                <table class="w-full text-left">
                    <thead class="bg-white/5 border-b border-white/10">
                        <tr>
                            <th class="p-6 font-bold">Transaction ID</th>
                            <th class="p-6 font-bold">User</th>
                            <th class="p-6 font-bold">Package</th>
                            <th class="p-6 font-bold">Date</th>
                            <th class="p-6 font-bold">Amount</th>
                            <th class="p-6 font-bold">Status</th>
                        </tr>
                    </thead>
                    <tbody id="transaction-list" class="divide-y divide-white/10">
                        @forelse($transactions as $transaction)
                            <tr class="hover:bg-white/5 transition">
                                <td class="p-6">#TRX-{{ $transaction->id }}</td>
                                <td class="p-6 font-semibold">{{ $transaction->user->name }}</td>
                                <td class="p-6">{{ $transaction->package->name }}</td>
                                <td class="p-6">{{ $transaction->created_at->format('M d, Y') }}</td>
                                <td class="p-6">IDR {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                <td class="p-6"><span class="{{ $transaction->status == 'success' ? 'text-green-400' : 'text-red-400' }} font-bold uppercase">{{ $transaction->status }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="p-6 text-center text-white/50">No transactions found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
