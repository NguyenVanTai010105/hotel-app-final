<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt phòng: {{ $room->name }} - Atoli Resort</title>

    <!-- CSS Bootstrap & Font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&display=swap"
        rel="stylesheet">

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
</head>

<body>

    <!-- Header Quay Lại -->
    <nav class="navbar navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-secondary" href="{{ route('home') }}">
                <i class="fa-solid fa-arrow-left me-2"></i> Quay lại
            </a>
            <span class="fw-bold text-uppercase d-none d-md-block text-secondary">Hoàn tất đặt phòng</span>
        </div>
    </nav>

    <div class="container mb-5">
        <form action="{{ route('booking.store') }}" method="POST">
            @csrf
            <!-- Input Ẩn -->
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <input type="hidden" id="raw_price" value="{{ $room->price }}">

            <div class="row">
                <!-- CỘT TRÁI: FORM NHẬP -->
                <div class="col-lg-8">
                    <!-- 1. Thông tin người đặt -->
                    <div class="booking-card p-4">
                        <div class="section-header"><i class="fa-solid fa-user me-2 text-danger"></i> 1. Thông tin người
                            đặt</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Họ và tên *</label>
                                <input type="text" name="fullname" class="form-control"
                                    placeholder="Ví dụ: Nguyễn Văn A" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Số điện thoại *</label>
                                <input type="tel" name="phone" class="form-control" placeholder="09xxxxxxxxx" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small">Email (Nhận vé điện tử)</label>
                                <input type="email" name="email" class="form-control" placeholder="email@example.com"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Chi tiết kỳ nghỉ -->
                    <div class="booking-card p-4 mt-4">
                        <div class="section-header"><i class="fa-solid fa-calendar-days me-2 text-danger"></i> 2. Chi
                            tiết kỳ nghỉ</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Ngày nhận phòng</label>
                                <!-- Thêm id để JS bắt sự kiện -->
                                <input type="date" name="checkin" id="checkin" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Ngày trả phòng</label>
                                <input type="date" name="checkout" id="checkout" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small">Ghi chú thêm</label>
                                <textarea name="note" class="form-control" rows="3"
                                    placeholder="Yêu cầu đặc biệt..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CỘT PHẢI: HÓA ĐƠN TẠM TÍNH -->
                <div class="col-lg-4">
                    <div class="summary-card">
                        <div class="position-relative">
                            <img src="{{ $room->image ? asset('storage/'.$room->image) : 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=800&q=80' }}"
                                class="room-thumb" alt="{{ $room->name }}">
                        </div>

                        <div class="p-4">
                            <h5 class="fw-bold mb-2">{{ $room->name }}</h5>
                            <p class="text-muted small"><i class="fa-solid fa-bed me-1"></i> {{ $room->type }} | <i
                                    class="fa-solid fa-user-group"></i> {{ $room->capacity }} Khách</p>

                            <hr class="my-3">

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary">Giá phòng:</span>
                                <span class="fw-bold">{{ number_format($room->price, 0, ',', '.') }} đ</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary">Thời gian ở:</span>
                                <span id="total_nights" class="fw-bold text-primary">0 đêm</span>
                            </div>

                            <hr class="my-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-bold fs-5">TỔNG CỘNG:</span>
                                <span id="total_price" class="price-highlight">0 đ</span>
                            </div>

                            <button type="submit" class="btn btn-confirm shadow">
                                XÁC NHẬN ĐẶT PHÒNG
                            </button>
                            <div class="text-center mt-3 small text-muted">
                                <i class="fa-solid fa-shield-halved text-success me-1"></i> Thông tin bảo mật 100%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- JAVASCRIPT: LOGIC TÍNH TIỀN CHUẨN BOOKING ONLINE -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. LẤY GIÁ TIỀN AN TOÀN (Sửa lỗi crash JS)
        // Lấy từ input hidden để tránh lỗi cú pháp PHP
        const rawPrice = document.getElementById('raw_price').value;
        const pricePerNight = parseFloat(rawPrice);

        const checkinEl = document.getElementById('checkin');
        const checkoutEl = document.getElementById('checkout');
        const totalNightsEl = document.getElementById('total_nights');
        const totalPriceEl = document.getElementById('total_price');

        // 2. TỰ ĐỘNG ĐIỀN NGÀY HÔM NAY VÀ NGÀY MAI (Logic có tâm)
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);

        // Format YYYY-MM-DD để gán vào input date
        checkinEl.valueAsDate = today;
        checkoutEl.valueAsDate = tomorrow;

        // Chạy tính tiền ngay lập tức khi vào trang
        updatePrice();

        // 3. HÀM TÍNH TOÁN
        function updatePrice() {
            const d1 = new Date(checkinEl.value);
            const d2 = new Date(checkoutEl.value);

            // Kiểm tra hợp lệ: Ngày trả phải sau ngày nhận
            if (checkinEl.value && checkoutEl.value && d2 > d1) {
                const diffTime = Math.abs(d2 - d1);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                // Cập nhật giao diện
                totalNightsEl.innerText = diffDays + " đêm";
                const total = diffDays * pricePerNight;
                totalPriceEl.innerText = new Intl.NumberFormat('vi-VN').format(total) + " đ";

                // Enable nút đặt phòng
                document.querySelector('.btn-confirm').disabled = false;
            } else {
                // Nếu chọn sai ngày (Ngày trả trước ngày nhận)
                totalNightsEl.innerText = "0 đêm";
                totalPriceEl.innerText = "0 đ";
                document.querySelector('.btn-confirm').disabled = true; // Khóa nút lại
            }
        }

        // 4. BẮT SỰ KIỆN: Dùng 'input' thay vì 'change' để mượt hơn
        checkinEl.addEventListener('input', function() {
            // Logic thông minh: Nếu đổi ngày nhận, tự đẩy ngày trả lên +1 ngày
            const d1 = new Date(this.value);
            if (d1) {
                const nextDay = new Date(d1);
                nextDay.setDate(d1.getDate() + 1);
                if (new Date(checkoutEl.value) <= d1) {
                    checkoutEl.valueAsDate = nextDay;
                }
            }
            updatePrice();
        });

        checkoutEl.addEventListener('input', updatePrice);
    });
    </script>
</body>

</html>