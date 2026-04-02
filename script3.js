        let current = 0;
 
        function initCarousel() {
            const items = document.querySelectorAll('.card-item');
            items.forEach((item, i) => {
                item.style.display = i === 0 ? 'block' : 'none';
            });
        }
 
        function changeCard(direction) {
            const items = document.querySelectorAll('.card-item');
            items[current].style.display = 'none';
            current = (current + direction + items.length) % items.length;
            items[current].style.display = 'block';
        }
 
        document.addEventListener('DOMContentLoaded', initCarousel);