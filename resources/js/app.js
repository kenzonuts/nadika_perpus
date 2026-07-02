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
        if (this.loading) {
            event.preventDefault();
            return;
        }

        const form = event.target;
        if (form.tagName !== 'FORM') {
            return;
        }

        if (!form.checkValidity()) {
            event.preventDefault();
            form.reportValidity();
            return;
        }

        this.loading = true;
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

Alpine.data('dashboard', () => ({
    sidebarCollapsed: false,
    mobileSidebarOpen: false,
    darkMode: false,
    searchOpen: false,
    activeDropdown: null,

    init() {
        this.sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        this.darkMode = localStorage.getItem('darkMode') === 'true';

        if (this.darkMode) {
            document.documentElement.classList.add('dark');
        }

        window.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                this.searchOpen = true;
            }
            if (e.key === 'Escape') {
                this.searchOpen = false;
                this.activeDropdown = null;
                this.mobileSidebarOpen = false;
            }
        });
    },

    toggleSidebar() {
        this.sidebarCollapsed = !this.sidebarCollapsed;
        localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);
    },

    toggleMobileSidebar() {
        this.mobileSidebarOpen = !this.mobileSidebarOpen;
    },

    closeMobileSidebar() {
        this.mobileSidebarOpen = false;
    },

    toggleDarkMode() {
        this.darkMode = !this.darkMode;
        document.documentElement.classList.toggle('dark', this.darkMode);
        localStorage.setItem('darkMode', this.darkMode);
    },

    toggleSearch() {
        this.searchOpen = !this.searchOpen;
    },

    openDropdown(name) {
        this.activeDropdown = this.activeDropdown === name ? null : name;
    },

    closeDropdowns() {
        this.activeDropdown = null;
    },

    isDropdownOpen(name) {
        return this.activeDropdown === name;
    },
}));

Alpine.data('sidebarGroup', (defaultOpen = false) => ({
    open: defaultOpen,

    toggle() {
        this.open = !this.open;
    },
}));

Alpine.data('booksIndex', () => ({
    viewMode: localStorage.getItem('booksViewMode') || 'table',
    loading: false,
    searchQuery: '',
    showFilters: false,
    deleteModalOpen: false,
    selectedBook: null,
    activeRowMenu: null,
    recentSearches: ['Clean Code', 'Programming', 'Robert Martin'],
    showSuggestions: false,

    setViewMode(mode) {
        this.viewMode = mode;
        localStorage.setItem('booksViewMode', mode);
    },

    refresh() {
        this.loading = true;
        setTimeout(() => { this.loading = false; }, 1200);
    },

    openDeleteModal(book) {
        this.selectedBook = book;
        this.deleteModalOpen = true;
        this.activeRowMenu = null;
    },

    closeDeleteModal() {
        this.deleteModalOpen = false;
        this.selectedBook = null;
    },

    toggleRowMenu(id) {
        this.activeRowMenu = this.activeRowMenu === id ? null : id;
    },

    closeRowMenu() {
        this.activeRowMenu = null;
    },
}));

Alpine.data('bookForm', (initial = {}) => ({
  form: {
    title: initial.title || '',
    subtitle: initial.subtitle || '',
    isbn: initial.isbn || '',
    author: initial.author || '',
    publisher: initial.publisher || '',
    year: initial.year || '',
    category: initial.category || '',
    shelf: initial.shelf || '',
    language: initial.language || 'English',
    pages: initial.pages || '',
    stock: initial.stock || 1,
    description: initial.description || '',
    status: initial.status || 'published',
  },
  dirty: false,
  coverPreview: null,
  dragOver: false,
  uploading: false,
  uploadProgress: 0,

  init() {
    this.$watch('form', () => { this.dirty = true; }, { deep: true });
    window.addEventListener('beforeunload', (e) => {
      if (this.dirty) { e.preventDefault(); e.returnValue = ''; }
    });
  },

  markClean() { this.dirty = false; },

  handleDrop(e) {
    this.dragOver = false;
    const file = e.dataTransfer?.files?.[0];
    if (file) this.processFile(file);
  },

  handleSelect(e) {
    const file = e.target?.files?.[0];
    if (file) this.processFile(file);
  },

  processFile(file) {
    if (!file.type.startsWith('image/')) return;
    const reader = new FileReader();
    reader.onload = (ev) => { this.coverPreview = ev.target.result; };
    reader.readAsDataURL(file);
    this.uploading = true;
    this.uploadProgress = 0;
    const interval = setInterval(() => {
      this.uploadProgress += 10;
      if (this.uploadProgress >= 100) { clearInterval(interval); this.uploading = false; }
    }, 100);
  },

  removeCover() { this.coverPreview = null; this.uploadProgress = 0; },
}));

Alpine.data('importBooks', () => ({
  step: 'upload',
  progress: 0,
  importing: false,
  previewRows: [
    { title: 'Clean Code', isbn: '978-0132350884', author: 'Robert C. Martin', status: 'valid' },
    { title: 'Design Patterns', isbn: '978-0201633610', author: 'Gang of Four', status: 'valid' },
    { title: 'Invalid Row', isbn: '', author: 'Unknown', status: 'error' },
  ],

  startImport() {
    this.importing = true;
    this.step = 'importing';
    this.progress = 0;
    const interval = setInterval(() => {
      this.progress += 5;
      if (this.progress >= 100) { clearInterval(interval); this.importing = false; this.step = 'complete'; }
    }, 150);
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

Alpine.data('moduleIndex', () => ({
    loading: false,
    searchQuery: '',
    showFilters: false,
    deleteModalOpen: false,
    createModalOpen: false,
    selectedItem: null,
    activeRowMenu: null,

    refresh() {
        this.loading = true;
        setTimeout(() => { this.loading = false; }, 1000);
    },

    openDeleteModal(item) {
        this.selectedItem = item;
        this.deleteModalOpen = true;
        this.activeRowMenu = null;
    },

    closeDeleteModal() {
        this.deleteModalOpen = false;
        this.selectedItem = null;
    },

    toggleRowMenu(id) {
        this.activeRowMenu = this.activeRowMenu === id ? null : id;
    },

    closeRowMenu() {
        this.activeRowMenu = null;
    },
}));

Alpine.data('memberForm', (initial = {}) => ({
    form: {
        name: initial.name || '',
        email: initial.email || '',
        phone: initial.phone || '',
        membership_type: initial.membership_type || 'Standard',
        status: initial.status || 'active',
        join_date: initial.join_date || '',
        address: initial.address || '',
        notes: initial.notes || '',
    },
    dirty: false,

    init() {
        this.$watch('form', () => { this.dirty = true; }, { deep: true });
        window.addEventListener('beforeunload', (e) => {
            if (this.dirty) { e.preventDefault(); e.returnValue = ''; }
        });
    },

    markClean() { this.dirty = false; },
}));

Alpine.start();
