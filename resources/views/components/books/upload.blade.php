<div x-data="fileUpload" {{ $attributes }}>
    <x-ui.label>Book Cover</x-ui.label>

    <div
        x-show="!preview"
        @dragover.prevent="dragOver = true"
        @dragleave.prevent="dragOver = false"
        @drop.prevent="handleDrop($event)"
        :class="dragOver ? 'border-primary bg-primary/5' : 'border-border dark:border-white/10'"
        class="relative mt-1.5 border-2 border-dashed rounded-2xl p-8 text-center transition-all duration-200 cursor-pointer hover:border-primary/50 hover:bg-primary/5"
    >
        <input type="file" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="handleSelect($event)" aria-label="Upload book cover" />
        <div class="w-12 h-12 mx-auto bg-primary/10 rounded-xl flex items-center justify-center mb-3">
            <x-ui.icon name="photo" class="w-6 h-6 text-primary" />
        </div>
        <p class="text-sm font-medium text-secondary dark:text-white">Drag & drop your cover image</p>
        <p class="mt-1 text-xs text-secondary/50 dark:text-white/50">PNG, JPG up to 5MB</p>
    </div>

    <div x-show="preview" x-cloak class="relative mt-1.5">
        <img :src="preview" alt="Cover preview" class="w-full max-h-64 object-cover rounded-2xl border border-border dark:border-white/10" />

        <div x-show="uploading" class="absolute inset-0 bg-secondary/50 rounded-2xl flex items-center justify-center">
            <div class="w-48">
                <div class="h-1.5 bg-white/20 rounded-full overflow-hidden">
                    <div class="h-full bg-primary rounded-full transition-all duration-100" :style="'width:' + progress + '%'"></div>
                </div>
                <p class="text-xs text-white text-center mt-2" x-text="progress + '%'"></p>
            </div>
        </div>

        <div class="flex gap-2 mt-3">
            <label class="flex-1">
                <input type="file" accept="image/*" class="sr-only" @change="handleSelect($event)" />
                <span class="inline-flex items-center justify-center gap-2 w-full px-4 py-2 text-sm font-medium border border-border dark:border-white/10 rounded-xl hover:bg-background dark:hover:bg-white/5 cursor-pointer transition-colors">
                    <x-ui.icon name="arrow-path-rounded" class="w-4 h-4" /> Replace
                </span>
            </label>
            <button type="button" @click="remove()" class="px-4 py-2 text-sm font-medium text-danger border border-danger/20 rounded-xl hover:bg-danger/5 transition-colors">
                Remove
            </button>
        </div>
    </div>
</div>
