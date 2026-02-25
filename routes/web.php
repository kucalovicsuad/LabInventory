<?php

use App\Services\QuoteService;
use Illuminate\Support\Facades\Route;

Route::get('/login', function (QuoteService $quoteService) {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    $quote = $quoteService->randomQuote();

    return view('auth.login', compact('quote'));
})->name('login');

Route::get('/', function () {
    return redirect('dashboard');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/items', function () {
        return view('items');
    })->name('items');

    Route::get('/users', function () {
        return view('users');
    })->name('users');
});
