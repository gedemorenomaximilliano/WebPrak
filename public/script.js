document.addEventListener('DOMContentLoaded', () => {

    const packages = window.packagesData || [];
    if (packages.length === 0) return;

    const bgSlides      = document.querySelectorAll('.two .bg-slide');
    const dots          = document.querySelectorAll('.dot');
    const progressFill  = document.getElementById('progressFill');
    const progressTrack = document.getElementById('progressTrack');
    const titleEl       = document.getElementById('slide-title');
    const descEl        = document.getElementById('slide-desc');

    const getCardEls = () => document.querySelectorAll('.package-card');

    let current = 0;
    let activeBgIdx = 0; // Which of the 2 bg divs is visible

    // Mapping for high-res landscape backgrounds
    const bgMap = {
        'DeDjawatan_Card.jpg': 'Explore_DeDjawatan.png',
        'Ijen_card.webp': 'Explore_KawahIjen.png',
        'PulauMerah_Card.jpg': 'Explore_PulauMerah.png',
    };

    function getBgImage(cardImage) {
        return bgMap[cardImage] || cardImage;
    }

    // Preload first background
    if (bgSlides.length > 0) {
        bgSlides[0].style.backgroundImage = `url(/images/${getBgImage(packages[0].image)})`;
    }

    // Highlight the active card, shrink + dim the others
    function setActiveCard(idx) {
        getCardEls().forEach((card, i) => {
            card.classList.toggle('active', i === idx);
        });
    }

    function goTo(idx) {
        if (idx === current) return;

        // Background crossfade
        const nextBgIdx = 1 - activeBgIdx;
        if (bgSlides[nextBgIdx]) {
            bgSlides[nextBgIdx].style.backgroundImage = `url(/images/${getBgImage(packages[idx].image)})`;
            bgSlides[activeBgIdx].classList.remove('active');
            bgSlides[nextBgIdx].classList.add('active');
            activeBgIdx = nextBgIdx;
        }

        // Dots + progress bar
        if (dots[current]) dots[current].classList.remove('active');
        if (dots[idx]) dots[idx].classList.add('active');

        if (progressFill) {
            progressFill.style.width = ((idx + 1) / packages.length * 100) + '%';
        }

        // Text fade swap
        titleEl.classList.add('text-fade');
        descEl.classList.add('text-fade');
        setTimeout(() => {
            titleEl.textContent = packages[idx].name;
            descEl.textContent  = packages[idx].description;
            titleEl.classList.remove('text-fade');
            descEl.classList.remove('text-fade');
        }, 300);

        // Cards swap animation
        const cardEls = getCardEls();
        cardEls.forEach((card, i) => {
            card.classList.add('exiting');
            setTimeout(() => {
                card.classList.remove('exiting');
                card.classList.add('entering');
                setTimeout(() => card.classList.remove('entering'), 600);
            }, 300 + i * 70);
        });

        // Set active card to match slide index
        setActiveCard(idx);

        current = idx;
    }

    // Dot click
    dots.forEach(d => d.addEventListener('click', () => {
        goTo(+d.dataset.idx);
    }));

    // Next button
    const nextBtn = document.getElementById('nextBtn');
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            const nextIdx = (current + 1) % packages.length;
            goTo(nextIdx);
        });
    }

    // Prev button
    const prevBtn = document.getElementById('prevBtn');
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            const prevIdx = (current - 1 + packages.length) % packages.length;
            goTo(prevIdx);
        });
    }

    // Progress track click
    if (progressTrack) {
        progressTrack.addEventListener('click', e => {
            const pct = (e.clientX - progressTrack.getBoundingClientRect().left) / progressTrack.offsetWidth;
            goTo(Math.min(Math.floor(pct * packages.length), packages.length - 1));
        });
    }

    // Init — set card 0 as active on load
    setActiveCard(0);

});