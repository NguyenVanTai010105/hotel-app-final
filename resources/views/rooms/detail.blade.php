<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $room->name }} - Chi tiết phòng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        .main-image { width: 100%; height: 450px; object-fit: cover; border-radius: 8px; }
        .thumb-img { height: 80px; width: 100%; object-fit: cover; border-radius: 4px; cursor: pointer; transition: 0.2s; border: 2px solid transparent; }
        .thumb-img:hover { border-color: #0d6efd; opacity: 0.8; }
        .room-price { color: #dc3545; font-weight: bold; font-size: 1.8rem; }
        /* Style cho card phòng tương tự */
        .related-card img { height: 180px; object-fit: cover; }
        .related-card:hover { transform: translateY(-5px); transition: 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">🏨 MyHotel</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('home') }}">Quay lại trang chủ</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $room->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-8">
                <div class="mb-3 position-relative">
                    <img id="mainImage" src="{{ $room->image }}" class="main-image shadow" alt="{{ $room->name }}">
                    <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-3 fs-6">{{ $room->type }}</span>
                </div>

                @if($room->images->count() > 0)
                <p class="fw-bold text-muted mb-2">Hình ảnh chi tiết:</p>
                <div class="row g-2 mb-4">
                    <div class="col-3 col-md-2">
                        <img src="{{ $room->image }}" class="thumb-img shadow-sm" onclick="changeImage(this.src)">
                    </div>
                    @foreach($room->images as $img)
                    <div class="col-3 col-md-2">
                        <img src="{{ $img->image_path }}" class="thumb-img shadow-sm" onclick="changeImage(this.src)">
                    </div>
                    @endforeach
                </div>
                @endif
                
                <div class="card shadow-sm p-4 mb-4 border-0">
                    <h3 class="fw-bold mb-3">Mô tả phòng</h3>
                    <p class="text-secondary" style="line-height: 1.8;">{{ $room->description }}</p>
                    <hr class="my-4">
                    <h5 class="fw-bold mb-3">Tiện nghi có sẵn</h5>
                    <div class="row g-3">
                        <div class="col-6 col-md-4"><i class="bi bi-wifi text-primary"></i> Wifi miễn phí</div>
                        <div class="col-6 col-md-4"><i class="bi bi-snow text-info"></i> Điều hòa 2 chiều</div>
                        <div class="col-6 col-md-4"><i class="bi bi-tv text-dark"></i> Smart TV 4K</div>
                        <div class="col-6 col-md-4"><i class="bi bi-cup-hot text-warning"></i> Máy pha cà phê</div>
                        <div class="col-6 col-md-4"><i class="bi bi-safe text-secondary"></i> Két an toàn</div>
                        <div class="col-6 col-md-4"><i class="bi bi-droplet text-primary"></i> Bồn tắm nóng</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow border-0 sticky-top" style="top: 20px; z-index: 100;">
                    <div class="card-body p-4">
                        <h4 class="card-title fw-bold text-primary mb-1">{{ $room->name }}</h4>
                        <div class="mb-3 text-warning">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p class="mb-1 text-muted">Giá phòng niêm yết:</p>
                        <p class="room-price mb-3">{{ number_format($room->price, 0, ',', '.') }} VNĐ</p>

                        <ul class="list-group list-group-flush mb-4 small">
                            <li class="list-group-item d-flex justify-content-between px-0">
                                <span><i class="bi bi-people"></i> Sức chứa:</span><strong>{{ $room->capacity }} người lớn</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between px-0">
                                <span><i class="bi bi-arrows-fullscreen"></i> Diện tích:</span><strong>35 m²</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between px-0">
                                <span><i class="bi bi-check-circle"></i> Trạng thái:</span>
                                @if($room->status == 'available') <span class="text-success fw-bold">Còn phòng</span>
                                @else <span class="text-danger fw-bold">Đã hết</span> @endif
                            </li>
                        </ul>

                        @if($room->status == 'available')
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary btn-lg fw-bold shadow-sm">ĐẶT PHÒNG NGAY</button>
                                <button class="btn btn-outline-secondary">Thêm vào yêu thích</button>
                            </div>
                        @else
                            <div class="d-grid gap-2">
                                <button class="btn btn-secondary btn-lg" disabled>TẠM THỜI HẾT PHÒNG</button>
                            </div>
                        @endif
                        <div class="mt-3 text-center bg-light p-2 rounded">
                            <small class="text-muted">Không cần thanh toán ngay. Xác nhận trong 5 phút.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h3 class="fw-bold mb-4 border-bottom pb-2">Có thể bạn cũng thích</h3>
            <div class="row">
                @foreach($relatedRooms as $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm related-card">
                        <img src="{{ $item->image }}" class="card-img-top" alt="{{ $item->name }}">
                        <div class="card-body">
                            <h6 class="card-title fw-bold">{{ $item->name }}</h6>
                            <p class="text-danger fw-bold mb-2">{{ number_format($item->price, 0, ',', '.') }} VNĐ</p>
                            <a href="{{ route('room.detail', ['slug' => $item->slug]) }}" class="btn btn-sm btn-outline-primary w-100 stretched-link">Xem ngay</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>

    <footer class="bg-dark text-white text-center py-4 mt-5">
        <p class="mb-0">© 2025 MyHotel Project</p>
    </footer>

    <script>
        function changeImage(src) { document.getElementById('mainImage').src = src; }
    </script>
</body>
</html>