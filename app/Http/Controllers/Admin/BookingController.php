<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Post;
use App\Http\Requests\UpdateBookingRequest;

class BookingController extends Controller
{
    /**
     * Hiển thị danh sách booking (admin).
     * Hỗ trợ filter ?post=ID để chỉ xem booking cho phòng cụ thể.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['post', 'user'])->orderBy('created_at', 'desc');

        if ($request->filled('post')) {
            $query->where('post_id', $request->post);
        }

        $bookings = $query->paginate(12)->withQueryString();

        // nếu bạn muốn hiển thị danh sách phòng trong view (dropdown lọc)
        $posts = Post::orderBy('title')->get(['id', 'title']);

        return view('admin.bookings.index', compact('bookings', 'posts'));
    }

    /**
     * Hiển thị chi tiết 1 booking.
     */
    public function show(Booking $booking)
    {
        $booking->load(['post', 'user']);
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Cập nhật booking (ví dụ: đổi trạng thái).
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $booking->update($request->validated());

        return redirect()
            ->route('admin.bookings.show', $booking)
            ->with('success', 'Cập nhật booking thành công.');
    }

    /**
     * Xóa booking.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Đã xóa booking.');
    }
}
