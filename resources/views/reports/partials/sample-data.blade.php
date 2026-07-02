@php
    $overviewStats = [
        ['title' => 'Total Borrowings', 'value' => '4,892', 'icon' => 'arrow-right-circle', 'trend' => '12.4%', 'trendUp' => true, 'color' => 'primary'],
        ['title' => 'Active Members', 'value' => '3,456', 'icon' => 'users', 'trend' => '8.1%', 'trendUp' => true, 'color' => 'success'],
        ['title' => 'Books in Circulation', 'value' => '892', 'icon' => 'book-open', 'trend' => '3.2%', 'trendUp' => false, 'color' => 'warning'],
        ['title' => 'Outstanding Fines', 'value' => 'Rp 2.4M', 'icon' => 'exclamation-triangle', 'trend' => '5.7%', 'trendUp' => false, 'color' => 'danger'],
    ];

    $bookReports = [
        ['title' => 'Clean Code', 'category' => 'Programming', 'borrows' => 342, 'available' => 3, 'stock' => 5, 'trend' => '+18%', 'variant' => 'success'],
        ['title' => 'Design Patterns', 'category' => 'Engineering', 'borrows' => 289, 'available' => 1, 'stock' => 4, 'trend' => '+12%', 'variant' => 'success'],
        ['title' => 'Atomic Habits', 'category' => 'Self-Help', 'borrows' => 256, 'available' => 0, 'stock' => 8, 'trend' => '+9%', 'variant' => 'warning'],
        ['title' => 'Deep Work', 'category' => 'Productivity', 'borrows' => 198, 'available' => 4, 'stock' => 6, 'trend' => '+6%', 'variant' => 'success'],
        ['title' => 'System Design Interview', 'category' => 'Technology', 'borrows' => 312, 'available' => 5, 'stock' => 7, 'trend' => '+22%', 'variant' => 'success'],
        ['title' => 'Introduction to Algorithms', 'category' => 'Computer Science', 'borrows' => 89, 'available' => 2, 'stock' => 2, 'trend' => '-4%', 'variant' => 'danger'],
    ];

    $memberReports = [
        ['name' => 'John Mitchell', 'email' => 'john.mitchell@email.com', 'borrows' => 24, 'fines' => 'Rp 0', 'status' => 'Active', 'variant' => 'success', 'joined' => 'Jan 2024'],
        ['name' => 'Sarah Chen', 'email' => 'sarah.chen@email.com', 'borrows' => 18, 'fines' => 'Rp 15,000', 'status' => 'Active', 'variant' => 'success', 'joined' => 'Mar 2024'],
        ['name' => 'Michael Brown', 'email' => 'michael.b@email.com', 'borrows' => 31, 'fines' => 'Rp 45,000', 'status' => 'Restricted', 'variant' => 'warning', 'joined' => 'Nov 2023'],
        ['name' => 'Emily Davis', 'email' => 'emily.davis@email.com', 'borrows' => 12, 'fines' => 'Rp 0', 'status' => 'Active', 'variant' => 'success', 'joined' => 'Jun 2025'],
        ['name' => 'David Wilson', 'email' => 'david.w@email.com', 'borrows' => 7, 'fines' => 'Rp 120,000', 'status' => 'Suspended', 'variant' => 'danger', 'joined' => 'Aug 2023'],
    ];

    $borrowingReports = [
        ['member' => 'John Mitchell', 'book' => 'Clean Code', 'borrowed' => 'Jul 1, 2026', 'due' => 'Jul 15, 2026', 'returned' => '—', 'status' => 'Active', 'variant' => 'success'],
        ['member' => 'Sarah Chen', 'book' => 'Design Patterns', 'borrowed' => 'Jun 28, 2026', 'due' => 'Jul 12, 2026', 'returned' => 'Jul 10, 2026', 'status' => 'Returned', 'variant' => 'neutral'],
        ['member' => 'Michael Brown', 'book' => 'Atomic Habits', 'borrowed' => 'Jun 20, 2026', 'due' => 'Jul 4, 2026', 'returned' => '—', 'status' => 'Overdue', 'variant' => 'danger'],
        ['member' => 'Emily Davis', 'book' => 'Deep Work', 'borrowed' => 'Jul 2, 2026', 'due' => 'Jul 16, 2026', 'returned' => '—', 'status' => 'Active', 'variant' => 'success'],
        ['member' => 'David Wilson', 'book' => 'Refactoring', 'borrowed' => 'May 15, 2026', 'due' => 'May 29, 2026', 'returned' => '—', 'status' => 'Overdue', 'variant' => 'danger'],
    ];

    $fineReports = [
        ['member' => 'Michael Brown', 'book' => 'Atomic Habits', 'amount' => 'Rp 45,000', 'days' => 12, 'issued' => 'Jul 4, 2026', 'status' => 'Unpaid', 'variant' => 'danger'],
        ['member' => 'David Wilson', 'book' => 'Refactoring', 'amount' => 'Rp 120,000', 'days' => 34, 'issued' => 'May 29, 2026', 'status' => 'Unpaid', 'variant' => 'danger'],
        ['member' => 'Sarah Chen', 'book' => 'Design Patterns', 'amount' => 'Rp 15,000', 'days' => 3, 'issued' => 'Jul 12, 2026', 'status' => 'Paid', 'variant' => 'success'],
        ['member' => 'Lisa Park', 'book' => 'Deep Work', 'amount' => 'Rp 30,000', 'days' => 7, 'issued' => 'Jun 25, 2026', 'status' => 'Waived', 'variant' => 'neutral'],
        ['member' => 'James Lee', 'book' => 'Clean Code', 'amount' => 'Rp 22,500', 'days' => 5, 'issued' => 'Jun 18, 2026', 'status' => 'Paid', 'variant' => 'success'],
    ];
@endphp
