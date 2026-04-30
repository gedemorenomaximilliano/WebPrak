<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Banyuwangi - Transaction</title>
    <link rel="stylesheet" href="{{ asset('base.css') }}">
    <link rel="stylesheet" href="{{ asset('style4.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-[Montserrat] bg-[#1a3a4a] text-white min-h-screen overflow-x-hidden">
    @include('layouts.navigation_public')

    <!-- Main Transaction Screen -->
    <div id="transaction-screen" class="min-h-[calc(100vh-100px)] flex items-center justify-center p-6 transition-all duration-500 mt-10">
        <div class="w-full max-w-6xl glass-card rounded-[3rem] p-12 bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl">
            <h1 class="text-4xl font-extrabold mb-10">Booking Details</h1>

            <form action="{{ route('transactions.store') }}" method="POST" id="bookingForm">
                @csrf
                <input type="hidden" name="package_id" value="{{ $package->id }}">
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Left Column -->
                    <div class="space-y-10">
                        <!-- Customer Details -->
                        <div class="bg-white/5 rounded-[2rem] p-8 border border-white/5">
                            <h2 class="text-xl font-bold mb-6">Customer Details</h2>
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-bold opacity-60 mb-2 block uppercase tracking-wider">First Name *</label>
                                    <input type="text" name="first_name" id="firstName" value="{{ explode(' ', Auth::user()->name)[0] }}" class="w-full bg-[#1a3a4a]/60 border border-white/10 rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-[#4CB7FF]" required>
                                </div>
                                <div>
                                    <label class="text-xs font-bold opacity-60 mb-2 block uppercase tracking-wider">Last Name *</label>
                                    <input type="text" name="last_name" id="lastName" value="{{ count(explode(' ', Auth::user()->name)) > 1 ? explode(' ', Auth::user()->name)[1] : '' }}" class="w-full bg-[#1a3a4a]/60 border border-white/10 rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-[#4CB7FF]" required>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-6 mt-6">
                                <div>
                                    <label class="text-xs font-bold opacity-60 mb-2 block uppercase tracking-wider">Email *</label>
                                    <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" class="w-full bg-[#1a3a4a]/60 border border-white/10 rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-[#4CB7FF]" required>
                                </div>
                                <div>
                                    <label class="text-xs font-bold opacity-60 mb-2 block uppercase tracking-wider">Phone Number *</label>
                                    <input type="text" name="phone" id="phone" placeholder="08..." class="w-full bg-[#1a3a4a]/60 border border-white/10 rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-[#4CB7FF]" required>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="bg-white/5 rounded-[2rem] p-8 border border-white/5">
                            <h2 class="text-xl font-bold mb-6">Payment Method</h2>
                            <div class="space-y-4">
                                <!-- BCA -->
                                <label class="flex items-center justify-between bg-[#1a3a4a]/60 border border-white/10 rounded-2xl p-4 cursor-pointer hover:bg-white/10 transition">
                                    <div class="bg-white rounded-lg px-4 py-1 flex items-center justify-center h-10 w-24">
                                        <span class="text-[#1f4a9a] font-black italic">BCA</span>
                                    </div>
                                    <div class="w-6 h-6 rounded-full border-2 border-white/40 flex items-center justify-center">
                                        <input type="radio" name="payment_method" value="BCA" class="hidden peer" checked>
                                        <div class="w-3 h-3 rounded-full bg-white opacity-0 peer-checked:opacity-100 transition"></div>
                                    </div>
                                </label>
                                <!-- Mandiri -->
                                <label class="flex items-center justify-between bg-[#1a3a4a]/60 border border-white/10 rounded-2xl p-4 cursor-pointer hover:bg-white/10 transition">
                                    <div class="bg-white rounded-lg px-4 py-1 flex items-center justify-center h-10 w-24 overflow-hidden relative">
                                        <div class="absolute top-0 left-0 right-0 h-1 bg-yellow-400"></div>
                                        <span class="text-[#1f4a9a] font-black text-xs">mandiri</span>
                                    </div>
                                    <div class="w-6 h-6 rounded-full border-2 border-white/40 flex items-center justify-center">
                                        <input type="radio" name="payment_method" value="Mandiri" class="hidden peer">
                                        <div class="w-3 h-3 rounded-full bg-white opacity-0 peer-checked:opacity-100 transition"></div>
                                    </div>
                                </label>
                                <!-- BRIVA -->
                                <label class="flex items-center justify-between bg-[#1a3a4a]/60 border border-white/10 rounded-2xl p-4 cursor-pointer hover:bg-white/10 transition">
                                    <div class="bg-white rounded-lg px-4 py-1 flex items-center justify-center h-10 w-24">
                                        <span class="text-[#1f4a9a] font-black tracking-tighter">BRIVA</span>
                                    </div>
                                    <div class="w-6 h-6 rounded-full border-2 border-white/40 flex items-center justify-center">
                                        <input type="radio" name="payment_method" value="BRIVA" class="hidden peer">
                                        <div class="w-3 h-3 rounded-full bg-white opacity-0 peer-checked:opacity-100 transition"></div>
                                    </div>
                                </label>
                            </div>
                            <button type="button" class="w-full text-center mt-6 font-bold flex items-center justify-center gap-2 hover:opacity-70 transition">
                                View all <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-10">
                        <div class="bg-white/5 rounded-[2rem] p-8 border border-white/5 flex flex-col h-full">
                            <h2 class="text-xl font-bold mb-8">Your Trip</h2>
                            
                            <div class="flex gap-6 mb-10 items-center">
                                <img id="tripImage" src="{{ asset('images/' . $package->image) }}" alt="Package Image" class="w-32 h-32 rounded-3xl object-cover">
                                <div class="flex-grow">
                                    <h3 id="tripName" class="text-2xl font-extrabold mb-1">{{ $package->name }}</h3>
                                    <p id="tripDestination" class="text-xs opacity-60 mb-3 font-semibold">{{ $package->destination }}</p>
                                    <p id="tripPrice" class="text-xl font-bold">Rp{{ number_format($package->price, 0, ',', '.') }},-</p>
                                </div>
                                <div class="flex flex-col gap-4 items-end">
                                    <select name="pax_count" id="paxCount" class="bg-white/10 border border-white/20 rounded-full px-4 py-1 text-sm focus:outline-none appearance-none">
                                        <option value="1" class="bg-[#1a3a4a]">1</option>
                                        <option value="2" class="bg-[#1a3a4a]" selected>2</option>
                                        <option value="3" class="bg-[#1a3a4a]">3</option>
                                        <option value="4" class="bg-[#1a3a4a]">4</option>
                                        <option value="5" class="bg-[#1a3a4a]">5</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-10">
                                <label class="text-xs font-bold opacity-60 mb-2 block uppercase tracking-wider">Discount Code</label>
                                <div class="flex gap-4">
                                    <input type="text" class="flex-grow bg-[#1a3a4a]/60 border border-white/10 rounded-2xl px-5 py-3 focus:outline-none">
                                    <button type="button" class="bg-white/20 px-8 py-3 rounded-2xl font-bold hover:bg-white/30 transition">Apply</button>
                                </div>
                            </div>

                            <div class="space-y-6 border-t border-white/10 pt-8 mt-auto">
                                <div class="flex justify-between font-semibold">
                                    <span class="opacity-60">Subtotal</span>
                                    <span id="subtotal">Rp0,-</span>
                                </div>
                                <div class="flex justify-between font-semibold">
                                    <span class="opacity-60">Taxes (10%)</span>
                                    <span id="taxes">Rp0,-</span>
                                </div>
                                <div class="flex justify-between font-semibold">
                                    <span class="opacity-60">Discount</span>
                                    <span id="discount">Rp0,-</span>
                                </div>
                                <div class="flex justify-between text-2xl font-black pt-4">
                                    <span>Total</span>
                                    <span id="total">Rp0,-</span>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-white/10 border border-white/20 py-5 rounded-3xl mt-10 font-extrabold text-xl hover:bg-white hover:text-[#1a3a4a] transition-all duration-300">
                                Checkout
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Screen Overlay (Optional - since we are redirecting) -->
    <!-- ... -->

    <script>
        const packagePrice = {{ $package->price }};

        document.addEventListener('DOMContentLoaded', () => {
            updateUI();
            document.getElementById('paxCount').addEventListener('change', updateUI);
        });

        function updateUI() {
            const pax = parseInt(document.getElementById('paxCount').value);
            const subtotal = packagePrice * pax;
            const taxes = subtotal * 0.1;
            const discount = subtotal > 1000000 ? 50000 : 0; // Simple discount logic
            const total = subtotal + taxes - discount;

            document.getElementById('subtotal').innerText = `Rp${subtotal.toLocaleString('id-ID')},-`;
            document.getElementById('taxes').innerText = `Rp${taxes.toLocaleString('id-ID')},-`;
            document.getElementById('discount').innerText = `Rp${discount.toLocaleString('id-ID')},-`;
            document.getElementById('total').innerText = `Rp${total.toLocaleString('id-ID')},-`;
        }
    </script>
</body>
</html>
