@extends('layouts.dashboard')


@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Books', 'href' => url('/books')],
        ['label' => 'Import', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[900px] mx-auto space-y-6" x-data="importBooks">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-up">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-secondary dark:text-white tracking-tight">Import Books</h1>
                <p class="mt-1 text-sm text-secondary/60 dark:text-white/60">Bulk import books from a CSV file.</p>
            </div>
            <x-ui.button variant="outline" size="sm" href="{{ url('/books') }}">
                <x-ui.icon name="arrow-left" class="w-4 h-4" />
                Back to Books
            </x-ui.button>
        </div>

        {{-- Step: Upload --}}
        <div x-show="step === 'upload'" class="space-y-6">
            <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-base font-semibold text-secondary dark:text-white">Upload CSV File</h2>
                    <x-ui.button variant="outline" size="sm" type="button">
                        <x-ui.icon name="arrow-down-tray" class="w-4 h-4" />
                        Download Template
                    </x-ui.button>
                </div>

                <div class="relative border-2 border-dashed border-border dark:border-white/10 rounded-2xl p-12 text-center hover:border-primary/50 hover:bg-primary/5 transition-all duration-200 cursor-pointer">
                    <input type="file" accept=".csv" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="step = 'preview'" />
                    <div class="w-14 h-14 mx-auto bg-primary/10 rounded-2xl flex items-center justify-center mb-4">
                        <x-ui.icon name="arrow-up-tray" class="w-7 h-7 text-primary" />
                    </div>
                    <p class="text-sm font-medium text-secondary dark:text-white">Drag & drop your CSV file here</p>
                    <p class="mt-1 text-xs text-secondary/50 dark:text-white/50">or click to browse · Max 10MB</p>
                </div>
            </div>

            <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft">
                <h3 class="text-sm font-semibold text-secondary dark:text-white mb-4">Import Guidelines</h3>
                <ul class="space-y-2 text-sm text-secondary/60 dark:text-white/60">
                    <li class="flex items-start gap-2">
                        <x-ui.icon name="check-circle" class="w-4 h-4 text-success shrink-0 mt-0.5" />
                        Use the provided CSV template for correct column formatting
                    </li>
                    <li class="flex items-start gap-2">
                        <x-ui.icon name="check-circle" class="w-4 h-4 text-success shrink-0 mt-0.5" />
                        Required fields: title, isbn, author, category, stock
                    </li>
                    <li class="flex items-start gap-2">
                        <x-ui.icon name="check-circle" class="w-4 h-4 text-success shrink-0 mt-0.5" />
                        ISBN must be unique across your catalog
                    </li>
                </ul>
            </div>
        </div>

        {{-- Step: Preview --}}
        <div x-show="step === 'preview'" x-cloak class="space-y-6">
            <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl shadow-soft overflow-hidden">
                <div class="px-6 py-4 border-b border-border dark:border-white/10 flex items-center justify-between">
                    <h2 class="text-base font-semibold text-secondary dark:text-white">Import Preview</h2>
                    <div class="flex gap-2 text-xs">
                        <x-ui.badge variant="success">2 valid</x-ui.badge>
                        <x-ui.badge variant="danger">1 error</x-ui.badge>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-border dark:border-white/10">
                                <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 uppercase">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 uppercase">ISBN</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 uppercase">Author</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border dark:divide-white/10">
                            <template x-for="row in previewRows" :key="row.title">
                                <tr>
                                    <td class="px-6 py-3 text-secondary dark:text-white" x-text="row.title"></td>
                                    <td class="px-6 py-3 font-mono text-xs text-secondary/60" x-text="row.isbn || '—'"></td>
                                    <td class="px-6 py-3 text-secondary/60" x-text="row.author"></td>
                                    <td class="px-6 py-3">
                                        <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full" :class="row.status === 'valid' ? 'bg-success/10 text-success' : 'bg-danger/10 text-danger'" x-text="row.status"></span>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <x-ui.button variant="outline" type="button" @click="step = 'upload'">Cancel</x-ui.button>
                <x-ui.button variant="primary" type="button" @click="startImport()">
                    Import 2 Books
                </x-ui.button>
            </div>
        </div>

        {{-- Step: Importing --}}
        <div x-show="step === 'importing'" x-cloak class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-8 shadow-soft text-center">
            <x-ui.spinner size="lg" class="text-primary mx-auto mb-4" />
            <h3 class="text-base font-semibold text-secondary dark:text-white">Importing books...</h3>
            <p class="mt-1 text-sm text-secondary/50 dark:text-white/50 mb-6">Please wait while we process your file.</p>
            <div class="max-w-xs mx-auto h-2 bg-background dark:bg-white/10 rounded-full overflow-hidden">
                <div class="h-full bg-primary rounded-full transition-all duration-150" :style="'width:' + progress + '%'"></div>
            </div>
            <p class="mt-2 text-xs text-secondary/40" x-text="progress + '% complete'"></p>
        </div>

        {{-- Step: Complete --}}
        <div x-show="step === 'complete'" x-cloak class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-8 shadow-soft text-center">
            <div class="w-14 h-14 mx-auto bg-success/10 rounded-2xl flex items-center justify-center mb-4">
                <x-ui.icon name="check-circle" class="w-7 h-7 text-success" />
            </div>
            <h3 class="text-lg font-semibold text-secondary dark:text-white">Import Complete!</h3>
            <p class="mt-2 text-sm text-secondary/60 dark:text-white/60">Successfully imported 2 books to your catalog.</p>

            <div class="mt-6 p-4 bg-background dark:bg-white/5 rounded-xl text-left max-w-sm mx-auto">
                <h4 class="text-xs font-medium text-secondary/50 dark:text-white/50 uppercase mb-3">Import Summary</h4>
                <dl class="space-y-2 text-sm">
                    <div class="flex justify-between"><dt class="text-secondary/60">Total rows</dt><dd class="font-medium text-secondary dark:text-white">3</dd></div>
                    <div class="flex justify-between"><dt class="text-success">Imported</dt><dd class="font-medium text-success">2</dd></div>
                    <div class="flex justify-between"><dt class="text-danger">Skipped</dt><dd class="font-medium text-danger">1</dd></div>
                </dl>
            </div>

            <div class="flex justify-center gap-3 mt-6">
                <x-ui.button variant="outline" type="button" @click="step = 'upload'; progress = 0">Import More</x-ui.button>
                <x-ui.button variant="primary" href="{{ url('/books') }}">View Books</x-ui.button>
            </div>
        </div>
    </div>
@endsection
