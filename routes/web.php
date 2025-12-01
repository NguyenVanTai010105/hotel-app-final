<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;

// 1. Trang Chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Trang Đặt Phòng (Nhận ID phòng để biết khách đặt phòng nào)
// Ví dụ: /dat-phong/1 là đặt phòng ID 1
Route::get('/dat-phong/{id}', [BookingController::class, 'create'])->name('booking.create');

// 3. Xử lý khi bấm nút "Xác nhận" (Duy sẽ xử lý lưu vào DB ở đây)
Route::post('/dat-phong/luu', [BookingController::class, 'store'])->name('booking.store');

// 4. Route trang chi tiết (Để đó dự phòng)
Route::get('/room/{id}', function($id) { return "Trang chi tiết phòng $id"; })->name('room.detail');