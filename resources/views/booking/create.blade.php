@extends('layouts.app')
@section('title', 'Đặt phòng: {{ $room->name }}')
<style>
    :root {
        --primary-color: #ff6b6b;
        --text-dark: #2c3e50;
    }

    body {
        font-family: 'Montserrat', sans-serif;
        background-color: #f4f7f6;
        color: #555;
    }

    h1,
    h2,
    h3,
    h4 {
        font-family: 'Playfair Display', serif;
        color: var(--text-dark);
    }

    /* Form nhập liệu */
    .booking-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        background: white;
        margin-bottom: 20px;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px;
        border: 1px solid #ddd;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 107, 0.25);
    }

    .section-header {
        border-bottom: 1px dashed #eee;
        padding-bottom: 15px;
        margin-bottom: 20px;
        font-weight: 700;
        color: var(--text-dark);
    }

    /* Sticky Summary */
    .summary-card {
        position: sticky;
        top: 20px;
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        background: white;
    }

    .room-thumb {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .price-highlight {
        color: var(--primary-color);
        font-weight: 800;
        font-size: 1.5rem;
    }

    /* Nút xác nhận */
    .btn-confirm {
        background-color: var(--primary-color);
        color: white;
        border-radius: 50px;
        padding: 14px;
        font-weight: bold;
        width: 100%;
        border: none;
        font-size: 1.1rem;
        transition: 0.3s;
        margin-top: 15px;
    }

    .btn-confirm:hover {
        background-color: #e05555;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
    }
</style>

@section('content')

    @if (session('status'))
        <div id="toast"
            class="fixed top-[70px] right-5 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 opacity-0 transform transition-all duration-300">
            {{ session('status') }}
        </div>
    @elseif(session('error'))
        <div id="toast"
            class="fixed top-[70px] right-5 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 opacity-0 transform transition-all duration-300">
            {{ session('error') }}
        </div>
    @endif

    <body>


        <div class="max-w-6xl mx-auto px-4 py-6">

            <div class="flex items-center border-none justify-between  p-4  mb-6">
                <a href="{{ url()->previous() }}"
                    class="text-gray-600 font-semibold flex items-center gap-2 px-6 py-3 rounded-full bg-gray-100 
          hover:bg-blue-500 hover:text-white hover:animate-bounce transition-all duration-300 ease-in-out">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>

            <form action="{{ route('booking.store', $room->id) }}" method="POST"
                class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input type="hidden" id="raw_price" value="{{ $room->price }}">


                <div class="lg:col-span-2 space-y-6">

                    <!-- Section 1 -->
                    <div class="bg-white shadow-lg rounded-xl p-6">
                        <h2 class="text-lg font-bold mb-4 border-b pb-2 flex items-center">
                            <i class="fa-solid fa-user text-red-500 mr-2"></i> 1. Thông tin người đặt
                        </h2>

                        <div class="grid grid-cols-1  gap-4">
                            <div>
                                <label class="font-semibold text-sm">Họ và tên *</label>
                                <input type="text" name="fullname" required
                                    class="mt-1 w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-red-400 focus:outline-none"
                                    placeholder="Ví dụ: Nguyễn Văn A">
                            </div>

                            <div>
                                <label class="font-semibold text-sm">Email (Nhận vé điện tử)</label>
                                <input type="email" name="email" required
                                    class="mt-1 w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-red-400 focus:outline-none"
                                    placeholder="email@example.com">
                            </div>
                        </div>
                    </div>

                    <!-- Section 2 -->
                    <div class="bg-white shadow-lg rounded-xl p-6">
                        <h2 class="text-lg font-bold mb-4 border-b pb-2 flex items-center">
                            <i class="fa-solid fa-calendar-days text-red-500 mr-2"></i> 2. Chi tiết kỳ nghỉ
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="font-semibold text-sm">Ngày nhận phòng</label>
                                <input type="date" id="checkin" name="start_date" required
                                    class="mt-1 w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-red-400 focus:outline-none">
                            </div>
                            <div>
                                <label class="font-semibold text-sm">Ngày trả phòng</label>
                                <input type="date" id="checkout" name="end_date" required
                                    class="mt-1 w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-red-400 focus:outline-none">
                            </div>
                            <div class="md:col-span-2">
                                <label class="font-semibold text-sm">Ghi chú thêm</label>
                                <input type="text" name="des" rows="3"
                                    class="mt-1 w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-red-400 focus:outline-none"
                                    placeholder="Yêu cầu đặc biệt..."></input>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN: SUMMARY -->
                <div class="space-y-4 sticky top-6 h-fit">
                    <div class="bg-white shadow-xl rounded-xl overflow-hidden">
                        <img src="{{  asset('storage/' . $room->image) }}"
                            class="w-full h-48 object-cover" alt="{{ $room->name }}">

                        <div class="p-5">
                            <h3 class="font-bold text-xl mb-1">{{ $room->name }}</h3>
                            <p class="text-gray-500 text-sm mb-3 flex items-center space-x-2">
                                <span><i class="fa-solid fa-bed"></i> {{ $room->type }}</span>
                                <span>•</span>
                                <span><i class="fa-solid fa-user-group"></i> {{ $room->capacity }} khách</span>
                            </p>

                            <div class="border-t my-3"></div>

                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-gray-600">Giá phòng:</span>
                                <span class="font-semibold">{{ number_format($room->price, 0, ',', '.') }} đ</span>
                            </div>

                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-gray-600">Thời gian ở:</span>
                                <span id="total_nights" class="font-semibold text-red-500 ">1 đêm</span>
                            </div>

                            <div class="border-t my-3"></div>

                            <div class="flex justify-between items-center mb-3">
                                <span class="font-bold text-lg">TỔNG CỘNG:</span>
                                <span id="total_price" class="text-red-500 font-extrabold text-xl">0 đ</span>
                            </div>

                            <button type="submit"
                                class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-full font-semibold text-lg transition transform hover:-translate-y-1 shadow">
                                XÁC NHẬN ĐẶT PHÒNG
                            </button>

                            <p class="text-center text-gray-500 text-xs mt-3">
                                <i class="fa-solid fa-shield-halved text-green-500 mr-1"></i> Thông tin bảo mật 100%
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <!-- JAVASCRIPT: LOGIC TÍNH TIỀN CHUẨN BOOKING ONLINE -->
        <script>
            const toast = document.getElementById('toast');
            if (toast) {
                setTimeout(() => {
                    toast.classList.remove('opacity-0');
                    toast.classList.add('opacity-100');
                }, 100);
                setTimeout(() => {
                    toast.classList.remove('opacity-100');
                    toast.classList.add('opacity-0');
                }, 3100);
            }

            document.addEventListener('DOMContentLoaded', function() {
                const checkinEl = document.getElementById('checkin');
                const checkoutEl = document.getElementById('checkout');
                const totalNightsEl = document.getElementById('total_nights');
                const totalPriceEl = document.getElementById('total_price');
                const roomPriceEl = document.getElementById('room_price');
                const rawPrice = parseFloat(document.getElementById('raw_price').value);

                const today = new Date();
                const tomorrow = new Date(today);
                tomorrow.setDate(today.getDate() + 1);

                checkinEl.valueAsDate = today;
                checkoutEl.valueAsDate = tomorrow;

                function updatePrice() {
                    const checkinDate = new Date(checkinEl.value);
                    const checkoutDate = new Date(checkoutEl.value);
                    if (checkinDate && checkoutDate && checkoutDate > checkinDate) {
                        const diffDays = Math.ceil((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24));
                        totalNightsEl.innerText = diffDays + ' đêm';
                        totalPriceEl.innerText = new Intl.NumberFormat('vi-VN').format(diffDays * rawPrice) + ' đ';
                    } else {
                        totalNightsEl.innerText = '0 đêm';
                        totalPriceEl.innerText = '0 đ';
                    }
                }

                checkinEl.addEventListener('input', function() {
                    const nextDay = new Date(this.value);
                    nextDay.setDate(nextDay.getDate() + 1);
                    if (new Date(checkoutEl.value) <= nextDay) checkoutEl.valueAsDate = nextDay;
                    updatePrice();
                });

                checkoutEl.addEventListener('input', updatePrice);

                updatePrice();
            });
        </script>
    </body>
@endsection
