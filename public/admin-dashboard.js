function switchTab(tabName) {
    // Hide all views
    const views = document.querySelectorAll('.view');
    views.forEach(view => view.classList.remove('active'));

    // Remove active class from all nav items
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
        item.classList.remove('active');
        item.classList.add('text-white/80');
        item.classList.add('hover:bg-white/20');
    });

    // Show the selected view
    const selectedView = document.getElementById(`view-${tabName}`);
    if (selectedView) {
        selectedView.classList.add('active');
    }

    // Set active class to selected nav item
    const selectedNavItem = document.getElementById(`tab-${tabName}`);
    if (selectedNavItem) {
        selectedNavItem.classList.add('active');
        selectedNavItem.classList.remove('text-white/80');
        selectedNavItem.classList.remove('hover:bg-white/20');
    }
}

function showAddModal() {
    document.getElementById('modal-title').innerText = 'Add New Package';
    document.getElementById('package-form').reset();
    document.getElementById('package-form').dataset.mode = 'add';
    document.getElementById('package-modal').classList.remove('hidden');
}

function hideModal() {
    document.getElementById('package-modal').classList.add('hidden');
}

function deletePackage(btn) {
    if (confirm('Are you sure you want to delete this package?')) {
        const row = btn.closest('tr');
        row.style.opacity = '0';
        row.style.transform = 'translateX(20px)';
        setTimeout(() => row.remove(), 300);
    }
}

function editPackage(btn) {
    const row = btn.closest('tr');
    const name = row.cells[1].innerText;
    const dest = row.cells[2].innerText;
    const price = row.cells[3].innerText.replace('IDR ', '');
    const desc = row.dataset.description || '';
    const itinerary = row.dataset.itinerary || '';
    const image = row.dataset.image || '';
    
    document.getElementById('modal-title').innerText = 'Edit Package';
    const form = document.getElementById('package-form');
    document.getElementById('package-name').value = name;
    document.getElementById('package-destination').value = dest;
    document.getElementById('package-price').value = price;
    document.getElementById('package-desc').value = desc;
    document.getElementById('package-itinerary').value = itinerary;
    document.getElementById('package-image').value = image;
    
    form.dataset.mode = 'edit';
    form.dataset.targetRow = row.rowIndex;
    
    document.getElementById('package-modal').classList.remove('hidden');
}
// Initialize on load
document.addEventListener('DOMContentLoaded', () => {
    if (window.appData && window.appData.packages) {
        renderAdminPackageTable(window.appData.packages, 'package-list');
    }
});

// Handle Form Submission
document.getElementById('package-form').onsubmit = function(e) {
    e.preventDefault();
    const form = e.target;
    const name = document.getElementById('package-name').value;
    const dest = document.getElementById('package-destination').value;
    const price = document.getElementById('package-price').value;
    const image = document.getElementById('package-image').value;
    const desc = document.getElementById('package-desc').value;
    const itinerary = document.getElementById('package-itinerary').value;

    if (form.dataset.mode === 'edit') {
        const rowIndex = parseInt(form.dataset.targetRow);
        const row = document.getElementById('package-list').rows[rowIndex - 1];
        row.cells[1].innerText = name;
        row.cells[2].innerText = dest;
        row.cells[3].innerText = 'IDR ' + price;
        row.dataset.description = desc;
        row.dataset.itinerary = itinerary;
        row.dataset.image = image;
        row.querySelector('img').src = `Image_Assets/${image}`;
        alert('Package updated successfully!');
    } else {
        const tbody = document.getElementById('package-list');
        const newRow = tbody.insertRow();
        newRow.className = 'hover:bg-white/5 transition';
        newRow.dataset.description = desc;
        newRow.dataset.itinerary = itinerary;
        newRow.dataset.image = image;
        newRow.innerHTML = `
            <td class="p-6">
                <img src="Image_Assets/${image}" alt="${name}" class="w-16 h-16 rounded-xl object-cover border border-white/20">
            </td>
            <td class="p-6 font-semibold">${name}</td>
            <td class="p-6">${dest}</td>
            <td class="p-6">IDR ${price}</td>
            <td class="p-6">
                <div class="flex justify-center gap-4">
                    <button onclick="editPackage(this)" class="p-2 bg-blue-500/20 text-blue-400 rounded-lg hover:bg-blue-500/40 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>
                    <button onclick="deletePackage(this)" class="p-2 bg-red-500/20 text-red-400 rounded-lg hover:bg-red-500/40 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>
            </td>
        `;
        alert('Package added successfully!');
    }
    hideModal();
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('package-modal');
    if (event.target == modal) {
        hideModal();
    }
}
