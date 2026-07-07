<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Pending - Jejak Banyuwangi</title>
    <link rel="stylesheet" href="{{ asset('base.css') }}">
    <link rel="stylesheet" href="{{ asset('style4.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-[Montserrat] bg-[#1a3a4a] text-white min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-lg glass-card rounded-[3rem] p-12 text-center border border-white/10">
        <div class="w-20 h-20 bg-yellow-500/20 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h1 class="text-4xl font-black mb-4">Payment Pending</h1>
        <p class="text-white/60 mb-8">Your payment is being processed. We'll notify you once confirmed.</p>

        <div class="bg-white/5 rounded-2xl p-6 mb-8 text-left space-y-3">
            <div class="flex justify-between"><span class="text-white/50">Transaction ID</span><span class="font-bold">#TRX-{{ $transaction->id }}</span></div>
            <div class="flex justify-between"><span class="text-white/50">Amount</span><span class="font-bold">IDR {{ number_format($transaction->amount, 0, ',', '.') }}</span></div>
            <div class="flex justify-between"><span class="text-white/50">Status</span><span class="font-bold text-yellow-400 uppercase">{{ $transaction->status }}</span></div>
        </div>

        <a href="{{ route('dashboard') }}" class="inline-block w-full bg-white text-black py-4 rounded-2xl font-bold hover:bg-white/80 transition">Go to Dashboard</a>
    </div>
</body>
</html>
