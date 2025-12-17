@extends('layouts.app')
@section('title', 'Danh sách hàng đợi')


@section('content')

    <body class="bg-gray-100">
        <div class="max-w-6xl mx-auto mt-10 px-4">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Yêu cầu đặt phòng</h1>
            </div>
            @php
                $notifications = Auth::user()->notifications->all();
            @endphp
            <!-- List requests -->
            <div class="space-y-6">
                @foreach ($notifications as $notification)
                    <div
                        class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-lg transition-all duration-300">

                        <div class="flex flex-col lg:flex-row justify-between gap-6">

                            <!-- Thông tin -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600">
                                <p>
                                    Người dùng:
                                    <span class="font-semibold text-gray-900">
                                        {{ $notification->data['user_name'] }}
                                    </span>
                                </p>

                                <p>
                                    Email:
                                    <span class="font-semibold text-gray-900">
                                        {{ $notification->data['email'] ?? '—' }}
                                    </span>
                                </p>

                                <p>
                                    Phòng:
                                    <span class="font-semibold text-gray-900">
                                        {{ $notification->data['room_name'] ?? '—' }}
                                    </span>
                                </p>

                                <p>
                                    Check-in:
                                    <span class="font-semibold text-gray-900">
                                        {{ $notification->data['start_date'] ?? '—' }}
                                    </span>
                                </p>

                                <p>
                                    Check-out:
                                    <span class="font-semibold text-gray-900">
                                        {{ $notification->data['end_date'] ?? '—' }}
                                    </span>
                                </p>

                                <p class="sm:col-span-2">
                                    Thông điệp:
                                    <span class="font-semibold text-gray-900">
                                        {{ $notification->data['des'] ?? '—' }}
                                    </span>
                                </p>
                            </div>

                            <!-- Hành động -->
                            <div class="flex flex-row lg:flex-col gap-3 shrink-0 lg:justify-between h-full">

                                <!-- DUYỆT -->
                                <form method="POST"
                                    action="{{ route('admin.accept', $notification->data['booking_id']) }}">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex w-full items-center justify-center px-4 py-2 rounded-lg
                   bg-green-600 text-white font-medium
                   hover:bg-green-700 transition
                   hover:scale-105 active:scale-95">
                                        Duyệt
                                    </button>
                                </form>

                                <!-- TỪ CHỐI -->
                                <form method="POST"
                                    action="{{ route('admin.reject', $notification->data['booking_id']) }}">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex w-full items-center justify-center px-4 py-2 rounded-lg
                   bg-red-600 text-white font-medium
                   hover:bg-red-700 transition
                   hover:scale-105 active:scale-95">
                                        Từ chối
                                    </button>
                                </form>

                            </div>


                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </body>
@endsection
