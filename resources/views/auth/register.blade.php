<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Banyuwangi - Sign Up</title>
    <link rel="stylesheet" href="{{ asset('base.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style5.css') }}">
</head>
<body class="font-[Montserrat] bg-fixed bg-cover bg-center min-h-screen relative" style="background-image: url('{{ asset('images/Login_Bg.jpg') }}');">
    <!-- Dark overlay -->
    <div class="fixed inset-0 bg-[#040f1c]/55 z-0"></div>

    @include('layouts.navigation_public')

    <main class="relative z-10 flex items-center justify-between w-[80%] mx-auto min-h-screen pt-20">

    <!-- LEFT: Sign Up Card -->
    <div class="glass-card p-8 w-[480px] h-fit min-h-[650px] flex flex-col gap-5 bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl">

        <!-- LogoMini + heading -->
        <div class="flex items-center gap-4">
            <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="h-12">
            <p class="text-white font-black" style="font-size:1.5rem; line-height:1.15;">Create an account</p>
        </div>

        <!-- Tabs -->
        <div class="flex rounded-lg overflow-hidden border border-white/20">
            <a href="{{ route('register') }}" class="flex-1 py-2.5 text-center text-sm font-bold transition bg-white text-black">Sign Up</a>
            <a href="{{ route('login') }}" class="flex-1 py-2.5 text-center text-sm font-bold transition bg-transparent text-white/70">Log In</a>
        </div>

        <div class="divider text-white text-center text-xs opacity-50">OR</div>

        <!-- Form -->
        <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-3">
            @csrf
            
            <div class="relative">
                <input type="text" name="name" :value="old('name')" required autofocus placeholder="Full Name" class="input-field bg-white/20 text-white p-3 rounded-lg border border-white/30 w-full pl-4">
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-xs" />
            </div>

            <div class="relative">
                <input type="email" name="email" :value="old('email')" required placeholder="Email" class="input-field bg-white/20 text-white p-3 rounded-lg border border-white/30 w-full pl-4">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
            </div>

            <div class="relative">
                <input type="password" name="password" required autocomplete="new-password" placeholder="Password" class="input-field bg-white/20 text-white p-3 rounded-lg border border-white/30 w-full pl-4">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
            </div>

            <div class="relative">
                <input type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" class="input-field bg-white/20 text-white p-3 rounded-lg border border-white/30 w-full pl-4">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-xs" />
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full bg-black text-white font-bold py-3 rounded-lg hover:bg-white hover:text-black transition text-sm mt-4">
                Create Account
            </button>
        </form>

        <p class="text-center text-xs text-white/50">
            Already have an account?
            <a href="{{ route('login') }}" class="text-[#4CB7FF] font-semibold hover:underline ml-1">Log In</a>
        </p>
    </div>

    <!-- RIGHT: Hero -->
    <div class="flex flex-col gap-4 max-w-[55%]">
        <h1 class="text-white font-black leading-none" style="font-size: clamp(3.5rem, 7vw, 7rem);">
            Experience a<br>Breathtaking<br>Adventure
        </h1>
    </div>
</main>

</body>
</html>
