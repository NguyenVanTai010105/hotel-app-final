<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room; // Giữ nguyên dòng này để gọi Model Room

class RoomController extends Controller
{
    /**
     * CHỨC NĂNG MỚI: Trang chủ
     * Hiển thị danh sách tất cả các phòng
     */
    public function index()
    {
        // Lấy tất cả dữ liệu trong bảng rooms
        $rooms = Room::all();
        
        // Trả về view 'home' và truyền biến $rooms sang đó
        return view('home', compact('rooms'));
    }

    /**
     * CHỨC NĂNG CŨ (Được nâng cấp): Chi tiết phòng
     * Hiển thị thông tin một phòng cụ thể dựa vào slug
     */
    public function show($slug)
    {
        // 1. Lấy thông tin phòng hiện tại
        $room = Room::with('images')->where('slug', $slug)->firstOrFail();

        // 2. Lấy danh sách "Phòng tương tự"
        // Logic: Lấy 3 phòng bất kỳ, TRỪ phòng hiện tại ra (để không bị trùng)
        $relatedRooms = Room::where('id', '!=', $room->id)
                            ->inRandomOrder() // Lấy ngẫu nhiên
                            ->limit(3)        // Chỉ lấy 3 phòng
                            ->get();

        // 3. Truyền cả $room và $relatedRooms sang View
        return view('rooms.detail', compact('room', 'relatedRooms'));
    }
}