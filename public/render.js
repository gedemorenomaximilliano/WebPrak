/**
 * Render Package Cards for the Packages Menu / Explore Section
 * @param {Array} packages - Array of package objects
 * @param {string} containerId - DOM ID to render into
 */
function renderPackageCards(packages, containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;

    container.innerHTML = packages.map((pkg, index) => `
        <div class="package-card">
            <div class="card-image-area">
                <img src="Image_Assets/${pkg.image}" alt="${pkg.name}">
            </div>
            <div class="card-content">
                <h3 class="card-title">${pkg.name}</h3>
                <div class="flex items-center gap-2 text-xs font-semibold text-gray-500 mb-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>${pkg.availableFrom} - ${pkg.availableUntil}</span>
                </div>
                <p class="card-desc">${pkg.description}</p>
                <div class="card-footer">
                    <p class="card-price">IDR ${pkg.price.toLocaleString()}<span>/ pax</span></p>
                    <div class="card-actions">
                        <a href="itinerary.html?id=${pkg.id}" class="btn-detail">VIEW DETAIL</a>
                        <button onclick="addToCart(${pkg.id})" class="btn-add-cart">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `).join('');
}

/**
 * Render Dashboard Mini Package Cards
 */
function renderDashboardPackages(packages, containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;

    container.innerHTML = packages.slice(0, 3).map(pkg => `
        <div class="glass-card rounded-[2rem] overflow-hidden border border-white/10">
            <div class="h-48 bg-cover bg-center" style="background-image: url('Image_Assets/${pkg.image}')"></div>
            <div class="p-6">
                <h3 class="text-xl font-bold mb-4">${pkg.name}</h3>
                <div class="flex justify-between items-center bg-white/10 rounded-xl p-3 text-white">
                    <span class="text-xs font-semibold opacity-60">Starting Out</span>
                    <span class="font-bold">IDR ${pkg.price.toLocaleString()}</span>
                </div>
            </div>
        </div>
    `).join('');
}

/**
 * Render Admin Table Rows
 */
function renderAdminPackageTable(packages, containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;

    container.innerHTML = packages.map(pkg => `
        <tr class="hover:bg-white/5 transition" 
            data-id="${pkg.id}"
            data-description="${pkg.description}" 
            data-itinerary="${pkg.itinerary.join('\n')}"
            data-image="${pkg.image}">
            <td class="p-6">
                <img src="Image_Assets/${pkg.image}" alt="${pkg.name}" class="w-16 h-16 rounded-xl object-cover border border-white/20">
            </td>
            <td class="p-6 font-semibold">${pkg.name}</td>
            <td class="p-6">${pkg.destination}</td>
            <td class="p-6">IDR ${pkg.price.toLocaleString()}</td>
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
        </tr>
    `).join('');
}
