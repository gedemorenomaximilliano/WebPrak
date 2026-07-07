<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Verification - Jejak Banyuwangi</title>
    <link rel="stylesheet" href="{{ asset('base.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-[Montserrat] bg-[#121212] text-white min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md glass-card rounded-[3rem] p-10 border border-white/10 text-center">
        @if(session('status'))
            <div class="bg-green-500/20 text-green-400 p-4 rounded-2xl mb-6 font-bold">{{ session('status') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-500/20 text-red-400 p-4 rounded-2xl mb-6 font-bold">{{ session('error') }}</div>
        @endif

        <div class="w-20 h-20 mx-auto mb-6 rounded-full flex items-center justify-center
            {{ $ticket->status === 'active' ? 'bg-green-500/20' : ($ticket->status === 'used' ? 'bg-yellow-500/20' : 'bg-red-500/20') }}">
            @if($ticket->status === 'active')
                <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            @else
                <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            @endif
        </div>

        <h1 class="text-3xl font-black mb-2">{{ $ticket->ticket_code }}</h1>
        <span class="inline-block px-4 py-1 rounded-full text-sm font-bold uppercase mb-6
            {{ $ticket->status === 'active' ? 'bg-green-500/20 text-green-400' : ($ticket->status === 'used' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-red-500/20 text-red-400') }}">
            {{ $ticket->status }}
        </span>

        <div class="bg-white/5 rounded-2xl p-6 text-left space-y-3 mb-8">
            <div class="flex justify-between"><span class="text-white/50">Package</span><span class="font-bold">{{ $ticket->transaction->package->name }}</span></div>
            <div class="flex justify-between"><span class="text-white/50">Customer</span><span class="font-bold">{{ $ticket->transaction->first_name }} {{ $ticket->transaction->last_name }}</span></div>
            <div class="flex justify-between"><span class="text-white/50">Travel Date</span><span class="font-bold">{{ \Carbon\Carbon::parse($ticket->transaction->travel_date)->format('M d, Y') }}</span></div>
            <div class="flex justify-between"><span class="text-white/50">Pax</span><span class="font-bold">{{ $ticket->transaction->pax_count }}</span></div>
        </div>

        @if($ticket->status === 'active')
            <form action="{{ route('tickets.mark-used', $ticket) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="w-full bg-white text-black py-4 rounded-2xl font-bold hover:bg-white/80 transition">Mark as Used</button>
            </form>
        @endif

        <a href="{{ route('home') }}" class="inline-block mt-4 text-white/50 hover:text-white transition text-sm">Back to Home</a>
    </div>
</body>
</html>
