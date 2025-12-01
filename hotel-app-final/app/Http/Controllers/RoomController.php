<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function create()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:available,booked,maintenance',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name','type','capacity','price','description','status']);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->name) . '_' . time() . '.' . $request->image->extension();
            $request->image->storeAs('public/rooms', $imageName);
            $data['image'] = 'storage/rooms/' . $imageName;
        }

        Room::create($data);

        return redirect()->back()->with('success', 'Đã thêm phòng thành công!');
    }
}
