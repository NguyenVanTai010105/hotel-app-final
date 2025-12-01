<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController; // Đưa dòng này lên đầu file để tránh lỗi

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. TRANG CHỦ (Code Mới)
// Khi vào trang chủ (dấu /), sẽ gọi hàm index để hiện danh sách phòng
// Thay thế cho trang 'welcome' mặc định cũ
Route::get('/', [RoomController::class, 'index'])->name('home');

// 2. TRANG CHI TIẾT (Code Cũ - Giữ nguyên)
// Khi vào link /phong/ten-phong -> gọi hàm show
Route::get('/phong/{slug}', [RoomController::class, 'show'])->name('room.detail');