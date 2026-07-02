<?php

declare(strict_types=1);

use App\Http\Controllers\AuditController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookImportController;
use App\Http\Controllers\BookReturnController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingController::class);

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/books/trash', [BookController::class, 'trash'])->name('books.trash');
    Route::post('/books/{id}/restore', [BookController::class, 'restore'])->name('books.restore');
    Route::delete('/books/{id}/force-delete', [BookController::class, 'forceDelete'])->name('books.force-delete');
    Route::get('/books/import', [BookImportController::class, 'create'])->name('books.import');
    Route::post('/books/import', [BookImportController::class, 'store'])->name('books.import.store');
    Route::resource('books', BookController::class);

    Route::get('/categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::post('/categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::resource('categories', CategoryController::class);

    Route::get('/members/trash', [MemberController::class, 'trash'])->name('members.trash');
    Route::resource('members', MemberController::class);

    Route::get('/borrowings/history', [BorrowingController::class, 'history'])->name('borrowings.history');
    Route::resource('borrowings', BorrowingController::class)->except(['destroy']);

    Route::get('/returns', [BookReturnController::class, 'index'])->name('returns.index');
    Route::post('/returns', [BookReturnController::class, 'store'])->name('returns.store');
    Route::get('/returns/{bookReturn}', [BookReturnController::class, 'show'])->name('returns.show');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/books', [ReportController::class, 'books'])->name('reports.books');
    Route::get('/reports/members', [ReportController::class, 'members'])->name('reports.members');
    Route::get('/reports/borrowings', [ReportController::class, 'borrowings'])->name('reports.borrowings');
    Route::get('/reports/fines', [ReportController::class, 'fines'])->name('reports.fines');

    Route::get('/audit', [AuditController::class, 'index'])->name('audit.index');
    Route::get('/audit/{id}', [AuditController::class, 'show'])->name('audit.show');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/security', [ProfileController::class, 'security'])->name('profile.security');
    Route::get('/profile/activity', [ProfileController::class, 'activity'])->name('profile.activity');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    Route::get('/settings/general', [SettingsController::class, 'general'])->name('settings.general');
    Route::get('/settings/library', [SettingsController::class, 'library'])->name('settings.library');
    Route::get('/settings/security', [SettingsController::class, 'security'])->name('settings.security');
    Route::get('/settings/notifications', [SettingsController::class, 'notifications'])->name('settings.notifications');
    Route::get('/settings/system', [SettingsController::class, 'system'])->name('settings.system');
    Route::patch('/settings', [SettingsController::class, 'update'])->name('settings.update');

    Route::redirect('/settings', '/settings/general');
    Route::redirect('/reports/analytics', '/reports');
});
