function injectNavbar() {
    const navbarHTML = `
    <header class="nav-fixed"> 
        <nav class="flex justify-between items-center w-[92%] py-3 z-50">
            <!--Logo Image-->
            <div class="w-[300px]">
                <a href="index.html">
                    <img src="Image_Assets/Logo.png" alt="Logo" class="h-10 w-auto object-contain">
                </a>
            </div>

            <!--Nav Buttons -->
            <div class="flex-grow flex justify-center">
                <ul class="flex items-center gap-[4vw] font-bold text-lg text-white">
                    <li>
                        <a id="nav-home" class="nav-link border-b-2 border-transparent hover:border-white transition-all duration-300 pb-1" href="index.html">Home</a>
                    </li>
                    <li>
                        <a id="nav-packages" class="nav-link border-b-2 border-transparent hover:border-white transition-all duration-300 pb-1" href="PackagesMenu.html">Packages</a>
                    </li>
                    <li>
                        <a id="nav-explore" class="nav-link border-b-2 border-transparent hover:border-white transition-all duration-300 pb-1" href="index.html#explore">Explore</a>
                    </li> 
                    <li>
                        <a id="nav-about" class="nav-link border-b-2 border-transparent hover:border-white transition-all duration-300 pb-1" href="index.html#about">About</a>
                    </li>
                </ul>
            </div>
            
            <!--Get Started / Sign In Button-->
            <div id="auth-container" class="w-[300px] flex justify-end items-center gap-4">
                <!-- Auth content will be injected by auth.js -->
            </div>
        </nav>
    </header>
    `;

    // Inject at the beginning of body
    document.body.insertAdjacentHTML('afterbegin', navbarHTML);

    // Set active link
    const currentPage = window.location.pathname.split('/').pop() || 'index.html';
    if (currentPage === 'index.html') {
        document.getElementById('nav-home')?.classList.remove('border-transparent');
        document.getElementById('nav-home')?.classList.add('border-white');
    } else if (currentPage === 'PackagesMenu.html') {
        document.getElementById('nav-packages')?.classList.remove('border-transparent');
        document.getElementById('nav-packages')?.classList.add('border-white');
    }

    // Call updateAuthUI if it exists
    if (typeof updateAuthUI === 'function') {
        updateAuthUI();
    }
}

// Run injection
document.addEventListener('DOMContentLoaded', injectNavbar);
