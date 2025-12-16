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
    public function store(Request $request, $room)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'des' => 'nullable|max:100'
        ]);
        Booking::create([
            'user_id' => Auth::id(),
            'email' => $data['email'],
            'room_id' => $room,
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'status' => 'pending',
            'des' => $data['des']
        ]);
        return back()->with('status', 'Gửi yêu cầu đặt phòng thành công');
    }
    public function create($id)
    {
        $room = Room::findOrFail($id);
        return view('booking.create', compact('room'));
    }
}
