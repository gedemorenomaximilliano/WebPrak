<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Banyuwangi - Packages</title>
    <link rel="stylesheet" href="{{ asset('base.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style1.css') }}">
    <script src="{{ asset('auth.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .glass-card { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
        .carousel-container { transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1); display: flex; gap: 2rem; padding: 1rem; }
        .carousel-nav-btn {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
            margin: 0 !important;
            z-index: 20;
            width: 50px;
            height: 50px;
        }
        .carousel-nav-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
            transform: scale(1.1);
        }
        body {
            background-image: url('{{ asset('images/PackagesMenu_bg.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .package-card {
            opacity: 1 !important;
            transform: none !important;
            width: 380px;
            flex-shrink: 0;
            height: 550px; 
        }
        .card-image-area {
            height: 250px !important; 
        }
    </style>
</head>
<body class="font-['Montserrat'] min-h-screen">
    @include('layouts.navigation_public')
    <!-- Dark overlay for better readability -->
    <div class="fixed inset-0 bg-black/40 z-0"></div>

    <main class="relative z-10 flex gap-10 p-10 mt-24 items-start">
        <!-- Filter Sidebar -->
        <div class="glass-card rounded-3xl p-8 w-[380px] shrink-0 h-fit">
            <h2 class="text-white font-bold mb-6 text-2xl">Filter Paket</h2>
            <form action="{{ route('packages.index') }}" method="GET" class="space-y-6">
                <div>
                    <label class="block text-white font-bold mb-2">Pilih Destinasi</label>
                    <select name="destination" class="w-full bg-white/20 text-white rounded-lg p-3 outline-none border border-white/30 focus:border-white transition">
                        <option value="" class="text-black">Semua Destinasi</option>
                        @foreach($packages->pluck('destination')->unique() as $dest)
                            <option value="{{ $dest }}" class="text-black" {{ request('destination') == $dest ? 'selected' : '' }}>{{ $dest }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-white font-bold mb-2">Tanggal</label>
                    <input type="date" name="date" value="{{ request('date') }}" class="w-full bg-white/20 text-white p-3 rounded-lg outline-none border border-white/30 focus:border-white transition">
                </div>

                <button type="submit" class="w-full bg-[#4CB7FF] text-white font-bold py-4 rounded-xl hover:bg-white hover:text-[#4CB7FF] transition duration-300 shadow-lg">
                    CARI PAKET
                </button>
            </form>
        </div>

        <!-- Carousel Area -->
        <div class="flex-grow relative overflow-hidden">
            <!-- Carousel Header with Navigation -->
            <div class="flex justify-between items-end mb-8 px-4">
                <div>
                    <h2 class="text-white text-4xl font-extrabold mb-2">Pilih Paket Wisata</h2>
                    <p class="text-white/70">Temukan petualangan tak terlupakan di Banyuwangi</p>
                </div>
                <div class="flex gap-3">
                    <button id="prevBtn" class="carousel-nav-btn !static flex items-center justify-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 18l-6-6 6-6"/>
                        </svg>
                    </button>
                    <button id="nextBtn" class="carousel-nav-btn !static flex items-center justify-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 18l6-6-6-6"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="w-full">
                <div class="carousel-container" id="packagesContainer">
                    @foreach($packages as $index => $package)
                        <x-destination-card :package="$package" :index="$index" />
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('cart.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('packagesContainer');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            let scrollAmount = 0;
            const cardWidth = 380 + 32; // card width + gap (2rem = 32px)

            nextBtn.addEventListener('click', () => {
                const maxScroll = container.scrollWidth - container.parentElement.clientWidth;
                scrollAmount = Math.min(scrollAmount + cardWidth, maxScroll);
                container.style.transform = `translateX(-${scrollAmount}px)`;
            });

            prevBtn.addEventListener('click', () => {
                scrollAmount = Math.max(scrollAmount - cardWidth, 0);
                container.style.transform = `translateX(-${scrollAmount}px)`;
            });
        });
    </script>
</body>
</html>
