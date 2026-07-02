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

Alpine.data('formSubmit', () => ({
    loading: false,

    submit(event) {
        event.preventDefault();
        if (this.loading) return;

        this.loading = true;

        setTimeout(() => {
            this.loading = false;
        }, 2000);
    },
}));

Alpine.data('otpInput', (length = 6) => ({
    digits: Array.from({ length }, () => ''),

    get value() {
        return this.digits.join('');
    },

    getInputs() {
        return this.$refs.otpGroup?.querySelectorAll('input') ?? [];
    },

    handleInput(event, index) {
        const val = event.target.value.replace(/\D/g, '').slice(-1);
        this.digits[index] = val;
        event.target.value = val;

        if (val && index < length - 1) {
            this.getInputs()[index + 1]?.focus();
        }
    },

    handleKeydown(event, index) {
        if (event.key === 'Backspace' && !this.digits[index] && index > 0) {
            this.getInputs()[index - 1]?.focus();
        }

        if (event.key === 'ArrowLeft' && index > 0) {
            event.preventDefault();
            this.getInputs()[index - 1]?.focus();
        }

        if (event.key === 'ArrowRight' && index < length - 1) {
            event.preventDefault();
            this.getInputs()[index + 1]?.focus();
        }
    },

    handlePaste(event) {
        const paste = event.clipboardData.getData('text').replace(/\D/g, '').slice(0, length);

        paste.split('').forEach((char, i) => {
            this.digits[i] = char;
        });

        const inputs = this.getInputs();
        const focusIndex = Math.min(paste.length, length - 1);
        inputs[focusIndex]?.focus();
    },
}));

Alpine.data('countdown', (seconds = 60) => ({
    remaining: seconds,
    interval: null,

    init() {
        this.start();
    },

    start() {
        this.remaining = seconds;
        clearInterval(this.interval);

        this.interval = setInterval(() => {
            if (this.remaining > 0) {
                this.remaining--;
            } else {
                clearInterval(this.interval);
            }
        }, 1000);
    },

    get formatted() {
        const mins = Math.floor(this.remaining / 60);
        const secs = this.remaining % 60;
        return `${mins}:${secs.toString().padStart(2, '0')}`;
    },

    get expired() {
        return this.remaining === 0;
    },
}));

Alpine.start();
