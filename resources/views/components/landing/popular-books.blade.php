@php
    $books = [
        [
            'title' => 'Clean Code',
            'author' => 'Robert C. Martin',
            'category' => 'Programming',
            'rating' => 4.8,
            'available' => true,
            'color' => 'from-blue-500 to-blue-600',
        ],
        [
            'title' => 'Design Patterns',
            'author' => 'Gang of Four',
            'category' => 'Software Engineering',
            'rating' => 4.9,
            'available' => true,
            'color' => 'from-violet-500 to-violet-600',
        ],
        [
            'title' => 'The Pragmatic Programmer',
            'author' => 'David Thomas',
            'category' => 'Career',
            'rating' => 4.7,
            'available' => false,
            'color' => 'from-emerald-500 to-emerald-600',
        ],
        [
            'title' => 'Atomic Habits',
            'author' => 'James Clear',
            'category' => 'Self-Help',
            'rating' => 4.9,
            'available' => true,
            'color' => 'from-amber-500 to-amber-600',
        ],
        [
            'title' => 'Deep Work',
            'author' => 'Cal Newport',
            'category' => 'Productivity',
            'rating' => 4.6,
            'available' => true,
            'color' => 'from-rose-500 to-rose-600',
        ],
        [
            'title' => 'System Design Interview',
            'author' => 'Alex Xu',
            'category' => 'Technology',
            'rating' => 4.8,
            'available' => true,
            'color' => 'from-cyan-500 to-cyan-600',
        ],
    ];
@endphp

<x-landing.section-header
    id="books"
    badge="Popular Books"
    title="Discover trending titles"
    subtitle="Explore our most popular books loved by the community. Find your next great read today."
>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($books as $book)
            <article class="group bg-card border border-border rounded-2xl shadow-soft overflow-hidden hover:shadow-soft-lg hover:-translate-y-1 transition-all duration-300">
                {{-- Book Cover --}}
                <div class="relative h-48 bg-gradient-to-br {{ $book['color'] }} flex items-center justify-center overflow-hidden">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-colors duration-300"></div>
                    <div class="relative text-center px-6">
                        <x-ui.icon name="book-open" class="w-12 h-12 text-white/80 mx-auto mb-3" />
                        <h3 class="text-white font-semibold text-lg leading-tight">{{ $book['title'] }}</h3>
                    </div>
                    <div class="absolute top-3 right-3">
                        <x-ui.badge :variant="$book['available'] ? 'success' : 'danger'">
                            {{ $book['available'] ? 'Available' : 'Borrowed' }}
                        </x-ui.badge>
                    </div>
                </div>

                {{-- Book Info --}}
                <div class="p-5">
                    <p class="text-sm text-secondary/50">{{ $book['author'] }}</p>
                    <div class="flex items-center justify-between mt-3">
                        <x-ui.badge variant="neutral">{{ $book['category'] }}</x-ui.badge>
                        <div class="flex items-center gap-1">
                            <x-ui.icon name="star" class="w-4 h-4 text-warning" />
                            <span class="text-sm font-medium text-secondary">{{ $book['rating'] }}</span>
                        </div>
                    </div>

                    <x-ui.button
                        :variant="$book['available'] ? 'primary' : 'outline'"
                        size="sm"
                        class="w-full mt-4 {{ !$book['available'] ? 'opacity-50 cursor-not-allowed' : '' }}"
                        :disabled="!$book['available']"
                    >
                        {{ $book['available'] ? 'Borrow Now' : 'Notify Me' }}
                    </x-ui.button>
                </div>
            </article>
        @endforeach
    </div>
</x-landing.section-header>
