<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Banyuwangi</title>
    <link rel="stylesheet" href="{{ asset('base.css') }}">
    <link rel="stylesheet" href="{{ asset('style1.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('auth.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.packagesData = @json($packages);
    </script>
</head>

<script src="{{ asset('script.js') }}"></script>
<script src="{{ asset('cart.js') }}"></script>

<body class="font-[Montserrat]" >
    @include('layouts.navigation_public')

    <div class="main-wrapper">
        <!--Page Scroll Sections-->

        <!--landing Page-->
        <section class="one">
                                            
            <!-- Bottom bar -->
            <div class="absolute bottom-8 w-full flex justify-between items-center px-[4%]">
                
                <!-- Left: Book Now button + text -->
                <div class="flex items-center gap-6">
                    <button class="flex items-center gap-3 bg-white text-black font-bold text-lg px-6 py-3 rounded-full" onclick="location.href = '{{ route('packages.index') }}'">
                        Book Now
                    </button>
                    <p class="text-white/80 text-sm leading-snug max-w-[660px]">
                        Pesona alam Banyuwangi selalu saja ada yang baru dan tak pernah habis untuk dijelajahi. Seperti Pulau Mbedil atau lebih dikenal Bedil, destinasi wisata baru dengan gugusan pulau eksotis yang kini jadi favorit wisatawan.
                    </p>
                </div>

                <!-- Right: Social media icons -->
                <div class="flex items-center gap-5">
                    <!-- Instagram -->
                    <a href="#" class="text-white hover:text-white/70 transition">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="white"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.336 3.608 1.311.975.975 1.249 2.242 1.311 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.336 2.633-1.311 3.608-.975.975-2.242 1.249-3.608 1.311-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.336-3.608-1.311-.975-.975-1.249-2.242-1.311-3.608C2.175 15.584 2.163 15.204 2.163 12s.012-3.584.07-4.85c.062-1.366.336-2.633 1.311-3.608.975-.975 2.242-1.249 3.608-1.311C8.416 2.175 8.796 2.163 12 2.163zm0-2.163C8.741 0 8.332.014 7.052.072 5.197.157 3.355.673 1.988 2.04.622 3.406.106 5.248.021 7.103-.014 8.332 0 8.741 0 12c0 3.259.014 3.668.072 4.948.085 1.855.601 3.697 1.967 5.064 1.367 1.366 3.209 1.882 5.064 1.967C8.332 23.986 8.741 24 12 24s3.668-.014 4.948-.072c1.855-.085 3.697-.601 5.064-1.967 1.366-1.367 1.882-3.209 1.967-5.064.058-1.28.072-1.689.072-4.948s-.014-3.668-.072-4.948c-.085-1.855-.601-3.697-1.967-5.064C20.645.673 18.803.157 16.948.072 15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zm0 10.162a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                    </a>
                    <!-- WhatsApp -->
                    <a href="#" class="text-white hover:text-white/70 transition">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                    </a>
                    <!-- X (Twitter) -->
                    <a href="#" class="text-white hover:text-white/70 transition">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="white"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.253 5.622 5.911-5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <!-- Facebook -->
                    <a href="#" class="text-white hover:text-white/70 transition">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="white"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                </div>

            </div>
        </section>

        <!--Explore Page-->
        <section id="explore" class="two">
            <!-- Crossfading backgrounds -->
            <div class="bg-slide active" id="bg1"></div>
            <div class="bg-slide" id="bg2"></div>

            <!-- Gradient overlay -->
            <div class="overlay"></div>

            <!-- Main content row -->
            <div class="content-row">

                <!-- Description text -->
                <div class="text-block">
                    <h1 id="slide-title" class="fu d1">De Djawatan</h1>

                    <p id="slide-desc" class="fu d2">
                        Pesona alam Banyuwangi selalu saja ada yang baru dan tak pernah
                        habis untuk dijelajahi. Seperti Pulau Mbedil atau lebih dikenal Bedil,
                        destinasi wisata baru dengan gugusan pulau eksotis yang kini jadi
                        favorit wisatawan.
                    </p>

                <div class="fu d3 flex flex-col gap-6">
                    <button onclick="location.href='{{ route('packages.index') }}'" class="explore-btn">
                        Packages
                        <svg class="arr" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M3 9H15M15 9L10 4M15 9L10 14"
                                stroke="#111" stroke-width="2.2"
                                stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <div class="flex gap-3">
                        <button id="prevBtn" class="carousel-nav-btn !m-0 !w-12 !h-12">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 18l-6-6 6-6"/>
                            </svg>
                        </button>
                        <button id="nextBtn" class="carousel-nav-btn !m-0 !w-12 !h-12">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 18l6-6-6-6"/>
                            </svg>
                        </button>
                    </div>
                </div>

                    <!-- Progress + dots -->
                    <div class="fu d4 flex flex-col gap-3">
                        <div class="progress-track" id="progressTrack">
                            <div class="progress-fill" id="progressFill" style="width:33.33%"></div>
                        </div>
                        <div class="flex gap-2 items-center" id="dotsContainer">
                            @foreach($packages as $index => $package)
                                <div class="dot {{ $loop->first ? 'active' : '' }}" data-idx="{{ $index }}"></div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- package cards -->
                <div class="flex items-center gap-6">
                    <div class="cards-row cards-anim" id="cardsRow">
                        @foreach($packages as $index => $package)
                            <x-destination-card :package="$package" :active="$loop->first" :index="$index" />
                        @endforeach
                    </div>
                </div>

            </div>
        </section>


        
        <!--About Us Page-->
        <section id="about" class="three">
            <div class="flex flex-col justify-center items-center h-full px-[10%] gap-6 text-center pt-[20vh]">
               <p class="text-white/80 leading-relaxed font-medium text-justify" style="font-size: clamp(1.1rem, 1.8vw, 1.5rem); max-width: 1360px;">
                    Pesona alam Banyuwangi memang seolah memiliki magis tersendiri—selalu ada 
                    permata tersembunyi yang muncul ke permukaan, membuktikan bahwa kekayaan 
                    alam di ujung timur Pulau Jawa ini tak pernah habis untuk dijelajahi. Salah satu yang 
                    terbaru dan tengah mencuri perhatian adalah Pulau Mbedil, atau yang lebih akrab 
                    disapa Pulau Bedil.
                </p>
            </div>
        </section>

        <!--Footer Page-->
        <section class="four">

            <!-- Top divider line -->
            <div class="w-[90%] mx-auto border-t border-white/40 pt-10 flex-1 flex flex-col justify-between pb-10">

                <!-- Main footer columns -->
                <div class="flex justify-between items-start gap-8">

                    <!-- Col 1: Logo + tagline + desc -->
                    <div class="flex flex-col gap-4 max-w-[220px]">
                        <img src="{{ asset('images/LogoFooter.png') }}" alt="Jejak Banyuwangi" class="w-full">
                        <p class="text-white font-bold text-lg leading-snug">Discover the Hidden Paradise of Banyuwangi</p>
                        <p class="text-white/60 text-sm leading-relaxed text-justify">
                            Pesona alam Banyuwangi selalu saja ada yang baru dan tak pernah habis untuk dijelajahi. Seperti Pulau Mbedil atau lebih dikenal Bedil, destinasi wisata baru dengan gugusan pulau eksotis yang kini jadi favorit wisatawan.
                        </p>
                    </div>

                    <!-- Col 2: Explore -->
                    <div class="flex flex-col gap-4">
                        <h3 class="text-white font-bold text-sm tracking-widest border border-white/40 px-5 py-2 rounded-sm w-fit">EXPLORE</h3>
                        <ul class="flex flex-col gap-3 text-white/70 text-sm">
                            <li><a href="#" class="hover:text-white transition">About us</a></li>
                            <li><a href="#" class="hover:text-white transition">Our Team</a></li>
                        </ul>
                    </div>

                    <!-- Col 3: Services -->
                    <div class="flex flex-col gap-4">
                        <h3 class="text-white font-bold text-sm tracking-widest border border-white/40 px-5 py-2 rounded-sm w-fit">SERVICES</h3>
                        <ul class="flex flex-col gap-3 text-white/70 text-sm">
                            <li><a href="#" class="hover:text-white transition">Travel Packages</a></li>
                        </ul>
                    </div>

                    <!-- Col 4: Follow Us -->
                    <div class="flex flex-col gap-4">
                        <h3 class="text-white font-bold text-sm tracking-widest border border-white/40 px-5 py-2 rounded-sm w-fit">Follow Us ON</h3>
                        <ul class="flex flex-col gap-3 text-white/70 text-sm">
                            <li class="flex items-center gap-2">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                                bla bla bla street
                            </li>
                            <li class="flex items-center gap-2">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.02-.24c1.12.37 2.33.57 3.57.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.61 21 3 13.39 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57a1 1 0 0 1-.25 1.02l-2.2 2.2z"/></svg>
                                082264477077
                            </li>
                            <li class="flex items-center gap-2">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"/></svg>
                                jelajahbanyuwangi@gmail
                            </li>
                            <li class="flex items-center gap-2">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.336 3.608 1.311.975.975 1.249 2.242 1.311 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.336 2.633-1.311 3.608-.975.975-2.242 1.249-3.608 1.311-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.336-3.608-1.311-.975-.975-1.249-2.242-1.311-3.608C2.175 15.584 2.163 15.204 2.163 12s.012-3.584.07-4.85c.062-1.366.336-2.633 1.311-3.608.975-.975 2.242-1.249 3.608-1.311C8.416 2.175 8.796 2.163 12 2.163zm0-2.163C8.741 0 8.332.014 7.052.072 5.197.157 3.355.673 1.988 2.04.622 3.406.106 5.248.021 7.103-.014 8.332 0 8.741 0 12c0 3.259.014 3.668.072 4.948.085 1.855.601 3.697 1.967 5.064 1.367 1.366 3.209 1.882 5.064 1.967C8.332 23.986 8.741 24 12 24s3.668-.014 4.948-.072c1.855-.085 3.697-.601 5.064-1.967 1.366-1.367 1.882-3.209 1.967-5.064.058-1.28.072-1.689.072-4.948s-.014-3.668-.072-4.948c-.085-1.855-.601-3.697-1.967-5.064C20.645.673 18.803.157 16.948.072 15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zm0 10.162a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                                @jelajahbanyuwangi
                            </li>
                            <li class="flex items-center gap-2">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                                082264477077
                            </li>
                            <li class="flex items-center gap-2">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.253 5.622 5.911-5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                @jelajahbwi
                            </li>
                            <li class="flex items-center gap-2">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                jelajahbanyuwangi
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </section>
    </div>    
</body>
</html>
