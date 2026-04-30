<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Banyuwangi - Checkout</title>
    <link rel="stylesheet" href="{{ asset('base.css') }}">
    <link rel="stylesheet" href="{{ asset('style4.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-[Montserrat] bg-[#1a3a4a] text-white min-h-screen overflow-x-hidden">
    @include('layouts.navigation_public')

    <div id="checkout-screen" class="min-h-[calc(100vh-100px)] flex items-center justify-center p-6 transition-all duration-500 mt-10">
        <div class="w-full max-w-6xl glass-card rounded-[3rem] p-12 bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl">
            <h1 class="text-4xl font-extrabold mb-10">Checkout</h1>

            <form action="{{ route('cart.checkout.process') }}" method="POST" id="checkoutForm">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Left Column: Details -->
                    <div class="space-y-10">
                        <div class="bg-white/5 rounded-[2rem] p-8 border border-white/5">
                            <h2 class="text-xl font-bold mb-6">Your Information</h2>
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-bold opacity-60 mb-2 block uppercase tracking-wider">First Name *</label>
                                    <input type="text" name="first_name" value="{{ explode(' ', Auth::user()->name)[0] }}" class="w-full bg-[#1a3a4a]/60 border border-white/10 rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-[#4CB7FF]" required>
                                </div>
                                <div>
                                    <label class="text-xs font-bold opacity-60 mb-2 block uppercase tracking-wider">Last Name *</label>
                                    <input type="text" name="last_name" value="{{ count(explode(' ', Auth::user()->name)) > 1 ? explode(' ', Auth::user()->name)[1] : '' }}" class="w-full bg-[#1a3a4a]/60 border border-white/10 rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-[#4CB7FF]" required>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-6 mt-6">
                                <div>
                                    <label class="text-xs font-bold opacity-60 mb-2 block uppercase tracking-wider">Email *</label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full bg-[#1a3a4a]/60 border border-white/10 rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-[#4CB7FF]" required>
                                </div>
                                <div>
                                    <label class="text-xs font-bold opacity-60 mb-2 block uppercase tracking-wider">Phone Number *</label>
                                    <input type="text" name="phone" placeholder="08..." class="w-full bg-[#1a3a4a]/60 border border-white/10 rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-[#4CB7FF]" required>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white/5 rounded-[2rem] p-8 border border-white/5">
                            <h2 class="text-xl font-bold mb-6">Payment Method</h2>
                            <div class="space-y-4">
                                <label class="flex items-center justify-between bg-[#1a3a4a]/60 border border-white/10 rounded-2xl p-4 cursor-pointer hover:bg-white/10 transition">
                                    <span class="font-bold">BCA Transfer</span>
                                    <input type="radio" name="payment_method" value="BCA" checked>
                                </label>
                                <label class="flex items-center justify-between bg-[#1a3a4a]/60 border border-white/10 rounded-2xl p-4 cursor-pointer hover:bg-white/10 transition">
                                    <span class="font-bold">Mandiri Transfer</span>
                                    <input type="radio" name="payment_method" value="Mandiri">
                                </label>
                                <label class="flex items-center justify-between bg-[#1a3a4a]/60 border border-white/10 rounded-2xl p-4 cursor-pointer hover:bg-white/10 transition">
                                    <span class="font-bold">OVO / GoPay</span>
                                    <input type="radio" name="payment_method" value="E-Wallet">
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Summary -->
                    <div class="space-y-10">
                        <div class="bg-white/5 rounded-[2rem] p-8 border border-white/5">
                            <h2 class="text-xl font-bold mb-8">Summary</h2>
                            <div class="space-y-6 mb-10 max-h-[400px] overflow-y-auto pr-4">
                                @foreach($cart as $id => $details)
                                    <div class="flex gap-4 items-center">
                                        <img src="{{ asset('images/' . $details['image']) }}" class="w-16 h-16 rounded-xl object-cover">
                                        <div class="flex-grow">
                                            <h4 class="font-bold">{{ $details['name'] }}</h4>
                                            <p class="text-xs opacity-60">Qty: {{ $details['quantity'] }}</p>
                                        </div>
                                        <p class="font-bold text-sm">IDR {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</p>
                                    </div>
                                @endforeach
                            </div>

                            <div class="space-y-4 border-t border-white/10 pt-8 mt-auto">
                                <div class="flex justify-between font-semibold">
                                    <span class="opacity-60">Subtotal</span>
                                    <span>IDR {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between font-semibold">
                                    <span class="opacity-60">Taxes (10%)</span>
                                    <span>IDR {{ number_format($total * 0.1, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-2xl font-black pt-4 border-t border-white/10">
                                    <span>Total</span>
                                    <span>IDR {{ number_format($total * 1.1, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-white text-black py-5 rounded-3xl mt-10 font-extrabold text-xl hover:bg-white/80 transition-all duration-300">
                                Confirm Booking
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
