<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Post;
use App\Models\Booking; // nếu có Booking Model

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share dữ liệu cho sidebar admin
        View::composer('partials.admin_sidebar', function ($view) {

            $postsCount = Post::count();

            // Nếu Booking model chưa tạo thì fallback DB::table
            $bookingsCount = class_exists(Booking::class)
                ? Booking::count()
                : \DB::table('bookings')->count();

            $postsList = Post::orderBy('title')->get(['id', 'title']);

            $view->with([
                'postsCount' => $postsCount,
                'bookingsCount' => $bookingsCount,
                'postsList' => $postsList,
            ]);
        });
    }
}
