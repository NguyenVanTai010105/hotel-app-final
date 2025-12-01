<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room; // Gọi Model Room để lấy thông tin phòng

class BookingController extends Controller
{
    // Hàm hiện Form đặt phòng
    public function create($id)
    {
        // 1. Tìm phòng theo ID. Nếu không thấy (ví dụ khách gõ bừa ID 9999) thì báo lỗi 404
        $room = Room::findOrFail($id);

        // 2. Trả về View và gửi kèm thông tin phòng ($room) sang đó
        return view('booking.create', compact('room'));
    }

    // Hàm xử lý lưu đơn hàng (Mockup cho Duy làm tiếp)
    public function store(Request $request)
    {
        // Validate dữ liệu cơ bản
        $request->validate([
            'fullname' => 'required',
            'phone' => 'required',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
        ]);

        // Code xử lý lưu vào DB sẽ viết ở đây...
        
        // Tạm thời hiện thông báo thành công
        return "<h1>Đã nhận đơn đặt phòng của: " . $request->fullname . "</h1><p>Check-in: " . $request->checkin . "</p>";
    }
}