/**
 * Doctor Card Dynamic Mask
 * 
 * Adjusts the clip-path/mask to fit the badges content dynamically.
 */

const initDoctorCards = () => {
    const cards = document.querySelectorAll('.doctor-card');
    
    if (!cards.length) return;

    const updateCardMask = (card) => {
        const container = card.querySelector('.doctor-card__image-container');
        const badges = card.querySelector('.doctor-card__badges');
        
        if (!container || !badges) return;

        const w = container.offsetWidth;
        const h = container.offsetHeight;
        
        // If container has no size (hidden), skip
        if (w === 0 || h === 0) return;

        // Get badges dimensions
        // Note: badges are absolute positioned, but we want their visual size
        const bW = badges.offsetWidth;
        const bH = badges.offsetHeight;
        
        // Configuration
        const padding = 10;
        const offsetLeft = 5;
        const offsetTop = 5;
        const r = 20; // Corner radius

        // Calculate Cutout Dimensions
        // We enforce minimal dimensions to preserve corner aesthetics
        let cutX = offsetLeft + bW + padding;
        let cutY = offsetTop + bH + padding;
        
        // Clamp cutout to be at least the radius size + margin to prevent glitches
        cutX = Math.max(cutX, r * 2);
        cutY = Math.max(cutY, r * 2);
        
        // Also clamp to container bounds
        cutX = Math.min(cutX, w - r);
        cutY = Math.min(cutY, h - r);

        // SVG Path Construction (Clockwise)
        // Starts at Top-Left of the main body (after the cutout header)
        const path = [
            `M ${cutX + r},0`,                 // Start top edge
            `H ${w - r}`,                      // Line to top-right
            `A ${r} ${r} 0 0 1 ${w} ${r}`,     // Curve top-right
            `V ${h - r}`,                      // Line to right-bottom
            `A ${r} ${r} 0 0 1 ${w - r} ${h}`, // Curve bottom-right
            `H ${r}`,                          // Line to bottom-left
            `A ${r} ${r} 0 0 1 0 ${h - r}`,    // Curve bottom-left
            `V ${cutY + r}`,                   // Line up left side to cutout start
            `A ${r} ${r} 0 0 1 ${r} ${cutY}`,  // Curve into cutout (convex)
            `H ${cutX - r}`,                   // Line right into cutout
            `A ${r} ${r} 0 0 0 ${cutX} ${cutY - r}`, // Curve UP (concave inner corner), sweep 0
            `V ${r}`,                          // Line up to top
            `A ${r} ${r} 0 0 1 ${cutX + r} 0`, // Curve to top edge
            `Z`
        ].join(' ');

        // Create SVG Data URI
        // Using preserveAspectRatio='none' might distort content if we resize, 
        // but here we regenerate on resize so viewBox matches pixels.
        const svg = `<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 ${w} ${h}' preserveAspectRatio='none'><path d='${path}' fill='white'/></svg>`;
        const url = `data:image/svg+xml;utf8,${encodeURIComponent(svg)}`;

        // Apply Mask
        container.style.maskImage = `url("${url}")`;
        container.style.webkitMaskImage = `url("${url}")`;
        container.style.maskRepeat = 'no-repeat';
        container.style.webkitMaskRepeat = 'no-repeat';
        container.style.maskSize = '100% 100%';
        container.style.webkitMaskSize = '100% 100%';
    };

    // Initial update
    cards.forEach(updateCardMask);

    // Observer for resizes
    const observer = new ResizeObserver((entries) => {
        window.requestAnimationFrame(() => {
             entries.forEach(entry => {
                // entry.target is the doctor-card
                updateCardMask(entry.target);
            });
        });
    });

    cards.forEach(card => observer.observe(card));

    // Also listen to window resize as a fallback/safety
    window.addEventListener('resize', () => {
         cards.forEach(updateCardMask);
    });
};

export default initDoctorCards;
