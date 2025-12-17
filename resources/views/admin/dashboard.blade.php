@extends('layouts.app')
@section('title', 'Trang admin')


@section('content')


    <body>
        <div class="flex  bg-gray-50 ">
            <!-- Main Content -->
            <!-- Sidebar -->
            <div class="w-96 bg-white border-l rounded-xl border-gray-200  shadow-xl flex flex-col">
                <!-- Header -->
                <div class="p-6 border-b border-gray-200 bg-gradient-to-r rounded-xl from-amber-50 to-orange-50">
                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="w-10 h-10 rounded-full bg-amber-600 text-white flex items-center justify-center font-bold text-sm">
                            A
                        </div>
                        <div>
                            <p class="text-xs text-gray-600">Đăng nhập với</p>
                            <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Danh Sách Phòng</h2>
                    <p class="text-sm text-gray-600 mt-1">
                        Tổng: <span id="totalCount" class="font-semibold">{{ $totalRoom }}</span> phòng
                    </p>
                </div>

                <!-- Tabs -->
                <div class="flex gap-0 border-b border-gray-200 px-4 pt-4">
                    <button
                        class="filterTab flex-1 py-3 px-3 text-sm font-medium text-center rounded-t-lg transition-all active"
                        data-filter="all">
                        <span class="block">Tất Cả</span>
                        <span class="text-xs text-gray-500" id="count-all">{{ $totalRoom }}</span>
                    </button>
                    <button class="filterTab flex-1 py-3 px-3 text-sm font-medium text-center rounded-t-lg transition-all"
                        data-filter="available">
                        <span class="block">Còn Trống</span>
                        <span class="text-xs text-green-600 font-semibold" id="count-available">{{ $available }}</span>
                    </button>
                    <button class="filterTab flex-1 py-3 px-3 text-sm font-medium text-center rounded-t-lg transition-all"
                        data-filter="occupied">
                        <span class="block">Đang Bận</span>
                        <span class="text-xs text-red-600 font-semibold" id="count-occupied">{{ $not_available }}</span>
                    </button>
                </div>

                <!-- Rooms List -->

                <div id="roomsList" class="flex-1 overflow-y-auto p-4 space-y-3">

                    <!-- Room card -->
                    @foreach ($rooms as $room)
                        <div
                            class="bg-white rounded-xl border p-4 flex justify-between items-center hover:shadow transition">

                            <!-- Left info -->
                            <div>
                                <h3 class="text-sm font-semibold text-gray-800">
                                    Phòng {{ $room->name }}
                                </h3>
                                <p class="text-xs text-gray-500">
                                    {{ $room->type }} • {{ $room->capacity }} người
                                </p>
                            </div>

                            <!-- Right info -->
                            <div class="text-right">
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ number_format($room->price, 0, ',', '.') }}
                                </p>
                                <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-600">
                                    {{ $room->status }}
                                </span>
                            </div>

                        </div>
                    @endforeach

                </div>



                <!-- Footer -->
                <div class="p-4 border-t border-gray-200 bg-gray-50 text-xs text-gray-600">
                    <div class="flex justify-between mb-2">
                        <span>Phòng còn trống:</span>
                        <span class="font-semibold text-green-600" id="footerAvailable">{{ $available }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Phòng đang bận:</span>
                        <span class="font-semibold text-red-600" id="footerOccupied">{{ $not_available }}</span>
                    </div>
                </div>
            </div>
            <div class="flex-1 ml-5">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h1 class="text-3xl font-extrabold text-gray-900 mb-1">
                        Quản Lý Phòng
                    </h1>
                    <p class="text-gray-600 mb-6">
                        Tổng quan hệ thống và trạng thái hiện tại
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <!-- Total Accounts -->
                        <div
                            class="flex items-center justify-between p-4 hover:shadow-xl hover:scale-105 transition-transform duration-300 rounded-xl bg-gray-50 border">
                            <div>
                                <p class="text-sm text-gray-500">Tổng số tài khoản</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ $totalAcc ?? 0 }}
                                </p>
                            </div>
                            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-100 text-blue-600">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>

                        <!-- Total Bookings -->
                        <div class="flex items-center justify-between p-4 hover:shadow-xl hover:scale-105 transition-transform duration-300 rounded-xl bg-gray-50 border shadow-sm"
                            id="request_booking">
                            <!-- Text info -->
                            <div>
                                <p class="text-sm text-gray-500">Yêu cầu đặt phòng</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ $allNotifications->count() ?? 0 }}
                                </p>
                            </div>

                            <!-- Icon với badge -->
                            <div
                                class="relative w-12 h-12 flex items-center justify-center rounded-full bg-green-100 text-green-600">
                                <i class="fas fa-calendar-check text-2xl"></i>

                                @php
                                    $countBadge = Auth::user()->unreadNotifications->count();
                                @endphp

                                @if ($countBadge > 0)
                                    <span
                                        class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full font-semibold">
                                        {{ $countBadge > 9 ? '9+' : $countBadge }}
                                    </span>
                                @endif
                            </div>
                        </div>


                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 my-5 gap-6  overflow-y-auto">

                    @foreach ($rooms as $room)
                        <div
                            class="bg-white rounded-2xl border  border-gray-200 overflow-hidden
               hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

                            <!-- Image -->
                            <div class="relative">
                                <img src="{{ asset('images/' . $room->image) }}" alt="Room image"
                                    class="w-full h-44 object-cover">

                                <!-- Status badge -->
                                <span
                                    class="absolute top-3 right-3 text-xs px-3 py-1 rounded-full font-medium
                {{ $room->status === 'available' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    {{ ucfirst($room->status) }}
                                </span>
                            </div>

                            <!-- Content -->
                            <div class="p-4 space-y-2">

                                <!-- Name -->
                                <h3 class="text-lg font-semibold text-gray-800 truncate">
                                    {{ $room->name }}
                                </h3>

                                <!-- Type + Capacity -->
                                <p class="text-sm text-gray-500">
                                    {{ $room->type }} • {{ $room->capacity }} người
                                </p>

                                <!-- Description -->
                                <p class="text-sm text-gray-600 line-clamp-2">
                                    {{ $room->description }}
                                </p>

                                <!-- Divider -->
                                <div class="border-t pt-3 flex items-center justify-between">
                                    <span class="text-lg font-bold text-gray-900">
                                        {{ number_format($room->price, 0, ',', '.') }}₫
                                    </span>

                                    <button
                                        class="text-sm px-4 py-1.5 rounded-lg bg-gray-900 text-white
                           hover:bg-gray-800 transition">
                                        Sửa
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>


            </div>
        </div>
    </body>
    <script>
        const request_booking = document.getElementById('request_booking');
        request_booking.addEventListener('click', () => {
            window.location.href = '{{ route('admin.pending') }}'
        })
    </script>

@endsection
