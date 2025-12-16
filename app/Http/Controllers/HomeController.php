<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
