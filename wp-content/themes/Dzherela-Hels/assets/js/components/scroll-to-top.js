export const initScrollToTop = () => {
    const scrollToTopBtn = document.getElementById('scroll-to-top');
    if (!scrollToTopBtn) return;

    // Show/hide button based on scroll position
    const toggleButtonVisibility = () => {
        if (window.scrollY > 300) {
            scrollToTopBtn.classList.add('is-visible');
        } else {
            scrollToTopBtn.classList.remove('is-visible');
        }
    };

    window.addEventListener('scroll', toggleButtonVisibility);

    // Scroll to top on click
    scrollToTopBtn.addEventListener('click', () => {
        if (window.lenis) {
            window.lenis.scrollTo(0);
        } else {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    });

    // Check initial state
    toggleButtonVisibility();
};

document.addEventListener('DOMContentLoaded', initScrollToTop);
