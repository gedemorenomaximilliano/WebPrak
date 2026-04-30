@props(['package', 'active' => false, 'index' => 0])

<div class="package-card {{ $active ? 'active' : '' }}" id="card{{ $index }}" style="width: 300px;">
    <div class="card-image-area">
        <img src="{{ asset('images/' . $package->image) }}" alt="{{ $package->name }}">
    </div>
    <div class="card-content">
        <h3 class="card-title">{{ $package->name }}</h3>
        <p class="card-desc">{{ $package->description }}</p>
        <p class="text-xs text-gray-500 mt-2">Available: {{ $package->start_date ? \Carbon\Carbon::parse($package->start_date)->format('M d') : 'N/A' }} - {{ $package->end_date ? \Carbon\Carbon::parse($package->end_date)->format('M d') : 'N/A' }}</p>
        <div class="card-footer">
            <p class="card-price">IDR {{ number_format($package->price, 0, ',', '.') }}<span>/ pax</span></p>
            <div class="card-actions">
                <a href="{{ route('packages.show', $package->id) }}" class="btn-detail">VIEW DETAIL</a>
                <button class="btn-add-cart" onclick="addToCart({{ $package->id }})">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>