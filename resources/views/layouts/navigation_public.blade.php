<header class="nav-fixed fixed w-full z-50 transition-all duration-300"> 
    <nav class="flex justify-between items-center w-[92%] mx-auto py-3">
        <!--Logo Image-->
        <div class="w-[300px]">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="h-10 w-auto object-contain">
            </a>
        </div>

        <!--Nav Buttons -->
        <div class="flex-grow flex justify-center">
            <ul class="flex items-center gap-[4vw] font-bold text-lg text-white">
                <li>
                    <a href="{{ route('home') }}" class="nav-link border-b-2 {{ Route::is('home') ? 'border-white' : 'border-transparent' }} hover:border-white transition-all duration-300 pb-1">Home</a>
                </li>
                <li>
                    <a href="{{ route('packages.index') }}" class="nav-link border-b-2 {{ Route::is('packages.index') ? 'border-white' : 'border-transparent' }} hover:border-white transition-all duration-300 pb-1">Packages</a>
                </li>
                <li>
                    <a href="{{ url('/#explore') }}" class="nav-link border-b-2 border-transparent hover:border-white transition-all duration-300 pb-1">Explore</a>
                </li> 
                <li>
                    <a href="{{ url('/#about') }}" class="nav-link border-b-2 border-transparent hover:border-white transition-all duration-300 pb-1">About</a>
                </li>
            </ul>
        </div>
        
        <!--Get Started / Sign In Button-->
        <div id="auth-container" class="w-[300px] flex justify-end items-center gap-4">
            <a href="{{ route('cart.index') }}" class="relative text-white hover:text-[#4CB7FF] transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span id="cart-count" class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] w-5 h-5 flex items-center justify-center rounded-full font-bold">
                    {{ count(session('cart', [])) }}
                </span>
            </a>

            @auth
                <div class="flex items-center gap-4">
                    <div class="p-[2px] rounded-full" style="background: linear-gradient(to right, #4CB7FF, #FFFFFF, #EFEB6C)">
                        <a href="{{ route('dashboard') }}" class="bg-white flex items-center justify-center gap-3 px-6 h-[48px] rounded-full cursor-pointer transform hover:scale-105 duration-300 shadow-lg">
                            <div class="w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center border-2 border-gray-200">
                                <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                            </div>
                            <span class="font-bold text-black text-lg">{{ Auth::user()->name }}</span>
                        </a>
                    </div>
                </div>
            @else
                <div class="p-[2px] rounded-full relative z-10" style="background: linear-gradient(to right, #4CB7FF, #FFFFFF, #EFEB6C)">
                    <a href="{{ route('login') }}" class="bg-white flex items-center justify-center font-bold text-xl text-black rounded-full w-[182px] h-[48px] cursor-pointer transform hover:scale-110 transition-all duration-300 shadow-lg">
                        Get Started
                    </a>
                </div>
            @endauth
        </div>
    </nav>
</header>
