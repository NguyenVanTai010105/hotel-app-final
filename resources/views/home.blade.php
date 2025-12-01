<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atoli Resort - Trải nghiệm đẳng cấp</title>

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
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
        color: #555;
        background-color: #f9f9f9;
    }

    h1,
    h2,
    h3,
    h4 {
        font-family: 'Playfair Display', serif;
        color: var(--text-dark);
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1571896349842-6e635d688466?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
    }

    /* Booking Form nổi */
    .booking-form-wrapper {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        margin-top: -60px;
        position: relative;
        z-index: 10;
    }

    /* Room Card */
    .room-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: 0.3s;
        background: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .room-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .room-img {
        height: 250px;
        object-fit: cover;
        width: 100%;
    }

    .price-tag {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 1.25rem;
    }

    .btn-atoli {
        background-color: var(--primary-color);
        color: white;
        border-radius: 50px;
        padding: 10px 30px;
        font-weight: 600;
        border: none;
    }

    .btn-atoli:hover {
        background-color: #e65555;
        color: white;
    }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="{{ route('home') }}" style="color: var(--primary-color);">
                <i class="fa-solid fa-hotel me-2"></i>ATOLI RESORT
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto fw-bold text-uppercase small">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Về chúng tôi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#rooms">Phòng nghỉ</a></li>
                    <!-- SỬA LỖI 1: Menu Đặt phòng trỏ xuống danh sách phòng thay vì link chết -->
                    <li class="nav-item"><a class="nav-link text-danger" href="#rooms">Đặt phòng</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO BANNER -->
    <header class="hero-section">
        <div class="container">
            <h5 class="text-uppercase letter-spacing-2 mb-3">Chào mừng đến với thiên đường</h5>
            <h1 class="display-3 fw-bold mb-4">Atoli Resort & Spa</h1>
            <p class="lead mb-5 w-75 mx-auto d-none d-md-block">"Đừng chờ đợi và lãng phí thời gian, hãy gõ cửa và đặt
                chỗ ngay!"</p>
            <a href="#rooms" class="btn btn-light btn-lg rounded-pill px-5 py-3 fw-bold text-danger">Khám Phá Ngay</a>
        </div>
    </header>

    <!-- FORM CHECK-IN (Form tìm kiếm) -->
    <div class="container mb-5">
        <div class="booking-form-wrapper">
            <!-- SỬA LỖI 2: Form này trỏ về 'home' hoặc '#rooms' thay vì 'booking.create' -->
            <form action="{{ route('home') }}" method="GET">
                <div class="row align-items-end g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-bold text-uppercase small">Ngày nhận phòng</label>
                        <input type="date" name="checkin" class="form-control py-2" value="2025-12-01">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold text-uppercase small">Ngày trả phòng</label>
                        <input type="date" name="checkout" class="form-control py-2" value="2025-12-05">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold text-uppercase small">Người lớn</label>
                        <select class="form-select py-2">
                            <option>1 Người</option>
                            <option selected>2 Người</option>
                            <option>Gia đình</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <!-- Nút này giờ chỉ mang tính chất minh họa tìm kiếm -->
                        <a href="#rooms" class="btn btn-atoli w-100 py-2 text-decoration-none d-block text-center">TÌM
                            PHÒNG NGAY</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- DANH SÁCH PHÒNG TỪ DB -->
    <section id="rooms" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h5 class="text-danger fw-bold text-uppercase">Không gian nghỉ dưỡng</h5>
                <h2 class="display-5 fw-bold">Phòng & Giá Của Chúng Tôi</h2>
            </div>

            <div class="row">
                @if($featuredRooms->count() > 0)
                @foreach($featuredRooms as $room)
                <div class="col-md-4 mb-4">
                    <div class="card room-card h-100">
                        <div class="position-relative">
                            <img src="{{ $room->image ? asset('storage/'.$room->image) : 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=800&q=80' }}"
                                class="card-img-top room-img" alt="{{ $room->name }}">
                            <span class="badge bg-danger position-absolute top-0 end-0 m-3 py-2 px-3">Hot</span>
                        </div>
                        <div class="card-body p-4">
                            <h4 class="card-title fw-bold mb-2">{{ $room->name }}</h4>
                            <div class="mb-3 text-muted small">
                                <i class="fa-solid fa-bed me-1"></i> {{ $room->type }} &nbsp;|&nbsp;
                                <i class="fa-solid fa-user-group me-1"></i> {{ $room->capacity }} Khách
                            </div>
                            <p class="card-text text-muted mb-4">{{ Str::limit($room->description, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                <div>
                                    <div class="price-tag">{{ number_format($room->price, 0, ',', '.') }} VNĐ</div>
                                    <small class="text-muted">/ đêm</small>
                                </div>
                                <!-- ĐÂY LÀ CHỖ QUAN TRỌNG: Truyền ID vào route -->
                                <a href="{{ route('booking.create', ['id' => $room->id]) }}"
                                    class="btn btn-outline-danger rounded-pill px-4">Đặt Ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-12 text-center py-5">
                    <div class="alert alert-warning">Hiện chưa có phòng nào khả dụng. Hãy kiểm tra Database!</div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-dark text-white pt-5 pb-3 mt-5">
        <div class="container text-center">
            <h3 class="fw-bold mb-3">ATOLI RESORT</h3>
            <p class="small text-secondary mb-4">Dự án Web Laravel - Sinh viên: Khánh & Duy</p>
            <div class="d-flex justify-content-center gap-3 mb-4">
                <a href="#" class="text-white"><i class="fa-brands fa-facebook fs-4"></i></a>
                <a href="#" class="text-white"><i class="fa-brands fa-instagram fs-4"></i></a>
            </div>
            <hr class="border-secondary">
            <p class="small text-secondary">&copy; 2025 Atoli Resort. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>