<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room; // Quan trọng: Phải gọi Model Room vào

class HomeController extends Controller
{
    public function index()
    {
        // LOGIC: Lấy 3 phòng mới nhất đang "available"
        $featuredRooms = Room::where('status', 'available')
                             ->orderBy('created_at', 'desc')
                             ->take(3)
                             ->get();

        return view('home', compact('featuredRooms'));
    }
}