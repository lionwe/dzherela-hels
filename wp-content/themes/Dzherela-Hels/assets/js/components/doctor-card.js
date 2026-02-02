/**
 * Doctor Card Component
 * Handles equal height for doctor card overlays
 */

const initDoctorCardsEqualHeight = () => {
    const cards = document.querySelectorAll('.doctor-card');
    if (!cards.length) return;

    const setEqualHeight = () => {
        // Reset heights first
        const overlays = document.querySelectorAll('.doctor-card__overlay');
        overlays.forEach(overlay => {
            overlay.style.height = 'auto';
        });

        // Find max height
        let maxHeight = 0;
        overlays.forEach(overlay => {
            const height = overlay.offsetHeight;
            if (height > maxHeight) {
                maxHeight = height;
            }
        });

        // Set all to max height
        if (maxHeight > 0) {
            overlays.forEach(overlay => {
                overlay.style.height = `${maxHeight}px`;
            });
        }
    };

    // Run on load
    setEqualHeight();

    // Run on resize
    window.addEventListener('resize', () => {
        setEqualHeight();
    });

    // Run after a short delay to ensure fonts/images are loaded
    setTimeout(setEqualHeight, 500);

    // Optional: Re-run if Swiper is used and updates layout
    // Assuming global Swiper events might be relevant, or just relying on resize
};

// Initialize
document.addEventListener('DOMContentLoaded', initDoctorCardsEqualHeight);
