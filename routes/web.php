<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'landing.index');

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
Route::view('/reset-password', 'auth.reset-password')->name('password.reset');
Route::view('/verify-email', 'auth.verify-email')->name('verification.notice');
Route::view('/confirm-password', 'auth.confirm-password')->name('password.confirm');
Route::view('/two-factor', 'auth.two-factor')->name('two-factor');

Route::view('/dashboard', 'dashboard.index')->name('dashboard');

Route::view('/books', 'books.index')->name('books.index');
Route::view('/books/create', 'books.create')->name('books.create');
Route::view('/books/import', 'books.import')->name('books.import');
Route::view('/books/trash', 'books.trash')->name('books.trash');
Route::view('/books/{id}', 'books.show')->name('books.show');
Route::view('/books/{id}/edit', 'books.edit')->name('books.edit');
