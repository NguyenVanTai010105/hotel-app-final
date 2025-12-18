<?php

namespace App\Http\Controllers;

use App\Mail\BookingSuccessMail;
use App\Mail\RejectBooking;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use App\Notifications\BookingRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
        $exitsEmail = Booking::where('email', $data['email'])->where('status', 'pending')->where('room_id', $room)->exists();
        if ($exitsEmail) {
            return back()->with('status', 'Bạn đã gửi yêu cầu đặt phòng này trước đó rồi');
        }
        DB::transaction(function () use ($data, $room) {

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
        });
        return back()->with('status', 'Gửi yêu cầu đặt phòng thành công');
    }
    public function create($id)
    {
        $room = Room::findOrFail($id);
        return view('booking.create', compact('room'));
    }
    public function approve($notificationId)
    {
        // 1️⃣ Lấy notification bằng UUID
        $notification = DatabaseNotification::findOrFail($notificationId);

        // 2️⃣ Lấy booking_id từ data
        $bookingId = $notification->data['booking_id'];

        // 3️⃣ Lấy booking
        $booking = Booking::with(['user', 'room'])->findOrFail($bookingId);

        // 4️⃣ Gửi mail
        Mail::to($booking->email)->send(new BookingSuccessMail($booking));

        // 5️⃣ Xóa notification
        $notification->delete();

        return back()->with('status', 'Duyệt thành công');
    }

    public function reject($notificationId)
    {
        $notification = DatabaseNotification::findOrFail($notificationId);

        $booking = Booking::with(['user', 'room'])
            ->findOrFail($notification->data['booking_id']);

        Mail::to($booking->email)->send(new RejectBooking($booking));

        $notification->delete();

        return back()->with('status', 'Đã từ chối');
    }
}
