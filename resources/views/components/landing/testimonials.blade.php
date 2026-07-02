@php
    $testimonials = [
        [
            'name' => 'Dr. Sarah Mitchell',
            'role' => 'Head Librarian, Stanford University',
            'review' => 'This system transformed how we manage our library. The QR borrowing feature alone saved us countless hours. Security and ease of use in perfect harmony.',
            'initials' => 'SM',
            'color' => 'bg-primary',
        ],
        [
            'name' => 'Michael Chen',
            'role' => 'IT Director, City Public Library',
            'review' => 'Implementation was seamless and the dashboard gives us insights we never had before. Our members love the modern interface and fast search capabilities.',
            'initials' => 'MC',
            'color' => 'bg-success',
        ],
        [
            'name' => 'Emily Rodriguez',
            'role' => 'Library Manager, Tech Institute',
            'review' => 'The role-based permissions and audit logs give us complete control. Finally, a library system that feels like a premium SaaS product, not legacy software.',
            'initials' => 'ER',
            'color' => 'bg-warning',
        ],
    ];
@endphp

<x-landing.section-header
    badge="Testimonials"
    title="Trusted by librarians worldwide"
    subtitle="See what library professionals are saying about their experience with Smart Library."
>
    <div class="grid md:grid-cols-3 gap-6">
        @foreach ($testimonials as $testimonial)
            <x-ui.card class="flex flex-col">
                {{-- Stars --}}
                <div class="flex gap-0.5">
                    @for ($i = 0; $i < 5; $i++)
                        <x-ui.icon name="star" class="w-4 h-4 text-warning" />
                    @endfor
                </div>

                {{-- Review --}}
                <p class="mt-4 text-secondary/70 leading-relaxed flex-1">
                    "{{ $testimonial['review'] }}"
                </p>

                {{-- Author --}}
                <div class="flex items-center gap-3 mt-6 pt-6 border-t border-border">
                    <div class="w-10 h-10 {{ $testimonial['color'] }} rounded-full flex items-center justify-center text-white text-sm font-semibold">
                        {{ $testimonial['initials'] }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-secondary">{{ $testimonial['name'] }}</p>
                        <p class="text-xs text-secondary/50">{{ $testimonial['role'] }}</p>
                    </div>
                </div>
            </x-ui.card>
        @endforeach
    </div>
</x-landing.section-header>
