@props([
    'categories' => [],
    'shelves' => [],
    'languages' => [],
    'mode' => 'create',
])

<div class="space-y-5" {{ $attributes }}>
    <x-books.upload />

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div class="sm:col-span-2">
            <x-ui.label for="title" :required="true">Title</x-ui.label>
            <input type="text" id="title" x-model="form.title" class="mt-1.5 block w-full px-4 py-3 text-sm bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20" placeholder="Enter book title" />
        </div>

        <div class="sm:col-span-2">
            <x-ui.label for="subtitle">Subtitle</x-ui.label>
            <input type="text" id="subtitle" x-model="form.subtitle" class="mt-1.5 block w-full px-4 py-3 text-sm bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20" placeholder="Optional subtitle" />
        </div>

        <div>
            <x-ui.label for="isbn" :required="true">ISBN</x-ui.label>
            <input type="text" id="isbn" x-model="form.isbn" class="mt-1.5 block w-full px-4 py-3 text-sm font-mono bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20" placeholder="978-0000000000" />
        </div>

        <div>
            <x-ui.label for="author" :required="true">Author</x-ui.label>
            <input type="text" id="author" x-model="form.author" class="mt-1.5 block w-full px-4 py-3 text-sm bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20" placeholder="Author name" />
        </div>

        <div>
            <x-ui.label for="publisher">Publisher</x-ui.label>
            <input type="text" id="publisher" x-model="form.publisher" class="mt-1.5 block w-full px-4 py-3 text-sm bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20" />
        </div>

        <div>
            <x-ui.label for="year">Publication Year</x-ui.label>
            <input type="number" id="year" x-model="form.year" min="1900" max="2030" class="mt-1.5 block w-full px-4 py-3 text-sm bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20" />
        </div>

        <div>
            <x-ui.label for="category" :required="true">Category</x-ui.label>
            <select id="category" x-model="form.category" class="mt-1.5 block w-full px-4 py-3 text-sm bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option value="">Select category</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <x-ui.label for="shelf">Shelf</x-ui.label>
            <select id="shelf" x-model="form.shelf" class="mt-1.5 block w-full px-4 py-3 text-sm bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option value="">Select shelf</option>
                @foreach ($shelves as $shelf)
                    <option value="{{ $shelf }}">{{ $shelf }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <x-ui.label for="language">Language</x-ui.label>
            <select id="language" x-model="form.language" class="mt-1.5 block w-full px-4 py-3 text-sm bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20">
                @foreach ($languages as $lang)
                    <option value="{{ $lang }}">{{ $lang }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <x-ui.label for="pages">Number of Pages</x-ui.label>
            <input type="number" id="pages" x-model="form.pages" min="1" class="mt-1.5 block w-full px-4 py-3 text-sm bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20" />
        </div>

        <div>
            <x-ui.label for="stock" :required="true">Stock</x-ui.label>
            <input type="number" id="stock" x-model="form.stock" min="0" class="mt-1.5 block w-full px-4 py-3 text-sm bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20" />
        </div>

        <div>
            <x-ui.label for="status">Status</x-ui.label>
            <select id="status" x-model="form.status" class="mt-1.5 block w-full px-4 py-3 text-sm bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option value="published">Published</option>
                <option value="draft">Draft</option>
                <option value="archived">Archived</option>
            </select>
        </div>

        <div class="sm:col-span-2">
            <x-ui.label for="description">Description</x-ui.label>
            <textarea id="description" x-model="form.description" rows="4" class="mt-1.5 block w-full px-4 py-3 text-sm bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 resize-none" placeholder="Book description..."></textarea>
        </div>
    </div>
</div>
