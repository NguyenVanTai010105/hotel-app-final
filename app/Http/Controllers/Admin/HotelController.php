<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $rooms = Room::latest()->paginate(9);
        $totalRoom = Room::count();
        $totalAcc = User::count();
        $not_available = Room::where('status', 'not available')->count();
        $available = Room::where('status', 'available')->count();
        $admin = Auth::user();
        $allNotifications = $admin->notifications;
        return view('admin.dashboard', compact('totalRoom', 'rooms', 'not_available', 'available', 'totalAcc', 'allNotifications'));
    }
    public function pendingView()
    {
        return view('admin.pending');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:10',
                'capacity' => 'required|integer|min:1|max:10',
                'price' => 'required|numeric|min:0|max:1000000',
                'description' => 'nullable|string',
                'status' => 'required|in:available,not_available',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ],
            [
                'name.max' => 'Quá ký tự',
                'capacity.min' => 'Sức chứa luôn lớn hơn 0',
                'capacity.max' => 'Sức chứa luôn bé hơn hoặc bằng 10',
                'price.min' => 'Giá phòng quá thấp',
                'price.max' => 'Giá phòng dưới 1M',
                'image.max' => 'Kích thước file phải bé hơn 2048',
                'image.mimes' => 'Phải là ảnh dạng jpeg,png,jpg,gif'

            ]

        );

        // Xử lý upload ảnh
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '.' . $file->getClientOriginalName();
            $imagePath = $file->storeAs('images', $imageName);
        }

        // Tạo phòng
        $room = Room::create([
            'name' => $request->name,
            'type' => $request->type,
            'capacity' => $request->capacity,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.index')->with('status', "Tạo phòng #{$room->id} thành công!");
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $room = Room::findOrFail($id);
        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        // Validate dữ liệu
        $request->validate(
            [
                'name' => 'nullable|string|max:255',
                'capacity' => 'nullable|integer|min:1|max:10',
                'price' => 'nullable|numeric|min:0|max:1000000',
                'description' => 'nullable|string',
                'status' => 'nullable|in:available,not_available',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ],
            [
                'name.max' => 'Quá ký tự',
                'capacity.min' => 'Sức chứa luôn lớn hơn 0',
                'capacity.max' => 'Sức chứa luôn bé hơn hoặc bằng 10',
                'price.min' => 'Giá phòng quá thấp',
                'price.max' => 'Giá phòng dưới 1M',
                'image.max' => 'Kích thước file phải bé hơn 2048',
                'image.image' => 'Phải là ảnh dạng jpeg,png,jpg,gif'

            ]
        );


        // Nếu có upload ảnh mới
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('public/images', $imageName);
            // Cập nhật các trường khác
            $room->name = $request->name;
            $room->capacity = $request->capacity;
            $room->price = $request->price;
            $room->description = $request->description;
            $room->status = $request->status;
            $room->image = $path;
            $room->save();
        } else {
            $room->name = $request->name;
            $room->capacity = $request->capacity;
            $room->price = $request->price;
            $room->description = $request->description;
            $room->status = $request->status;
            $room->save();
        }


        return redirect()->route('admin.index')
            ->with('status', "Cập nhật phòng #{$room->id} thành công!");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);

        if ($room->image) {
            Storage::delete('public/' . $room->image);
        }
        $room->delete();
        return redirect()->route('admin.index')->with('status', 'Bài viết đã được xóa!');


        //
    }
}
