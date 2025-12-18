@extends('layouts.app')

@section('content')
    <form method="GET" action="{{ route('rooms.search') }}" class="mb-6 flex justify-center flex-wrap gap-4">
        <a href="{{ route('rooms.all') }}"
            class="flex group items-center justify-center w-10 h-10 rounded-full hover:scale-110 hover:translate-x-[-5px] bg-[#0D4440] hover:bg-[#F5A623] transform transition-transform duration-200">
            <i class="fa-solid fa-circle-arrow-left group-hover:text-[#0D4440] text-[#F5A623] text-lg"></i>
        </a>
        <input type="text" name="type" placeholder="Chỉ có vip và standard"
            class="border-[#0D4440] rounded-md px-3 py-2  focus:outline-none focus:ring-0" value="{{ request('name') }}">

        <select name="status" class="border-[#0D4440] px-5 py-2 rounded-md focus:outline-none focus:ring-0">
            <option value="">Trạng thái</option>
            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Còn trống</option>
            <option value="not available" {{ request('status') == 'not available' ? 'selected' : '' }}>Đã đặt
            </option>
        </select>

        <input type="number" name="capacity" placeholder="Sức chứa ≥"
            class="border-[#0D4440] focus:outline-none focus:ring-0 px-3 py-2 rounded-md" value="{{ request('capacity') }}">

        <input type="number" name="min_price" placeholder="Giá từ 300000"
            class="border-[#0D4440] px-3 focus:outline-none focus:ring-0 py-2 rounded-md"
            value="{{ request('min_price') }}">
        <input type="number" name="max_price" placeholder="Đến"
            class="border-[#0D4440] px-3 focus:outline-none focus:ring-0 py-2 rounded-md"
            value="{{ request('max_price') }}">

        <button type="submit"
            class="bg-[#0D4440] text-[#F5A623] px-4 py-2 rounded-2xl hover:scale-110 hover:bg-[#F5A623] hover:text-[#0D4440] transition-all duration-200">Tìm
            kiếm</button>
    </form>

    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold mb-6">Tất cả phòng</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($rooms as $room)
                <div
                    class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl overflow-hidden transition-all duration-300">

                    {{-- Ảnh --}}
                    <div class="relative">
                        <img src="{{ asset('storage/' . $room->image) }}"
                            class="w-full h-64 object-cover group-hover:scale-105 transition-all duration-500" />

                        <span
                            class="absolute top-3 right-3 bg-gradient-to-r from-red-500 to-red-400
                            text-white text-sm px-3 py-1 rounded-lg shadow">
                            Hot
                        </span>
                    </div>

                    {{-- Nội dung --}}
                    <div class="p-6">

                        <h3 class="text-2xl font-bold text-indigo-900 mb-2 group-hover:text-red-500 transition">
                            {{ $room->name }}
                        </h3>

                        <p class="text-gray-500 text-sm mb-3 flex items-center space-x-3">
                            <span><i class="fa-solid fa-bed mr-1"></i> {{ $room->type }}</span>
                            <span>|</span>
                            <span><i class="fa-solid fa-user-group mr-1"></i> {{ $room->capacity }} Khách</span>
                        </p>

                        <p class="text-gray-600 leading-relaxed mb-6">
                            {{ Str::limit($room->description, 80) }}
                        </p>

                        <div class="flex justify-between items-center border-t pt-4">

                            <div>
                                <p class="text-red-500 font-extrabold text-2xl">
                                    {{ number_format($room->price) }} VNĐ
                                </p>
                                <span class="text-gray-500 text-xs">/ đêm</span>
                            </div>

                            <a href="{{ route('room.detail', $room->id) }}"
                                class="px-6 py-2 rounded-full font-semibold border border-red-500 text-red-500
                                hover:bg-red-500 hover:text-white transition-all duration-300 shadow-sm">
                                Xem chi tiết
                            </a>
                        </div>

                    </div>

                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $rooms->links('pagination::simple-tailwind') }}
        </div>


    </div>
@endsection
