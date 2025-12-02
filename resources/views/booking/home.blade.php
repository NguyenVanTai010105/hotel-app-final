<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atoli Resort - Trải nghiệm đẳng cấp</title>

    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body class="font-sans bg-gray-50 text-gray-700">

    <!-- NAVBAR -->
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-5 py-4 flex items-center justify-between">

            <a href="" class="text-2xl font-bold text-red-400 flex items-center gap-2">
                <i class="fa-solid fa-hotel"></i> ATOLI RESORT
            </a>

            <ul class="hidden md:flex gap-6 text-sm font-semibold uppercase">
                <li><a href="" class="text-red-500">Trang chủ</a></li>
                <li><a href="#" class="hover:text-red-400">Về chúng tôi</a></li>
                <li><a href="#rooms" class="hover:text-red-400">Phòng nghỉ</a></li>
                <li><a href="#rooms" class="text-red-500">Đặt phòng</a></li>
            </ul>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <header
        class="h-[85vh] flex items-center justify-center text-center text-white 
        bg-[url('https://images.unsplash.com/photo-1571896349842-6e635d688466?auto=format&fit=crop&w=1920&q=80')] 
        bg-cover bg-center relative">

        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative z-10 px-5">
            <p class="uppercase tracking-widest mb-3">Chào mừng đến với thiên đường</p>
            <h1 class="text-5xl md:text-6xl font-bold mb-4">Atoli Resort & Spa</h1>
            <p class="hidden md:block max-w-xl mx-auto mb-6">
                "Đừng chờ đợi và lãng phí thời gian, hãy gõ cửa và đặt chỗ ngay!"
            </p>
            <a href="#rooms"
                class="bg-white text-red-500 px-8 py-3 rounded-full font-bold text-lg shadow hover:bg-gray-200">
                Khám Phá Ngay
            </a>
        </div>

    </header>

    <!-- FORM CHECKIN -->
    <div class="max-w-5xl mx-auto px-5 -mt-14 relative z-20">
        <div class="bg-white shadow-xl rounded-xl p-8">

            <form action="" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

                    <div>
                        <label class="text-xs uppercase font-bold mb-1 block">Ngày nhận phòng</label>
                        <input type="date" name="checkin" value="2025-12-01"
                            class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <div>
                        <label class="text-xs uppercase font-bold mb-1 block">Ngày trả phòng</label>
                        <input type="date" name="checkout" value="2025-12-05"
                            class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <div>
                        <label class="text-xs uppercase font-bold mb-1 block">Người lớn</label>
                        <select class="w-full border rounded-lg px-3 py-2">
                            <option>1 Người</option>
                            <option selected>2 Người</option>
                            <option>Gia đình</option>
                        </select>
                    </div>

                    <div class="flex items-end">
                        <a href="#rooms"
                            class="bg-red-400 hover:bg-red-500 text-white w-full py-2 rounded-lg text-center font-semibold">
                            Tìm phòng ngay
                        </a>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <!-- ROOM LIST -->
    <section id="rooms" class="py-16">
        <div class="max-w-6xl mx-auto px-5">

            <div class="text-center mb-12">
                <p class="text-red-500 font-semibold uppercase tracking-wide">Không gian nghỉ dưỡng</p>
                <h2 class="text-4xl font-bold">Phòng & Giá Của Chúng Tôi</h2>
            </div>

            

        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white py-10 text-center">
        <h3 class="text-2xl font-bold mb-2">ATOLI RESORT</h3>
        <p class="text-gray-400 text-sm mb-4">Dự án Web Laravel - Sinh viên: Khánh & Duy</p>

        <div class="flex justify-center gap-5 text-xl mb-4">
            <a href="#" class="hover:text-red-400"><i class="fa-brands fa-facebook"></i></a>
            <a href="#" class="hover:text-red-400"><i class="fa-brands fa-instagram"></i></a>
        </div>

        <p class="text-gray-500 text-sm">&copy; 2025 Atoli Resort. All rights reserved.</p>
    </footer>

</body>

</html>
