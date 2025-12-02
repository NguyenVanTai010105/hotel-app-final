<?php

use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/booking', [HomeController::class, 'index'])->name('book');
Route::post('/dat-phong/luu', [BookingController::class, 'store'])->name('booking.store');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dat-phong/{id}', [BookingController::class, 'create'])->name('booking.create');
    Route::get('/phong/{id}', [HomeController::class, 'show'])->name('room.detail');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('hotels', HotelController::class)->except('show');
        Route::get('/index', [HotelController::class, 'index']);
        Route::get('/pending', [HotelController::class, 'pendingView']);
    });

require __DIR__ . '/auth.php';
