document.addEventListener('DOMContentLoaded', () => {

    const slides = [
        {
            title: "De Djawatan",
            desc: "Pesona alam Banyuwangi selalu saja ada yang baru dan tak pernah habis untuk dijelajahi. Seperti Pulau Mbedil atau lebih dikenal Bedil, destinasi wisata baru dengan gugusan pulau eksotis yang kini jadi favorit wisatawan.",
        },
        {
            title: "Kawah Ijen",
            desc: "Kawah Ijen adalah danau kawah vulkanik yang terkenal dengan fenomena blue fire yang sangat langka. Nikmati keajaiban alam yang memukau ini saat fajar menyingsing di ufuk timur.",
        },
        {
            title: "Pantai Pulau Merah",
            desc: "Pantai Pulau Merah menawarkan hamparan pasir putih dengan bukit bertebing merah yang ikonik. Ombaknya yang konsisten menjadikannya surga bagi para peselancar dari seluruh dunia.",
        }
    ];

    const bgSlides      = document.querySelectorAll('.two .bg-slide');
    const dots          = document.querySelectorAll('.dot');
    const progressFill  = document.getElementById('progressFill');
    const progressTrack = document.getElementById('progressTrack');
    const titleEl       = document.getElementById('slide-title');
    const descEl        = document.getElementById('slide-desc');
    const cardEls       = [
        document.getElementById('card0'),
        document.getElementById('card1'),
        document.getElementById('card2')
    ];

    let current = 0;

    // Highlight the active card, shrink + dim the others
    function setActiveCard(idx) {
        cardEls.forEach((card, i) => {
            card.classList.toggle('active', i === idx);
        });
    }

    function goTo(idx) {
        if (idx === current) return;

        // Background crossfade
        bgSlides[current].classList.remove('active');
        bgSlides[idx].classList.add('active');

        // Dots + progress bar
        dots[current].classList.remove('active');
        dots[idx].classList.add('active');
        progressFill.style.width = ((idx + 1) / slides.length * 100) + '%';

        // Text fade swap
        titleEl.classList.add('text-fade');
        descEl.classList.add('text-fade');
        setTimeout(() => {
            titleEl.textContent = slides[idx].title;
            descEl.textContent  = slides[idx].desc;
            titleEl.classList.remove('text-fade');
            descEl.classList.remove('text-fade');
        }, 300);

        // Cards swap animation
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

    // Progress track click
    progressTrack.addEventListener('click', e => {
        const pct = (e.clientX - progressTrack.getBoundingClientRect().left) / progressTrack.offsetWidth;
        goTo(Math.min(Math.floor(pct * slides.length), slides.length - 1));
    });

    // Init — set card 0 as active on load
    setActiveCard(0);

});