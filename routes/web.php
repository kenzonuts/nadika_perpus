<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'landing.index');

// Auth
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
Route::view('/reset-password', 'auth.reset-password')->name('password.reset');
Route::view('/verify-email', 'auth.verify-email')->name('verification.notice');
Route::view('/confirm-password', 'auth.confirm-password')->name('password.confirm');
Route::view('/two-factor', 'auth.two-factor')->name('two-factor');

// Dashboard
Route::view('/dashboard', 'dashboard.index')->name('dashboard');

// Books
Route::view('/books', 'books.index')->name('books.index');
Route::view('/books/create', 'books.create')->name('books.create');
Route::view('/books/import', 'books.import')->name('books.import');
Route::view('/books/trash', 'books.trash')->name('books.trash');
Route::view('/books/{id}', 'books.show')->name('books.show');
Route::view('/books/{id}/edit', 'books.edit')->name('books.edit');

// Categories
Route::view('/categories', 'categories.index')->name('categories.index');
Route::view('/categories/create', 'categories.create')->name('categories.create');
Route::view('/categories/trash', 'categories.trash')->name('categories.trash');
Route::view('/categories/{id}', 'categories.show')->name('categories.show');
Route::view('/categories/{id}/edit', 'categories.edit')->name('categories.edit');

// Members
Route::view('/members', 'members.index')->name('members.index');
Route::view('/members/create', 'members.create')->name('members.create');
Route::view('/members/trash', 'members.trash')->name('members.trash');
Route::view('/members/{id}', 'members.show')->name('members.show');
Route::view('/members/{id}/edit', 'members.edit')->name('members.edit');

// Borrowings
Route::view('/borrowings', 'borrowings.index')->name('borrowings.index');
Route::view('/borrowings/create', 'borrowings.create')->name('borrowings.create');
Route::view('/borrowings/history', 'borrowings.history')->name('borrowings.history');
Route::view('/borrowings/{id}', 'borrowings.show')->name('borrowings.show');

// Returns
Route::view('/returns', 'returns.index')->name('returns.index');
Route::view('/returns/{id}', 'returns.show')->name('returns.show');

// Reports
Route::view('/reports', 'reports.index')->name('reports.index');
Route::view('/reports/books', 'reports.books')->name('reports.books');
Route::view('/reports/members', 'reports.members')->name('reports.members');
Route::view('/reports/borrowings', 'reports.borrowings')->name('reports.borrowings');
Route::view('/reports/fines', 'reports.fines')->name('reports.fines');

// Audit Logs
Route::view('/audit', 'audit.index')->name('audit.index');
Route::view('/audit/{id}', 'audit.show')->name('audit.show');

// Profile
Route::view('/profile', 'profile.index')->name('profile.index');
Route::view('/profile/security', 'profile.security')->name('profile.security');
Route::view('/profile/activity', 'profile.activity')->name('profile.activity');

// Settings
Route::view('/settings/general', 'settings.general')->name('settings.general');
Route::view('/settings/library', 'settings.library')->name('settings.library');
Route::view('/settings/security', 'settings.security')->name('settings.security');
Route::view('/settings/notifications', 'settings.notifications')->name('settings.notifications');
Route::view('/settings/system', 'settings.system')->name('settings.system');

// Settings & profile redirects
Route::redirect('/settings', '/settings/general');
Route::redirect('/reports/analytics', '/reports');
