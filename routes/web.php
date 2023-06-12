<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/login', [LoginController::class, 'loginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::group(['prefix' => '/', 'middleware' => ['auth']], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customers');


    Route::get('/customers/{customer}/users', [CustomerController::class, 'users'])->name('customers.users');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers/create', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{customer}/edit', [CustomerController::class, 'update'])->name('customers.update');

    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/create', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}/edit', [UserController::class, 'update'])->name('users.update');

});
Route::get('/test', function () {
    return Inertia::render('Test');
});

