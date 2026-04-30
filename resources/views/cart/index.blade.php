<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Banyuwangi - Your Cart</title>
    <link rel="stylesheet" href="{{ asset('base.css') }}">
    <link rel="stylesheet" href="{{ asset('style1.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .cart-bg {
            background: radial-gradient(circle at 0% 0%, #1a3a4a 0%, #121212 50%),
                        radial-gradient(circle at 100% 100%, #2d4342 0%, #121212 50%);
            background-attachment: fixed;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        .item-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .item-card:hover {
            background: rgba(255, 255, 255, 0.06);
            transform: translateY(-5px);
            border-color: rgba(255, 255, 255, 0.15);
        }
        .qty-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.2s;
        }
        .qty-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }
        .checkout-btn {
            background: linear-gradient(135deg, #4CB7FF 0%, #3a96d1 100%);
            box-shadow: 0 10px 20px -5px rgba(76, 183, 255, 0.4);
            transition: all 0.3s;
        }
        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(76, 183, 255, 0.5);
            filter: brightness(1.1);
        }
    </style>
</head>
<body class="font-[Montserrat] cart-bg text-white min-h-screen">
    @include('layouts.navigation_public')

    <div class="max-w-5xl mx-auto pt-40 pb-20 px-6">
        <div class="flex items-baseline justify-between mb-12">
            <h1 class="text-5xl font-black tracking-tight">Shopping <span class="text-[#4CB7FF]">Cart</span></h1>
            <p class="text-white/40 font-medium">{{ count($cart) }} Items selected</p>
        </div>
        
        @if(session('success'))
            <div class="bg-blue-500/10 border border-blue-500/50 text-[#4CB7FF] p-5 rounded-2xl mb-8 flex items-center gap-3 animate-fade-up">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Items List -->
            <div class="lg:col-span-2 space-y-6">
                @forelse($cart as $id => $details)
                    <div class="glass-card p-6 rounded-[2.5rem] flex items-center justify-between item-card cart-item" data-id="{{ $id }}">
                        <div class="flex items-center gap-8">
                            <div class="relative group">
                                <img src="{{ asset('images/' . $details['image']) }}" class="w-28 h-28 rounded-3xl object-cover shadow-2xl transition duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 rounded-3xl bg-black/20 group-hover:bg-transparent transition duration-500"></div>
                            </div>
                            <div>
                                <h3 class="text-2xl font-extrabold mb-1">{{ $details['name'] }}</h3>
                                <p class="text-white/40 text-sm font-bold uppercase tracking-widest mb-4">{{ $details['destination'] }}</p>
                                
                                <div class="flex items-center gap-4 bg-black/20 w-fit p-1 rounded-xl border border-white/5">
                                    <button class="qty-btn minus-qty">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"></path></svg>
                                    </button>
                                    <input type="number" value="{{ $details['quantity'] }}" class="bg-transparent text-center font-bold w-10 focus:outline-none update-cart pointer-events-none" min="1">
                                    <button class="qty-btn plus-qty">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-right">
                            <p class="text-xs text-white/30 font-bold uppercase mb-1">Subtotal</p>
                            <p class="font-black text-2xl text-[#4CB7FF] mb-6">IDR {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</p>
                            <button class="text-white/20 hover:text-red-500 transition-colors duration-300 flex items-center gap-2 ml-auto group remove-from-cart">
                                <span class="text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity">REMOVE</span>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="glass-card rounded-[3rem] py-20 text-center">
                        <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <p class="text-white/40 text-xl font-bold">Your cart feels light...</p>
                        <a href="{{ route('packages.index') }}" class="inline-block mt-6 text-[#4CB7FF] font-bold hover:underline">Go explore some adventures →</a>
                    </div>
                @endforelse
            </div>

            <!-- Order Summary -->
            @if(count($cart) > 0)
                <div class="lg:col-span-1">
                    <div class="glass-card p-10 rounded-[3rem] sticky top-40 border-white/10">
                        <h2 class="text-2xl font-black mb-8">Order Summary</h2>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-white/60 font-bold">
                                <span>Subtotal</span>
                                <span>IDR {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-white/60 font-bold">
                                <span>Service Fee</span>
                                <span>FREE</span>
                            </div>
                            <div class="pt-6 border-t border-white/10 flex justify-between">
                                <span class="text-xl font-black">Total</span>
                                <span class="text-2xl font-black text-[#4CB7FF]">IDR {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <a href="{{ route('cart.checkout') }}" class="checkout-btn w-full py-3.5 rounded-xl flex items-center justify-center gap-3 font-bold text-base transition-all">
                            Proceed to Checkout
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>

                        <div class="mt-8 flex items-center justify-center gap-4">
                            <div class="w-10 h-6 bg-white/5 rounded flex items-center justify-center opacity-30">
                                <span class="text-[8px] font-bold">VISA</span>
                            </div>
                            <div class="w-10 h-6 bg-white/5 rounded flex items-center justify-center opacity-30">
                                <span class="text-[8px] font-bold">BCA</span>
                            </div>
                            <div class="w-10 h-6 bg-white/5 rounded flex items-center justify-center opacity-30">
                                <span class="text-[8px] font-bold">OVO</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        function updateCart(id, qty) {
            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: id, 
                    quantity: qty
                },
                success: function (response) {
                   window.location.reload();
                }
            });
        }

        $(".plus-qty").click(function() {
            const input = $(this).siblings('input');
            const newQty = parseInt(input.val()) + 1;
            updateCart($(this).parents(".cart-item").attr("data-id"), newQty);
        });

        $(".minus-qty").click(function() {
            const input = $(this).siblings('input');
            const newQty = Math.max(1, parseInt(input.val()) - 1);
            if (newQty !== parseInt(input.val())) {
                updateCart($(this).parents(".cart-item").attr("data-id"), newQty);
            }
        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            if(confirm("Are you sure you want to remove this package?")) {
                $.ajax({
                    url: '{{ route('cart.remove') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}', 
                        id: ele.parents(".cart-item").attr("data-id")
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
</body>
</html>
