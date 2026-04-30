// AJAX addToCart function for Laravel backend
function addToCart(packageId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    if (!csrfToken) {
        console.error('CSRF token not found. Make sure <meta name="csrf-token" content="{{ csrf_token() }}"> is in your <head>.');
        alert('Security error. Please refresh the page.');
        return;
    }

    fetch(`/cart/add/${packageId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            if (response.status === 419) {
                throw new Error('Session expired. Please refresh the page.');
            }
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert(data.message);
            // Update cart counter in the navbar
            const cartCounter = document.getElementById('cart-count');
            if (cartCounter) {
                cartCounter.textContent = data.cartCount;
            }
        } else {
            alert(data.message || 'Something went wrong. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(error.message || 'Error adding to cart. Please check your connection.');
    });
}
