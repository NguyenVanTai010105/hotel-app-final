<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Trang chủ (public)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Quản lý phòng (Admin) - giữ nguyên posts resource của bạn
// Quản lý Post (phòng)
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('posts', PostController::class)->except(['show']);
        Route::delete('posts/images/{image}', [PostController::class, 'destroyImage'])->name('admin.posts.images.destroy');



        // Admin quản lý booking
        Route::resource('bookings', AdminBookingController::class)
            ->only(['index','show','update','destroy']);
    });


// Public booking routes (từ frontend)
Route::get('rooms/{post}', [BookingController::class, 'show'])->name('rooms.show'); // xem chi tiết phòng + form đặt
Route::post('bookings', [BookingController::class, 'store'])->name('bookings.store'); // lưu booking
Route::get('bookings/{booking}/thanks', [BookingController::class, 'thanks'])->name('bookings.thanks'); // thank you
