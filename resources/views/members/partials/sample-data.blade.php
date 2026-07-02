@php
    $members = [
        ['id' => 1, 'name' => 'John Mitchell', 'email' => 'john.mitchell@email.com', 'phone' => '+1 555-0101', 'membership_type' => 'Premium', 'status' => 'active', 'avatar_initials' => 'JM', 'borrowed_count' => 3, 'join_date' => 'Jan 15, 2024', 'qr_code' => 'M-00001', 'color' => 'from-blue-500 to-blue-600', 'address' => '123 Oak Street, Springfield', 'notes' => 'Regular borrower, prefers programming books.'],
        ['id' => 2, 'name' => 'Sarah Chen', 'email' => 'sarah.chen@email.com', 'phone' => '+1 555-0102', 'membership_type' => 'Faculty', 'status' => 'active', 'avatar_initials' => 'SC', 'borrowed_count' => 1, 'join_date' => 'Mar 8, 2023', 'qr_code' => 'M-00002', 'color' => 'from-violet-500 to-violet-600', 'address' => '456 Maple Ave, Riverside', 'notes' => 'Computer science department faculty member.'],
        ['id' => 3, 'name' => 'Michael Brown', 'email' => 'michael.brown@email.com', 'phone' => '+1 555-0103', 'membership_type' => 'Student', 'status' => 'active', 'avatar_initials' => 'MB', 'borrowed_count' => 2, 'join_date' => 'Sep 1, 2025', 'qr_code' => 'M-00003', 'color' => 'from-amber-500 to-amber-600', 'address' => '789 Campus Dr, University Town', 'notes' => 'Graduate student in engineering.'],
        ['id' => 4, 'name' => 'Emily Davis', 'email' => 'emily.davis@email.com', 'phone' => '+1 555-0104', 'membership_type' => 'Standard', 'status' => 'inactive', 'avatar_initials' => 'ED', 'borrowed_count' => 0, 'join_date' => 'Jun 20, 2022', 'qr_code' => 'M-00004', 'color' => 'from-rose-500 to-rose-600', 'address' => '321 Pine Lane, Lakeside', 'notes' => 'Membership expired, pending renewal.'],
        ['id' => 5, 'name' => 'David Wilson', 'email' => 'david.wilson@email.com', 'phone' => '+1 555-0105', 'membership_type' => 'Premium', 'status' => 'active', 'avatar_initials' => 'DW', 'borrowed_count' => 5, 'join_date' => 'Feb 14, 2024', 'qr_code' => 'M-00005', 'color' => 'from-emerald-500 to-emerald-600', 'address' => '654 Birch Blvd, Hillcrest', 'notes' => 'Has overdue items — follow up required.'],
        ['id' => 6, 'name' => 'Lisa Anderson', 'email' => 'lisa.anderson@email.com', 'phone' => '+1 555-0106', 'membership_type' => 'Basic', 'status' => 'suspended', 'avatar_initials' => 'LA', 'borrowed_count' => 0, 'join_date' => 'Nov 5, 2021', 'qr_code' => 'M-00006', 'color' => 'from-cyan-500 to-cyan-600', 'address' => '987 Cedar Court, Westfield', 'notes' => 'Suspended due to unpaid fines.'],
        ['id' => 7, 'name' => 'James Taylor', 'email' => 'james.taylor@email.com', 'phone' => '+1 555-0107', 'membership_type' => 'Student', 'status' => 'active', 'avatar_initials' => 'JT', 'borrowed_count' => 1, 'join_date' => 'Aug 28, 2025', 'qr_code' => 'M-00007', 'color' => 'from-indigo-500 to-indigo-600', 'address' => '147 Elm Street, Northgate', 'notes' => 'New member, orientation completed.'],
        ['id' => 8, 'name' => 'Maria Garcia', 'email' => 'maria.garcia@email.com', 'phone' => '+1 555-0108', 'membership_type' => 'Faculty', 'status' => 'active', 'avatar_initials' => 'MG', 'borrowed_count' => 2, 'join_date' => 'Apr 12, 2020', 'qr_code' => 'M-00008', 'color' => 'from-teal-500 to-teal-600', 'address' => '258 Willow Way, Southport', 'notes' => 'Library committee member.'],
    ];

    $trashedMembers = [
        ['id' => 101, 'name' => 'Robert Oldman', 'email' => 'robert.oldman@email.com', 'phone' => '+1 555-0199', 'membership_type' => 'Basic', 'avatar_initials' => 'RO', 'deleted_at' => '3 days ago', 'color' => 'from-gray-500 to-gray-600'],
        ['id' => 102, 'name' => 'Jane Former', 'email' => 'jane.former@email.com', 'phone' => '+1 555-0198', 'membership_type' => 'Student', 'avatar_initials' => 'JF', 'deleted_at' => '1 week ago', 'color' => 'from-slate-500 to-slate-600'],
    ];

    $membershipTypes = ['Basic', 'Standard', 'Premium', 'Student', 'Faculty'];
    $membershipStatuses = ['active', 'inactive', 'suspended', 'expired'];

    $borrowHistory = [
        ['book' => 'Clean Code', 'action' => 'Borrowed', 'date' => 'Jul 1, 2026', 'due_date' => 'Jul 15, 2026', 'color' => 'primary'],
        ['book' => 'Design Patterns', 'action' => 'Returned', 'date' => 'Jun 28, 2026', 'due_date' => null, 'color' => 'success'],
        ['book' => 'Atomic Habits', 'action' => 'Borrowed', 'date' => 'Jun 20, 2026', 'due_date' => 'Jul 4, 2026', 'color' => 'primary'],
        ['book' => 'Deep Work', 'action' => 'Returned', 'date' => 'Jun 10, 2026', 'due_date' => null, 'color' => 'success'],
        ['book' => 'The Pragmatic Programmer', 'action' => 'Overdue', 'date' => 'May 25, 2026', 'due_date' => 'Jun 8, 2026', 'color' => 'danger'],
    ];
@endphp
