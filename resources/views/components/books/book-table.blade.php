@props(['books' => []])

<div {{ $attributes->merge(['class' => 'bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl shadow-soft overflow-hidden']) }}>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-border dark:border-white/10 bg-background/50 dark:bg-white/5">
                    <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Cover</th>
                    <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Title</th>
                    <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden md:table-cell">ISBN</th>
                    <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden lg:table-cell">Category</th>
                    <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden xl:table-cell">Author</th>
                    <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden xl:table-cell">Publisher</th>
                    <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden sm:table-cell">Stock</th>
                    <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden sm:table-cell">Available</th>
                    <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Status</th>
                    <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden lg:table-cell">Updated</th>
                    <th class="px-4 lg:px-6 py-3.5 text-right text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border dark:divide-white/10">
                @foreach ($books as $book)
                    <tr class="hover:bg-background/80 dark:hover:bg-white/5 transition-colors group">
                        <td class="px-4 lg:px-6 py-4">
                            <x-books.book-cover :book="$book" size="sm" />
                        </td>
                        <td class="px-4 lg:px-6 py-4">
                            <a href="{{ url('/books/' . $book['id']) }}" class="font-medium text-secondary dark:text-white hover:text-primary transition-colors line-clamp-1">
                                {{ $book['title'] }}
                            </a>
                            <p class="text-xs text-secondary/40 dark:text-white/40 mt-0.5 hidden sm:block line-clamp-1">{{ $book['subtitle'] ?? '' }}</p>
                        </td>
                        <td class="px-4 lg:px-6 py-4 text-secondary/60 dark:text-white/60 font-mono text-xs hidden md:table-cell">{{ $book['isbn'] }}</td>
                        <td class="px-4 lg:px-6 py-4 hidden lg:table-cell">
                            <x-books.book-badge type="category" :label="$book['category']" />
                        </td>
                        <td class="px-4 lg:px-6 py-4 text-secondary/60 dark:text-white/60 hidden xl:table-cell">{{ $book['author'] }}</td>
                        <td class="px-4 lg:px-6 py-4 text-secondary/60 dark:text-white/60 hidden xl:table-cell">{{ $book['publisher'] }}</td>
                        <td class="px-4 lg:px-6 py-4 font-medium text-secondary dark:text-white hidden sm:table-cell">{{ $book['stock'] }}</td>
                        <td class="px-4 lg:px-6 py-4 hidden sm:table-cell">
                            <span class="font-medium {{ $book['available'] > 0 ? 'text-success' : 'text-danger' }}">{{ $book['available'] }}</span>
                        </td>
                        <td class="px-4 lg:px-6 py-4">
                            <x-books.book-status :status="$book['status']" />
                        </td>
                        <td class="px-4 lg:px-6 py-4 text-xs text-secondary/40 dark:text-white/40 hidden lg:table-cell">{{ $book['updated_at'] }}</td>
                        <td class="px-4 lg:px-6 py-4 text-right">
                            <x-books.action-dropdown :book-id="$book['id']" :book="$book" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
