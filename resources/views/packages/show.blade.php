<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Banyuwangi - Itinerary</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('base.css') }}">
    <style>
        .glass-card { background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.1); }
    </style>
</head>
@php
    $bgMap = [
        'DeDjawatan_Card.jpg' => 'Explore_DeDjawatan.png',
        'Ijen_card.webp' => 'Explore_KawahIjen.png',
        'PulauMerah_Card.jpg' => 'Explore_PulauMerah.png',
    ];
    $bgImage = isset($bgMap[$package->image]) ? $bgMap[$package->image] : $package->image;
@endphp

<body class="font-['Montserrat'] min-h-screen text-white relative bg-[#121212]">
    <!-- Background layers to fix zoom, blur, and gaps -->
    <div class="fixed inset-0 -z-10 overflow-hidden bg-black">
        <!-- Base Layer: Fully blurred and slightly darkened to create a cohesive atmosphere and fill gaps -->
        <div class="absolute inset-0 bg-cover bg-center blur-2xl opacity-50 scale-110" 
             style="background-image: url('{{ asset('images/' . $package->image) }}')">
        </div>
        
        <!-- Gradient Overlay: Smooth transition to focus on the center -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-transparent to-black/60 z-10"></div>
        
        <!-- Sharp Main Layer: Landscape image centered without distortion -->
        <div class="absolute inset-0 flex items-center justify-center z-20">
            <img id="bgImage" src="{{ asset('images/' . $bgImage) }}" 
                 class="w-full h-full object-cover brightness-[0.7] contrast-[1.1]">
        </div>

        <!-- Extra darken overlay for content readability -->
        <div class="absolute inset-0 bg-black/20 z-30"></div>
    </div>
    
    @include('layouts.navigation_public')

    <main class="flex items-center justify-between px-20 mt-32 relative z-10">
        <div class="glass-card rounded-[3rem] p-10 w-[450px]">
            <h1 class="text-3xl font-bold mb-8 text-center tracking-widest">ITINERARY</h1>
            <div id="itineraryContainer" class="space-y-6 relative pl-6 border-l-2 border-dashed border-white/30">
                @php $itinerary = is_string($package->itinerary) ? json_decode($package->itinerary) : $package->itinerary; @endphp
                @foreach($itinerary as $item)
                    @php 
                        $parts = explode(' - ', $item);
                        $time = $parts[0];
                        $desc = isset($parts[1]) ? $parts[1] : '';
                    @endphp
                    <div class="relative">
                        <span class="absolute -left-[37px] w-6 h-6 bg-white/20 rounded-full"></span>
                        <p class="font-bold">{{ $time }}</p>
                        <p class="text-sm opacity-70">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="text-right">
            <h2 id="packageTitle" class="text-[6rem] font-black leading-none uppercase">
                1 DAY<br>TOUR<br><span class="text-[#4CB7FF]">{{ $package->destination }}</span>
            </h2>
            <a href="{{ route('transactions.create', $package->id) }}" class="inline-block bg-white text-black px-10 py-4 rounded-full font-black text-xl mt-8 transform hover:scale-105 transition shadow-2xl uppercase text-center">BOOK NOW →</a>
        </div>
    </main>
</body>
</html>
