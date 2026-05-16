import './bootstrap';
import Lenis from 'lenis';

const lenis = new Lenis({
    duration: 1.2,
    easing: (t) => Math.min(1, 1.001 - 2 ** (-10 * t)),
    orientation: 'vertical',
    gestureOrientation: 'vertical',
    smoothWheel: true,
    wheelMultiplier: 1,
    touchMultiplier: 2,
    infinite: false,
});

window.lenis = lenis;

// Handle all internal anchor clicks
const handleAnchorClick = (e) => {
    const target = e.target;
    const anchor = target.closest('a');

    if (
        anchor?.hash &&
        anchor.origin === window.location.origin &&
        anchor.pathname === window.location.pathname
    ) {
        const targetId = anchor.hash.substring(1);
        const targetElement = document.getElementById(targetId);

        if (targetElement || anchor.hash === '#') {
            e.preventDefault();
            lenis.scrollTo(anchor.hash === '#' ? 0 : anchor.hash, {
                offset: -20,
                duration: 1.8,
                easing: (t) => (t === 1 ? 1 : 1 - 2 ** (-10 * t)),
                onComplete: () => {
                    if (anchor.hash !== '#') {
                        window.history.pushState(null, '', anchor.hash);
                    }
                },
            });
        }
    }
};

window.addEventListener('click', handleAnchorClick, true);

function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}

requestAnimationFrame(raf);

