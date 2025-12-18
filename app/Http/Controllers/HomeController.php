<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    //
    public function index()
    {
        $rooms =  Room::take(9)->get();
        return view('welcome', compact('rooms'));
    }
    public function show($id)
    {
        $room = Room::findOrFail($id);
        $relatedRooms = Room::where('id', '!=', $room->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('rooms.detail', compact('room', 'relatedRooms'));
    }
    public function contact()
    {

        return view('contactUs');
    }
    public function contactStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|max:255'

        ]);
        Mail::to('combany36@gmail.com')->send(new ContactMail($data));
        return back()->with('status', 'Ý kiến của bạn đã được gửi!');
    }
    public function all()
    {
        $rooms = Room::latest()->paginate(9);
        return view('rooms.all', compact('rooms'));
    }
    public function search(Request $request)
    {
        $query = Room::query();

        // Tìm theo tên phòng
        if ($request->filled('type')) {
            $query->where('type', 'like', '%' . $request->type . '%');
        }

        // Tìm theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Nếu có thêm các tiêu chí khác, ví dụ số lượng người hoặc giá
        if ($request->filled('capacity')) {
            $query->where('capacity', '>=', $request->capacity);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sắp xếp theo mới nhất và phân trang
        $rooms = $query->latest()->paginate(9)->withQueryString();

        return view('rooms.all', compact('rooms'));
    }
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        // $request->session()->regenerateToken();
        return redirect('/login');
    }
}
