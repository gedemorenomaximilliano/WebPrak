<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Banyuwangi - Manage Packages</title>
    <link rel="stylesheet" href="{{ asset('base.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-dashboard.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-[Montserrat] bg-[#121212] text-white min-h-screen overflow-hidden">
    <div class="flex h-screen">
        @include('layouts.admin_sidebar')
        <main class="flex-grow relative overflow-y-auto p-10">
            <div class="flex justify-between items-center mb-10">
                <h1 class="text-4xl font-bold">Manage Packages</h1>
                <button onclick="showAddModal()" class="bg-white text-[#7EA6C4] px-8 py-3 rounded-2xl font-bold hover:scale-105 transition flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add New Package
                </button>
            </div>

            @if(session('status'))
                <div class="bg-green-500 text-white p-4 rounded-xl mb-6">
                    {{ session('status') }}
                </div>
            @endif

            <div class="glass-card rounded-[2rem] overflow-hidden border border-white/10">
                <table class="w-full text-left">
                    <thead class="bg-white/5 border-b border-white/10">
                        <tr>
                            <th class="p-6 font-bold">Image</th>
                            <th class="p-6 font-bold">Package Name</th>
                            <th class="p-6 font-bold">Destination</th>
                            <th class="p-6 font-bold">Price</th>
                            <th class="p-6 font-bold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="package-list" class="divide-y divide-white/10">
                        @foreach($packages as $package)
                            <tr class="hover:bg-white/5 transition">
                                <td class="p-6">
                                    <img src="{{ asset('images/' . $package->image) }}" alt="{{ $package->name }}" class="w-16 h-16 rounded-xl object-cover border border-white/20">
                                </td>
                                <td class="p-6 font-semibold">{{ $package->name }}</td>
                                <td class="p-6">{{ $package->destination }}</td>
                                <td class="p-6">IDR {{ number_format($package->price, 0, ',', '.') }}</td>
                                <td class="p-6">
                                    <div class="flex justify-center gap-4">
                                        <button onclick="editPackage({{ $package->toJson() }})" class="p-2 bg-blue-500/20 text-blue-400 rounded-lg hover:bg-blue-500/40 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </button>
                                        <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-500/20 text-red-400 rounded-lg hover:bg-red-500/40 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Add/Edit Modal -->
    <div id="package-modal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="glass-card bg-[#1a1a1a] rounded-[2.5rem] w-full max-w-2xl overflow-hidden border border-white/10">
            <div class="p-10">
                <div class="flex justify-between items-center mb-8">
                    <h2 id="modal-title" class="text-3xl font-bold">Add New Package</h2>
                    <button onclick="hideModal()" class="text-white/50 hover:text-white"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                </div>
                <form id="package-form" action="{{ route('admin.packages.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" id="method-field" name="_method" value="POST">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-white/50">Package Name</label>
                            <input type="text" name="name" id="package-name" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#7EA6C4] transition">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-white/50">Destination</label>
                            <input type="text" name="destination" id="package-destination" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#7EA6C4] transition">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-white/50">Price (IDR)</label>
                            <input type="number" name="price" id="package-price" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#7EA6C4] transition">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-white/50">Image Filename</label>
                            <input type="text" name="image" id="package-image" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#7EA6C4] transition">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-white/50">Start Date</label>
                            <input type="date" name="start_date" id="package-start-date" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#7EA6C4] transition">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-white/50">End Date</label>
                            <input type="date" name="end_date" id="package-end-date" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#7EA6C4] transition">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-white/50">Description</label>
                        <textarea name="description" id="package-desc" required rows="3" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#7EA6C4] transition"></textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-white/50">Itinerary (JSON Array)</label>
                        <textarea name="itinerary" id="package-itinerary" required rows="2" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#7EA6C4] transition"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-white text-black font-bold py-4 rounded-2xl hover:bg-[#7EA6C4] hover:text-white transition duration-300">SAVE PACKAGE</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showAddModal() {
            document.getElementById('modal-title').innerText = 'Add New Package';
            document.getElementById('package-form').action = "{{ route('admin.packages.store') }}";
            document.getElementById('method-field').value = "POST";
            document.getElementById('package-form').reset();
            document.getElementById('package-modal').classList.remove('hidden');
        }

        function hideModal() {
            document.getElementById('package-modal').classList.add('hidden');
        }

        function editPackage(package) {
            document.getElementById('modal-title').innerText = 'Edit Package';
            document.getElementById('package-form').action = `/admin/packages/${package.id}`;
            document.getElementById('method-field').value = "PATCH";
            
            document.getElementById('package-name').value = package.name;
            document.getElementById('package-destination').value = package.destination;
            document.getElementById('package-price').value = package.price;
            document.getElementById('package-image').value = package.image;
            document.getElementById('package-start-date').value = package.start_date;
            document.getElementById('package-end-date').value = package.end_date;
            document.getElementById('package-desc').value = package.description;
            document.getElementById('package-itinerary').value = typeof package.itinerary === 'string' ? package.itinerary : JSON.stringify(package.itinerary);
            
            document.getElementById('package-modal').classList.remove('hidden');
        }

        window.onclick = function(event) {
            const modal = document.getElementById('package-modal');
            if (event.target == modal) {
                hideModal();
            }
        }
    </script>
</body>
</html>
