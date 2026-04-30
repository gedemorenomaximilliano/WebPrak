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
