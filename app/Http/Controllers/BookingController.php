<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use App\Notifications\BookingRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $data['room_id'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Đã gửi yêu cầu. Admin sẽ xét duyệt.',
            'booking' => $booking
        ], 201);
    }
    public function create($id)
    {
        $room = Room::findOrFail($id);
        return view('booking.create', compact('room'));
    }
}
