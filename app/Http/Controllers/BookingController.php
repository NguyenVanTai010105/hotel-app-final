<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Post;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    // Show room detail + booking form
    public function show(Post $post)
    {
        return view('rooms.show', compact('post'));
    }

    // Store booking
    public function store(StoreBookingRequest $request)
    {
        $data = $request->validated();

        $post = Post::findOrFail($data['post_id']);

        // Check availability
        if (! $post->isAvailableBetween($data['check_in'], $data['check_out'])) {
            return back()->withInput()->withErrors(['check_in' => 'Phòng không khả dụng cho khoảng ngày bạn chọn.']);
        }

        // Calculate nights and total price
        $checkIn = Carbon::parse($data['check_in']);
        $checkOut = Carbon::parse($data['check_out']);
        $nights = $checkIn->diffInDays($checkOut);
        $data['total_price'] = ($post->price ?? 0) * $nights;

        $booking = Booking::create($data);

        // Optionally: send email / notifications here

        return redirect()->route('bookings.thanks', $booking->id)->with('success','Đặt phòng thành công.');
    }

    // Thank you page
    public function thanks(Booking $booking)
    {
        return view('bookings.thanks', compact('booking'));
    }
}
