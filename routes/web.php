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
