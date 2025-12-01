<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\RoomController;

Route::get('/index', [RoomController::class, 'create'])->name('rooms.create');
Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
