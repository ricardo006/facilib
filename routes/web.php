<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;

Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::prefix('books')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('books.index');
    Route::get('/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/', [BookController::class, 'store'])->name('books.store');
    Route::get('/{book}', [BookController::class, 'show'])->name('books.show');
    Route::get('/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/{book}', [BookController::class, 'destroy'])->name('books.destroy');
});

Route::prefix('loans')->group(function () {
    Route::get('/', [LoanController::class, 'index'])->name('loans.index');
    Route::get('/create', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/', [LoanController::class, 'store'])->name('loans.store');
    Route::get('/{loan}', [LoanController::class, 'show'])->name('loans.show');
    Route::get('/{loan}/edit', [LoanController::class, 'edit'])->name('loans.edit');
    Route::put('/{loan}', [LoanController::class, 'update'])->name('loans.update');
    Route::match(['put', 'patch'],'/{id}/update-status', [LoanController::class, 'updateStatus'])->name('loans.updateStatus');
    Route::delete('/{loan}', [LoanController::class, 'destroy'])->name('loans.destroy');
});
