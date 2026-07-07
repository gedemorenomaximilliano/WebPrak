<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success - Jejak Banyuwangi</title>
    <link rel="stylesheet" href="{{ asset('base.css') }}">
    <link rel="stylesheet" href="{{ asset('style4.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-[Montserrat] bg-[#1a3a4a] text-white min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-lg glass-card rounded-[3rem] p-12 text-center border border-white/10">
        <div class="w-20 h-20 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <h1 class="text-4xl font-black mb-4">Payment Successful!</h1>
        <p class="text-white/60 mb-2">Thank you, {{ $transaction->first_name }}!</p>
        <p class="text-white/40 mb-8">Your booking for <strong class="text-white">{{ $transaction->package->name }}</strong> is confirmed.</p>

        <div class="bg-white/5 rounded-2xl p-6 mb-8 text-left space-y-3">
            <div class="flex justify-between"><span class="text-white/50">Transaction ID</span><span class="font-bold">#TRX-{{ $transaction->id }}</span></div>
            <div class="flex justify-between"><span class="text-white/50">Amount Paid</span><span class="font-bold">IDR {{ number_format($transaction->amount, 0, ',', '.') }}</span></div>
            <div class="flex justify-between"><span class="text-white/50">Payment</span><span class="font-bold uppercase">{{ $transaction->midtrans_payment_type ?? $transaction->payment_method }}</span></div>
            <div class="flex justify-between"><span class="text-white/50">Travel Date</span><span class="font-bold">{{ \Carbon\Carbon::parse($transaction->travel_date)->format('M d, Y') }}</span></div>
            @if($transaction->ticket)
                <div class="flex justify-between"><span class="text-white/50">Ticket Code</span><span class="font-bold text-[#4CB7FF]">{{ $transaction->ticket->ticket_code }}</span></div>
            @endif
        </div>

        <a href="{{ route('dashboard') }}" class="inline-block w-full bg-white text-black py-4 rounded-2xl font-bold hover:bg-white/80 transition">Go to Dashboard</a>
    </div>
</body>
</html>
