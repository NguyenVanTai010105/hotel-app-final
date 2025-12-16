@extends('layouts.app')
@section('title', 'Danh sách hàng đợi')


@section('content')

    <body class="bg-gray-100">
        <div class="max-w-6xl mx-auto mt-10 px-4">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Yêu cầu đặt phòng</h1>
                <div class="relative">
                    <i class="fas fa-calendar-check text-4xl text-green-600"></i>
                    <span
                        class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-6 h-6 flex items-center justify-center rounded-full font-semibold">
                        3
                    </span>
                </div>
            </div>

            <!-- List requests -->
            <div class="space-y-6">
                <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200 hover:shadow-xl transition">
                    <div class="flex justify-between items-start gap-6">
                        <!-- Info chi tiết -->
                        <div class="space-y-2">
                            <p class="text-gray-500 text-sm">
                                Người dùng: <span class="font-semibold">Nguyễn Văn A</span>
                            </p>
                            <p class="text-gray-500 text-sm">
                                Email: <span class="font-semibold">user@example.com</span>
                            </p>
                            <p class="text-gray-500 text-sm">
                                Phòng: <span class="font-semibold">Phòng 101</span>
                            </p>
                            <p class="text-gray-500 text-sm">
                                Check-in: <span class="font-semibold">2025-12-20</span>
                            </p>
                            <p class="text-gray-500 text-sm">
                                Check-out: <span class="font-semibold">2025-12-22</span>
                            </p>
                            <p class="text-gray-500 text-sm">
                                Thông điệp:
                                <span class="font-semibold">Xin được đặt phòng VIP</span>
                            </p>
                        </div>

                        <!-- Hành động -->
                        <div class="flex flex-col gap-3">
                            <a href="#"
                                class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition text-center font-medium">
                                Xem chi tiết
                            </a>
                            <button
                                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition font-medium">
                                Duyệt
                            </button>
                            <button
                                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition font-medium">
                                Từ chối
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Bạn có thể lặp nhiều card bằng Blade @foreach -->
            </div>
        </div>
    </body>
@endsection
