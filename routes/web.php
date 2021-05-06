<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\PageController::class, 'home'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('repositories', App\Http\Controllers\RepositoryController::class)
    ->middleware('auth:sanctum');