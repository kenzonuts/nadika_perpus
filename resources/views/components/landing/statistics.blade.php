@props([
    'stats' => [],
])

<section class="py-16 lg:py-20 bg-white border-y border-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div
            class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6"
            x-data="{
                stats: @js($stats),
                counters: [0, 0, 0, 0],
                animated: false,
                init() {
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting && !this.animated) {
                                this.animated = true;
                                this.animateCounters();
                            }
                        });
                    }, { threshold: 0.3 });
                    observer.observe(this.$el);
                },
                animateCounters() {
                    this.stats.forEach((stat, index) => {
                        const duration = 2000;
                        const start = performance.now();
                        const animate = (currentTime) => {
                            const elapsed = currentTime - start;
                            const progress = Math.min(elapsed / duration, 1);
                            const eased = 1 - Math.pow(1 - progress, 3);
                            this.counters[index] = Math.floor(eased * stat.value);
                            if (progress < 1) requestAnimationFrame(animate);
                            else this.counters[index] = stat.value;
                        };
                        requestAnimationFrame(animate);
                    });
                },
                formatNumber(num) {
                    return num.toLocaleString();
                }
            }"
        >
            <template x-for="(stat, index) in stats" :key="stat.label">
                <div class="group bg-card border border-border rounded-2xl p-6 lg:p-8 shadow-soft hover:shadow-soft-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 rounded-xl flex items-center justify-center transition-colors duration-300"
                            :class="{
                                'bg-primary/10 text-primary': stat.color === 'primary',
                                'bg-success/10 text-success': stat.color === 'success',
                                'bg-warning/10 text-warning': stat.color === 'warning',
                                'bg-danger/10 text-danger': stat.color === 'danger',
                            }"
                        >
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <template x-if="stat.icon === 'book'">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                </template>
                                <template x-if="stat.icon === 'users'">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 0 1-3.375 3.375S8.25 10.125 12 10.125s3.375-1.125 3.375-3.375S15.75 6.375 12 6.375Zm7.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </template>
                                <template x-if="stat.icon === 'arrow-path'">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182" />
                                </template>
                                <template x-if="stat.icon === 'exclamation-triangle'">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                </template>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl lg:text-4xl font-bold text-secondary" x-text="formatNumber(counters[index])">0</p>
                    <p class="mt-1 text-sm text-secondary/50 font-medium" x-text="stat.label"></p>
                </div>
            </template>
        </div>
    </div>
</section>
