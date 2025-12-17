@extends('layouts.app')
@section('title')

@section('content')
    @if (session('notAuthentication'))
        <div class="mb-4 rounded-lg flex justify-between bg-red-100 px-4 py-3 text-red-800 border border-red-300">
            <div>{{ session('notAuthentication') }}</div>
            <div class="hover:text-[red]"><a href="{{ route('sendOTP') }}">Xác thực ngay tại đây</a></div>

        </div>
    @endif

    <body class="bg-gray-50">

        <!-- Navbar -->


        <div class="container mx-auto px-4 mb-12">
            <!-- Breadcrumb -->


            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Images & Details -->
                <div class="lg:col-span-2">
                    <!-- Main Image -->
                    <div class="mb-4 relative">
                        <img id="mainImage" src="{{ asset('images/' . $room->image) }}"
                            class="w-full h-[450px] object-cover rounded-lg shadow-lg" alt="{{ $room->name }}">
                        <span
                            class="absolute top-3 left-3 bg-yellow-400 text-gray-900 px-4 py-2 rounded-lg font-semibold text-base shadow">
                            {{ $room->type }}
                        </span>
                    </div>

                    <!-- Thumbnail Images -->
                    {{-- @if ($room->images->count() > 0)
                        <p class="font-bold text-gray-600 mb-2">Hình ảnh chi tiết:</p>
                        <div class="grid grid-cols-6 gap-2 mb-6">
                            <div>
                                <img src="{{ $room->image }}"
                                    class="h-20 w-full object-cover rounded border-2 border-transparent hover:border-blue-600 hover:opacity-80 cursor-pointer transition-all duration-200"
                                    onclick="changeImage(this.src)">
                            </div>
                            @foreach ($room->images as $img)
                                <div>
                                    <img src="{{ $img->image_path }}"
                                        class="h-20 w-full object-cover rounded border-2 border-transparent hover:border-blue-600 hover:opacity-80 cursor-pointer transition-all duration-200"
                                        onclick="changeImage(this.src)">
                                </div>
                            @endforeach
                        </div>
                    @endif --}}

                    <!-- Description Card -->
                    <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                        <h3 class="text-2xl font-bold mb-4">Mô tả phòng</h3>
                        <p class="text-gray-600 leading-relaxed mb-6">{{ $room->description }}</p>

                        <hr class="my-6 border-gray-200">

                        <!-- Amenities -->
                        <h5 class="text-xl font-bold mb-4">Tiện nghi có sẵn</h5>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                            <div class="flex items-center space-x-2">
                                <i class="bi bi-wifi text-blue-600"></i>
                                <span class="text-gray-700">Wifi miễn phí</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="bi bi-snow text-cyan-600"></i>
                                <span class="text-gray-700">Điều hòa 2 chiều</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="bi bi-tv text-gray-900"></i>
                                <span class="text-gray-700">Smart TV 4K</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="bi bi-cup-hot text-yellow-600"></i>
                                <span class="text-gray-700">Máy pha cà phê</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="bi bi-safe text-gray-600"></i>
                                <span class="text-gray-700">Két an toàn</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="bi bi-droplet text-blue-600"></i>
                                <span class="text-gray-700">Bồn tắm nóng</span>
                            </div>
                        </div>

                        <hr class="my-6 border-gray-200">

                        <!-- Policy -->
                        <h5 class="text-xl font-bold mb-4">📋 Chính sách & Quy định chung</h5>
                        <div class="bg-gray-50 border-l-4 border-blue-600 rounded p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-center space-x-3">
                                    <i class="bi bi-clock-history text-3xl text-blue-600"></i>
                                    <div>
                                        <small class="text-gray-500 block">Giờ nhận phòng</small>
                                        <strong class="text-gray-900">Từ 14:00</strong>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="bi bi-box-arrow-right text-3xl text-blue-600"></i>
                                    <div>
                                        <small class="text-gray-500 block">Giờ trả phòng</small>
                                        <strong class="text-gray-900">Trước 12:00</strong>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <hr class="border-gray-300">
                                </div>

                                <div class="flex items-center">
                                    <i class="bi bi-ban text-red-600 mr-2"></i>
                                    <span class="text-gray-700">Không hút thuốc trong phòng</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="bi bi-slash-circle text-red-600 mr-2"></i>
                                    <span class="text-gray-700">Không mang theo thú cưng</span>
                                </div>
                                <div class="col-span-2 flex items-center">
                                    <i class="bi bi-check-circle-fill text-green-600 mr-2"></i>
                                    <span class="text-green-600 font-bold">Hủy phòng miễn phí</span>
                                    <span class="text-gray-700 ml-1">trước 24h nhận phòng</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Booking Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white shadow-lg rounded-lg sticky top-5 ">
                        <div class="p-6">
                            <h4 class="text-2xl font-bold text-[#F5A623]  mb-2">{{ $room->name }}</h4>
                            <div class="mb-4 text-yellow-400">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <p class="mb-1 text-gray-600 text-sm">Giá phòng niêm yết:</p>
                            <p class="text-red-600 font-bold text-3xl mb-4">{{ number_format($room->price, 0, ',', '.') }}
                                VNĐ</p>

                            <ul class="space-y-3 mb-6 text-sm border-t border-b border-gray-200 py-4">
                                <li class="flex justify-between items-center">
                                    <span class="text-gray-600"><i class="bi bi-people mr-1"></i> Sức chứa:</span>
                                    <strong class="text-gray-900">{{ $room->capacity }} người lớn</strong>
                                </li>

                                <li class="flex justify-between items-center">
                                    <span class="text-gray-600"><i class="bi bi-check-circle mr-1"></i> Trạng thái:</span>
                                    @if ($room->status == 'available')
                                        <span class="text-green-600 font-bold">Còn phòng</span>
                                    @else
                                        <span class="text-red-600 font-bold">{{ $room->status }}</span>
                                    @endif
                                </li>
                            </ul>

                            @if ($room->status == 'available')
                                <div class="space-y-3">
                                    <a href="{{ route('booking.create', $room->id) }}">
                                        <button
                                            class="w-full bg-[#0F3B37] text-[#F5A623] hover:text-[#0F3B37] hover:bg-[#F5A623] font-bold py-3 rounded-lg shadow transition duration-200">
                                            ĐẶT PHÒNG NGAY
                                        </button>
                                    </a>

                                </div>
                            @else
                                <div>
                                    <button
                                        class="w-full bg-gray-400 text-white font-bold py-3 rounded-lg cursor-not-allowed"
                                        disabled>
                                        TẠM THỜI HẾT PHÒNG
                                    </button>
                                </div>
                            @endif

                            <div class="mt-4 text-center bg-gray-50 p-3 rounded">
                                <small class="text-gray-600">Không cần thanh toán ngay. Xác nhận trong 5 phút.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Rooms -->
            <div class="mt-10">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Có thể bạn cũng thích</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($relatedRooms as $item)
                        <div class="bg-white rounded-lg shadow hover:shadow-lg transition-all duration-200 overflow-hidden">
                            <img src="{{ asset('images/' . $item->image) }}" class="w-full h-48 object-contain bg-gray-100"
                                alt="{{ $item->name }}">
                            <div class="p-3">
                                <h6 class="font-semibold text-gray-900 text-sm mb-1 truncate">{{ $item->name }}</h6>
                                <p class="text-red-600 font-bold text-sm mb-2">
                                    {{ number_format($item->price, 0, ',', '.') }} VNĐ</p>
                                <a href="{{ route('room.detail', ['id' => $item->id]) }}"
                                    class="block w-full text-center text-xs border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white py-1.5 rounded transition">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        <script>
            function changeImage(src) {
                document.getElementById('mainImage').src = src;
            }
        </script>
    </body>
@endsection
