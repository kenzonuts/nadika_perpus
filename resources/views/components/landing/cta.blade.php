<section id="contact" class="py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative bg-primary rounded-3xl overflow-hidden shadow-soft-xl">
            {{-- Background decoration --}}
            <div class="absolute inset-0">
                <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4"></div>
            </div>

            <div class="relative px-8 py-16 sm:px-16 sm:py-20 text-center">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight">
                    Ready to modernize your library?
                </h2>
                <p class="mt-4 text-lg text-white/70 max-w-2xl mx-auto">
                    Join thousands of libraries already using Smart Library to deliver a world-class digital experience to their members.
                </p>

                <div class="mt-8 flex flex-wrap justify-center gap-4">
                    <x-ui.button variant="white" size="lg" href="#register" id="register">
                        Get Started Free
                        <x-ui.icon name="arrow-right" class="w-4 h-4" />
                    </x-ui.button>
                    <x-ui.button variant="white-outline" size="lg" href="#contact">
                        Contact Us
                    </x-ui.button>
                </div>

                <p class="mt-6 text-sm text-white/50">
                    No credit card required · Free 14-day trial · Cancel anytime
                </p>
            </div>
        </div>
    </div>
</section>
