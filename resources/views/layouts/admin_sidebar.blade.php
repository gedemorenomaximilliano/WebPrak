<aside class="w-64 bg-[#7EA6C4] flex flex-col py-8 px-6 rounded-r-[3rem] z-10">
    <div class="mb-12"><a href="{{ route('home') }}"><img src="{{ asset('images/Logo.png') }}" alt="Logo" class="w-48"></a></div>
    <nav class="flex-grow space-y-4">
        <a href="{{ route('dashboard') }}" class="nav-item w-full flex items-center gap-4 px-6 py-3 rounded-2xl transition-all duration-300 {{ Route::is('dashboard') ? 'bg-white/20' : 'text-white/80 hover:bg-white/20' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            <span class="font-semibold text-lg">Dashboard</span>
        </a>
        <a href="{{ route('admin.packages.index') }}" class="nav-item w-full flex items-center gap-4 px-6 py-3 rounded-2xl transition-all duration-300 {{ Route::is('admin.packages.*') ? 'bg-white/20' : 'text-white/80 hover:bg-white/20' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            <span class="font-semibold text-lg">Packages</span>
        </a>
        <a href="{{ route('admin.transactions.index') }}" class="nav-item w-full flex items-center gap-4 px-6 py-3 rounded-2xl transition-all duration-300 {{ Route::is('admin.transactions.*') ? 'bg-white/20' : 'text-white/80 hover:bg-white/20' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
            <span class="font-semibold text-lg">Transaction</span>
        </a>
    </nav>
    <div class="mt-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-4 px-6 py-3 rounded-2xl transition-all duration-300 text-white/80 hover:bg-white/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span class="font-semibold text-lg">Logout</span>
            </button>
        </form>
    </div>
</aside>
