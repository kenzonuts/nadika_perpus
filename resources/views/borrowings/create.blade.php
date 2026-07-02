@extends('layouts.dashboard')

@include('borrowings.partials.sample-data')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Borrowings', 'href' => url('/borrowings')],
        ['label' => 'Create', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1400px] mx-auto" x-data="{
        selectedBook: null,
        selectedMember: null,
        dueDate: '',
        bookSearch: '',
        memberSearch: '',
        bookDropdownOpen: false,
        memberDropdownOpen: false,
        books: @json($availableBooks),
        members: @json($members),
        get filteredBooks() {
            if (!this.bookSearch) return this.books;
            const q = this.bookSearch.toLowerCase();
            return this.books.filter(b =>
                b.title.toLowerCase().includes(q) ||
                b.author.toLowerCase().includes(q) ||
                b.isbn.includes(q)
            );
        },
        get filteredMembers() {
            if (!this.memberSearch) return this.members;
            const q = this.memberSearch.toLowerCase();
            return this.members.filter(m =>
                m.name.toLowerCase().includes(q) ||
                m.email.toLowerCase().includes(q)
            );
        },
        get loanDays() {
            if (!this.dueDate) return null;
            const today = new Date();
            const due = new Date(this.dueDate);
            return Math.ceil((due - today) / (1000 * 60 * 60 * 24));
        }
    }">
        <x-shared.page-toolbar
            title="New Borrowing"
            subtitle="Check out a book to a library member."
            back-url="{{ url('/borrowings') }}"
            back-label="Back to Borrowings"
        />

        <form @submit.prevent class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <div class="lg:col-span-2 space-y-6">
                {{-- Book Selector --}}
                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft">
                    <h2 class="text-base font-semibold text-secondary dark:text-white mb-4">Select Book</h2>
                    <div class="relative" @click.outside="bookDropdownOpen = false">
                        <label class="block text-sm font-medium text-secondary dark:text-white mb-2">Book</label>
                        <button
                            type="button"
                            @click="bookDropdownOpen = !bookDropdownOpen"
                            class="w-full flex items-center justify-between px-4 py-3 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-left focus:outline-none focus:ring-2 focus:ring-primary/20"
                        >
                            <span :class="selectedBook ? 'text-secondary dark:text-white' : 'text-secondary/40 dark:text-white/40'">
                                <span x-text="selectedBook ? selectedBook.title : 'Search and select a book...'"></span>
                            </span>
                            <x-ui.icon name="chevron-down" class="w-4 h-4 text-secondary/40 shrink-0" />
                        </button>

                        <div
                            x-show="bookDropdownOpen"
                            x-cloak
                            x-transition
                            class="absolute z-20 mt-2 w-full bg-card dark:bg-secondary border border-border dark:border-white/10 rounded-xl shadow-soft-lg overflow-hidden"
                        >
                            <div class="p-3 border-b border-border dark:border-white/10">
                                <div class="relative">
                                    <x-ui.icon name="magnifying-glass" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary/40" />
                                    <input
                                        type="search"
                                        x-model="bookSearch"
                                        placeholder="Search by title, author, or ISBN..."
                                        class="w-full pl-9 pr-4 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-lg text-secondary dark:text-white placeholder:text-secondary/40 focus:outline-none focus:ring-2 focus:ring-primary/20"
                                        @click.stop
                                    />
                                </div>
                            </div>
                            <ul class="max-h-48 overflow-y-auto py-1">
                                <template x-for="book in filteredBooks" :key="book.id">
                                    <li>
                                        <button
                                            type="button"
                                            @click="selectedBook = book; bookDropdownOpen = false; bookSearch = ''"
                                            class="w-full px-4 py-2.5 text-left hover:bg-background dark:hover:bg-white/5 transition-colors"
                                        >
                                            <p class="text-sm font-medium text-secondary dark:text-white" x-text="book.title"></p>
                                            <p class="text-xs text-secondary/50 dark:text-white/50">
                                                <span x-text="book.author"></span> · <span x-text="book.isbn" class="font-mono"></span> · <span x-text="book.available + ' available'"></span>
                                            </p>
                                        </button>
                                    </li>
                                </template>
                                <li x-show="filteredBooks.length === 0" class="px-4 py-3 text-sm text-secondary/50 dark:text-white/50">No books found.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Member Selector --}}
                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft">
                    <h2 class="text-base font-semibold text-secondary dark:text-white mb-4">Select Member</h2>
                    <div class="relative" @click.outside="memberDropdownOpen = false">
                        <label class="block text-sm font-medium text-secondary dark:text-white mb-2">Member</label>
                        <button
                            type="button"
                            @click="memberDropdownOpen = !memberDropdownOpen"
                            class="w-full flex items-center justify-between px-4 py-3 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-left focus:outline-none focus:ring-2 focus:ring-primary/20"
                        >
                            <span :class="selectedMember ? 'text-secondary dark:text-white' : 'text-secondary/40 dark:text-white/40'">
                                <span x-text="selectedMember ? selectedMember.name : 'Search and select a member...'"></span>
                            </span>
                            <x-ui.icon name="chevron-down" class="w-4 h-4 text-secondary/40 shrink-0" />
                        </button>

                        <div
                            x-show="memberDropdownOpen"
                            x-cloak
                            x-transition
                            class="absolute z-20 mt-2 w-full bg-card dark:bg-secondary border border-border dark:border-white/10 rounded-xl shadow-soft-lg overflow-hidden"
                        >
                            <div class="p-3 border-b border-border dark:border-white/10">
                                <div class="relative">
                                    <x-ui.icon name="magnifying-glass" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary/40" />
                                    <input
                                        type="search"
                                        x-model="memberSearch"
                                        placeholder="Search by name or email..."
                                        class="w-full pl-9 pr-4 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-lg text-secondary dark:text-white placeholder:text-secondary/40 focus:outline-none focus:ring-2 focus:ring-primary/20"
                                        @click.stop
                                    />
                                </div>
                            </div>
                            <ul class="max-h-48 overflow-y-auto py-1">
                                <template x-for="member in filteredMembers" :key="member.id">
                                    <li>
                                        <button
                                            type="button"
                                            @click="selectedMember = member; memberDropdownOpen = false; memberSearch = ''"
                                            class="w-full px-4 py-2.5 text-left hover:bg-background dark:hover:bg-white/5 transition-colors"
                                        >
                                            <p class="text-sm font-medium text-secondary dark:text-white" x-text="member.name"></p>
                                            <p class="text-xs text-secondary/50 dark:text-white/50">
                                                <span x-text="member.email"></span> · <span x-text="member.membership"></span>
                                            </p>
                                        </button>
                                    </li>
                                </template>
                                <li x-show="filteredMembers.length === 0" class="px-4 py-3 text-sm text-secondary/50 dark:text-white/50">No members found.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Due Date --}}
                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft">
                    <h2 class="text-base font-semibold text-secondary dark:text-white mb-4">Loan Period</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-secondary dark:text-white mb-2">Borrow Date</label>
                            <input
                                type="date"
                                value="{{ date('Y-m-d') }}"
                                class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20"
                            />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-secondary dark:text-white mb-2">Due Date</label>
                            <input
                                type="date"
                                x-model="dueDate"
                                class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20"
                            />
                            <p class="mt-1.5 text-xs text-secondary/50 dark:text-white/50" x-show="loanDays !== null">
                                <span x-text="loanDays + ' day loan period'"></span>
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-secondary dark:text-white mb-2">Notes <span class="text-secondary/40 font-normal">(optional)</span></label>
                        <textarea
                            rows="3"
                            placeholder="Add any notes about this borrowing..."
                            class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl placeholder:text-secondary/40 focus:outline-none focus:ring-2 focus:ring-primary/20 resize-none"
                        ></textarea>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <x-ui.button variant="outline" href="{{ url('/borrowings') }}">Cancel</x-ui.button>
                    <x-ui.button type="submit" variant="primary">
                        <x-ui.icon name="arrow-right-circle" class="w-4 h-4" />
                        Create Borrowing
                    </x-ui.button>
                </div>
            </div>

            {{-- Summary Card --}}
            <div class="lg:col-span-1">
                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft sticky top-6">
                    <h3 class="text-base font-semibold text-secondary dark:text-white mb-4">Borrowing Summary</h3>

                    <div class="space-y-4">
                        <div class="p-4 bg-background dark:bg-white/5 rounded-xl border border-border dark:border-white/10">
                            <p class="text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider mb-2">Book</p>
                            <template x-if="selectedBook">
                                <div>
                                    <p class="text-sm font-semibold text-secondary dark:text-white" x-text="selectedBook.title"></p>
                                    <p class="text-xs text-secondary/50 dark:text-white/50 mt-1" x-text="selectedBook.author"></p>
                                    <p class="text-xs font-mono text-secondary/40 dark:text-white/40 mt-1" x-text="selectedBook.isbn"></p>
                                </div>
                            </template>
                            <p x-show="!selectedBook" class="text-sm text-secondary/40 dark:text-white/40">No book selected</p>
                        </div>

                        <div class="p-4 bg-background dark:bg-white/5 rounded-xl border border-border dark:border-white/10">
                            <p class="text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider mb-2">Member</p>
                            <template x-if="selectedMember">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-primary/10 dark:bg-primary/20 rounded-lg flex items-center justify-center text-sm font-semibold text-primary shrink-0">
                                        <span x-text="selectedMember.name.split(' ').map(w => w[0]).join('')"></span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-secondary dark:text-white" x-text="selectedMember.name"></p>
                                        <p class="text-xs text-secondary/50 dark:text-white/50" x-text="selectedMember.email"></p>
                                    </div>
                                </div>
                            </template>
                            <p x-show="!selectedMember" class="text-sm text-secondary/40 dark:text-white/40">No member selected</p>
                        </div>

                        <div class="p-4 bg-background dark:bg-white/5 rounded-xl border border-border dark:border-white/10">
                            <p class="text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider mb-2">Due Date</p>
                            <template x-if="dueDate">
                                <div class="flex items-center gap-2">
                                    <x-ui.icon name="clock" class="w-4 h-4 text-warning" />
                                    <span class="text-sm font-semibold text-secondary dark:text-white" x-text="new Date(dueDate).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })"></span>
                                </div>
                            </template>
                            <p x-show="!dueDate" class="text-sm text-secondary/40 dark:text-white/40">Not set</p>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-border dark:border-white/10">
                        <div class="flex items-center gap-2 text-xs text-secondary/50 dark:text-white/50">
                            <x-ui.icon name="question-mark-circle" class="w-4 h-4 shrink-0" />
                            <span>Standard loan period is 14 days. Premium members may borrow up to 21 days.</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
