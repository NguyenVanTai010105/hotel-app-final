<?php

use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('phong/{id}', [HomeController::class, 'show'])->name('room.detail');
Route::get('/rooms/all', [HomeController::class, 'all'])->name('rooms.all');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactStore'])->name('contactStore');
Route::get('/rooms/search', [HomeController::class, 'search'])->name('rooms.search');

Route::get('booking', [HomeController::class, 'index'])->name('book');
Route::middleware('auth')->group(function () {
    //xác thực
    Route::get('sendOTP', [EmailVerificationNotificationController::class, 'sendOTP'])->name('sendOTP');
    Route::get('verifyIndex', [EmailVerificationNotificationController::class, 'view'])->name('viewVerify');
    Route::post('verify', [EmailVerificationNotificationController::class, 'verify'])->name('verify_post');
    Route::post('resend', [EmailVerificationNotificationController::class, 'resend'])->name('resendOTP');
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('destroy', [HomeController::class, 'destroy'])->name('logout');
});
Route::middleware(['auth', 'verifyUser'])->group(function () {
    //Đặt phòng
    Route::get('dat-phong/{id}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('dat-phong/{room}', [BookingController::class, 'store'])->name('booking.store');
});
Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('hotels', HotelController::class)->except('show');
        Route::get('index', [HotelController::class, 'index'])->name('index');
        Route::post('destroy/{id}', [HotelController::class, 'destroy'])->name('delete');



        // chỉnh sửa
        Route::get('rooms/edit/{id}', [HotelController::class, 'edit'])->name('edit');
        Route::post('rooms/edit/{id}', [HotelController::class, 'update'])->name('update');
        // đăng phòng

        Route::get('rooms/create', [HotelController::class, 'create'])->name('create');
        Route::post('rooms/create', [HotelController::class, 'store'])->name('store');

        Route::get('pending', [HotelController::class, 'pendingView'])->name('pending');
        Route::post('pending/accept/{id}', [BookingController::class, 'approve'])->name('accept');
        Route::post('pending/reject/{id}', [BookingController::class, 'reject'])->name('reject');
    });

require __DIR__ . '/auth.php';
