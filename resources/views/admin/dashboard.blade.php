@extends('layouts.app')
@section('title', 'Trang admin')


@section('content')
    <div class="min-h-screen bg-gray-100 p-6">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Hotel Admin Dashboard</h1>

            <a href="{{ route('logout') }}" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                Đăng xuất
            </a>
        </div>

        <!-- OVERVIEW CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

            <div class="bg-white shadow-lg p-5 rounded-xl border-l-4 border-indigo-600">
                <h3 class="text-gray-600 text-sm">Tổng số phòng</h3>
                <p class="text-3xl font-bold text-gray-800">{{ $totalRoom }}</p>
            </div>

            <div class="bg-white shadow-lg p-5 rounded-xl border-l-4 border-green-600">
                <h3 class="text-gray-600 text-sm">Phòng đang đặt</h3>
                <p class="text-3xl font-bold text-gray-800">45</p>
            </div>

            <a href="">
                <div class="bg-white shadow-lg p-5 rounded-xl border-l-4 border-yellow-500">
                    <h3 class="text-gray-600 text-sm">Đang chờ duyệt</h3>
                    <p class="text-3xl font-bold text-gray-800">12</p>
                </div>
            </a>

            <div class="bg-white shadow-lg p-5 rounded-xl border-l-4 border-red-500">
                <h3 class="text-gray-600 text-sm">Khách hủy phòng</h3>
                <p class="text-3xl font-bold text-gray-800">5</p>
            </div>

        </div>

        <!-- MAIN GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- TABLE: Recently Booked -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Đặt phòng gần đây</h2>

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="p-3 font-semibold">Khách hàng</th>
                            <th class="p-3 font-semibold">Phòng</th>
                            <th class="p-3 font-semibold">Ngày đặt</th>
                            <th class="p-3 font-semibold">Trạng thái</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="border-b">
                            <td class="p-3">Nguyễn Văn A</td>
                            <td class="p-3">Deluxe – #204</td>
                            <td class="p-3">01/12/2025</td>
                            <td class="p-3">
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">Đã xác nhận</span>
                            </td>
                        </tr>

                        <tr class="border-b">
                            <td class="p-3">Trần Thị B</td>
                            <td class="p-3">Suite – #307</td>
                            <td class="p-3">30/11/2025</td>
                            <td class="p-3">
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">Chờ duyệt</span>
                            </td>
                        </tr>

                        <tr class="border-b">
                            <td class="p-3">Phạm Quốc C</td>
                            <td class="p-3">VIP Ocean – #502</td>
                            <td class="p-3">29/11/2025</td>
                            <td class="p-3">
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">Đã hủy</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- NOTIFICATION PANEL -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Thông báo</h2>

                <div class="space-y-4">
                    <div class="p-4 bg-blue-50 border-l-4 border-blue-600 rounded">
                        <p class="text-sm text-gray-700">Khách hàng vừa đặt phòng Deluxe – #204</p>
                    </div>

                    <div class="p-4 bg-green-50 border-l-4 border-green-600 rounded">
                        <p class="text-sm text-gray-700">Thanh toán thành công cho phòng Suite – #310</p>
                    </div>

                    <div class="p-4 bg-yellow-50 border-l-4 border-yellow-600 rounded">
                        <p class="text-sm text-gray-700">Yêu cầu chỉnh sửa đặt phòng #502</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
