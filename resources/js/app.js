import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('counter', (target, duration = 2000) => ({
    current: 0,
    target: target,
    duration: duration,
    started: false,

    start() {
        if (this.started) return;
        this.started = true;

        const startTime = performance.now();
        const animate = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / this.duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            this.current = Math.floor(eased * this.target);

            if (progress < 1) {
                requestAnimationFrame(animate);
            } else {
                this.current = this.target;
            }
        };

        requestAnimationFrame(animate);
    },
}));

Alpine.data('navbar', () => ({
    scrolled: false,
    mobileOpen: false,

    init() {
        this.scrolled = window.scrollY > 20;
        window.addEventListener('scroll', () => {
            this.scrolled = window.scrollY > 20;
        });
    },

    toggleMobile() {
        this.mobileOpen = !this.mobileOpen;
    },

    closeMobile() {
        this.mobileOpen = false;
    },
}));

Alpine.start();
