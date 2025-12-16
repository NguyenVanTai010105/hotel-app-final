<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use App\Notifications\BookingRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class BookingController extends Controller
{
    public function store(Request $request, $room)
    {
        DB::transaction(function () use ($request, $room) {
            $data = $request->validate([
                'email' => 'required|email',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'des' => 'nullable|max:100'
            ]);
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'email' => $data['email'],
                'room_id' => $room,
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'status' => 'pending',
                'des' => $data['des']
            ]);
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new BookingRequestNotification($booking));
            }
            return back()->with('status', 'Gửi yêu cầu đặt phòng thành công');
        });
    }
    public function create($id)
    {
        $room = Room::findOrFail($id);
        return view('booking.create', compact('room'));
    }
}
