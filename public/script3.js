window.onload = () => {
    console.log("script3.js loaded, checking appData:", window.appData);
    if (window.appData && window.appData.packages) {
        console.log("Rendering packages...");
        renderPackageCards(window.appData.packages, 'carousel-track');
    } else {
        console.error("window.appData.packages is missing!");
    }

    const track = document.getElementById('carousel-track');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    
    if (!track || !nextBtn || !prevBtn) {
        console.error("Carousel elements missing!", {track, nextBtn, prevBtn});
        return;
    }

    let currentIndex = window.appData.packages.length; 
    const cardWidth = 400 + 32; 

    function updateTrack() {
        track.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
    }

    updateTrack();

    nextBtn.addEventListener('click', () => {
        currentIndex++;
        track.style.transition = 'transform 0.5s ease-out';
        updateTrack();
        
        if (currentIndex >= window.appData.packages.length * 2) {
            setTimeout(() => {
                track.style.transition = 'none';
                currentIndex = window.appData.packages.length;
                updateTrack();
            }, 500);
        }
    });

    prevBtn.addEventListener('click', () => {
        currentIndex--;
        track.style.transition = 'transform 0.5s ease-out';
        updateTrack();

        if (currentIndex < window.appData.packages.length) {
            setTimeout(() => {
                track.style.transition = 'none';
                currentIndex = window.appData.packages.length * 2 - 1;
                updateTrack();
            }, 500);
        }
    });
};
