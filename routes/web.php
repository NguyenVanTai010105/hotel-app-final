<?php

use App\Http\Controllers\Admin\PostController;

Route::get('/', function () {
    return redirect()->route('admin.posts.index');
});

// Tạm bỏ auth để test
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('posts', PostController::class)->except(['show']);
});
