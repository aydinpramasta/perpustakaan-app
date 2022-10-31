<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LibrarianController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');

    Route::post('/authenticate', [AuthController::class, 'authenticate'])
        ->name('authenticate');
});

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::prefix('/admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/dashboard', [HomeController::class, 'index'])
                ->middleware('role:admin,librarian')
                ->name('dashboard');

            Route::resource('/librarians', LibrarianController::class)
                ->middleware('role:admin');
        });
});

Route::get('/', function () {
    return view('home');
})->name('home');
