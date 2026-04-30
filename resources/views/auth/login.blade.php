<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Banyuwangi - Login</title>
    <link rel="stylesheet" href="{{ asset('base.css') }}">
    <link rel="stylesheet" href="{{ asset('style2.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-[Montserrat] bg-fixed bg-cover bg-center min-h-screen relative" style="background-image: url('{{ asset('images/Login_Bg.jpg') }}');">
    <!-- Dark overlay -->
    <div class="fixed inset-0 bg-[#040f1c]/55 z-0"></div>
    
    @include('layouts.navigation_public')

    <main class="relative z-10 flex items-center justify-between w-[80%] mx-auto min-h-screen pt-20">

        <!-- LEFT: Login card -->
        <div class="glass-card p-8 w-[480px] h-[600px] flex flex-col gap-5">

            <!-- Logo + tagline -->
            <div class="flex items-center gap-2">
                <span class="text-white text-2xl font-semibold">Explore More, Experience Life.</span>
            </div>

            <!-- Sign Up / Log In toggle -->
            <div class="flex rounded-lg overflow-hidden border border-white/20">
                <a href="{{ route('register') }}"
                    class="flex-1 py-2.5 text-center text-sm font-bold transition bg-transparent text-white">
                    Sign Up
                </a>
                <a href="{{ route('login') }}"
                    class="flex-1 py-2.5 text-center text-sm font-bold transition bg-white text-black">
                    Log In
                </a>
            </div>

            <!-- Social login (placeholder) -->
            <div>
                <p class="text-white/50 text-xs mb-3">Log In with Open account</p>
                <div class="flex gap-4">
                    <!-- Apple, Google, Facebook icons -->
                </div>
            </div>

            <!-- Divider -->
            <div class="divider text-white">or</div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Form fields -->
                <div class="flex flex-col gap-3">
                    <input type="email" name="email" :value="old('email')" required autofocus placeholder="Email" class="input-field bg-white/20 text-white p-3 rounded-lg border border-white/30">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    <div class="relative mt-3">
                        <input type="password" name="password" required autocomplete="current-password" placeholder="Password" class="input-field bg-white/20 text-white p-3 rounded-lg border border-white/30 w-full">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>

                <!-- Remember me + Forgot password -->
                <div class="flex justify-between items-center text-xs text-white/60 mt-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-3 h-3">
                        Remember me
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="hover:text-white transition">Forgot Password ?</a>
                    @endif
                </div>

                <!-- Log In button -->
                <button type="submit" class="w-full bg-black text-white font-bold py-3 rounded-lg hover:bg-white hover:text-black transition text-sm mt-6">
                    Log In
                </button>
            </form>

        </div>

        <!-- RIGHT: Big headline -->
        <div class="flex flex-col gap-4 max-w-[55%]">
            <h1 class="text-white font-black leading-none" style="font-size: clamp(3.5rem, 7vw, 7rem);">
                Experience a<br>Breathtaking<br>Adventure
            </h1>
        </div>

    </main>
</body>
</html>
