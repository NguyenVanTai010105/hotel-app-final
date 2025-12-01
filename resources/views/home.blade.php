<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - MyHotel Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .room-card:hover { transform: translateY(-5px); transition: 0.3s; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .card-img-top { height: 220px; object-fit: cover; }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">🏨 MyHotel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Giới thiệu</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Liên hệ</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="bg-primary text-white text-center py-5 mb-5" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center;">
        <div class="container">
            <h1 class="display-4 fw-bold">Chào mừng đến với MyHotel</h1>
            <p class="lead">Trải nghiệm nghỉ dưỡng đẳng cấp thượng lưu</p>
        </div>
    </div>

    <div class="container mb-5">
        <h2 class="text-center mb-4 fw-bold text-uppercase text-secondary">Các phòng nổi bật</h2>
        
        <div class="row">
            @foreach($rooms as $room)
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm room-card">
                    <img src="{{ $room->image }}" class="card-img-top" alt="{{ $room->name }}">
                    
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-info text-dark">{{ $room->type }}</span>
                            <small class="text-muted"><i class="bi bi-people-fill"></i> Tối đa {{ $room->capacity }} người</small>
                        </div>
                        <h5 class="card-title fw-bold">{{ $room->name }}</h5>
                        <p class="card-text text-truncate">{{ $room->description }}</p>
                        <h5 class="text-danger fw-bold mb-3">{{ number_format($room->price, 0, ',', '.') }} VNĐ <small class="text-muted fw-normal text-small">/ đêm</small></h5>
                        
                        <a href="{{ route('room.detail', ['slug' => $room->slug]) }}" class="btn btn-outline-primary w-100 stretched-link">
                            Xem chi tiết <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">© 2025 MyHotel Project. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>