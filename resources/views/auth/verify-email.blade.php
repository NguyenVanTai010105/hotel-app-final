<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trang mặc định')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
</head>
<!-- Thông báo Success -->


<body class="bg-[#B4D2CC] m-0 p-0 box-border">
    <header
        class="sticky top-0 my-4 bg-white shadow-md border-4 border-[#C9E0DA] p-2 rounded-3xl z-50 w-4/5 max-w-7xl mx-auto">

        <div class="container flex items-center justify-between h-full w-full px-4 md:px-10">

            <!-- Logo -->
            <div class="logo h-12 w-auto">
                <a href="{{ route('welcome') }}">
                    <img src="{{ asset('images/crocodile.png') }}" class="h-full w-auto object-contain" alt="logo">
                </a>
            </div>

            <!-- Desktop Navbar -->
            <div class="hidden md:flex navbar text-gray-500 items-center space-x-8">
                <div class="inline-block relative group">
                    <p class="hover:text-black cursor-pointer">HomePage</p>
                    <hr
                        class="absolute left-0 bottom-0 w-0 h-[2.5px] bg-yellow-500 transition-all duration-500 group-hover:w-full">
                </div>
                <div class="inline-block relative group">
                    <p class="hover:text-black cursor-pointer">Technology</p>
                    <hr
                        class="absolute left-0 bottom-0 w-0 h-[2.5px] bg-yellow-500 transition-all duration-500 group-hover:w-full">
                </div>
                <div class="inline-block relative group">
                    <p class="hover:text-black cursor-pointer">Careers</p>
                    <hr
                        class="absolute left-0 bottom-0 w-0 h-[2.5px] bg-yellow-500 transition-all duration-500 group-hover:w-full">
                </div>
            </div>

            @auth
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('logout') }}"
                        class="flex items-center space-x-2 px-5 py-2 bg-[#0F3B37] text-white font-semibold rounded-full hover:bg-[#F5A623] transition">
                        <span>Đăng xuất</span>
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </a>
                </div>
            @endauth

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="menu-btn" class="text-gray-700 focus:outline-none">
                    <i class="fa-solid fa-bars text-2xl"></i>
                </button>
            </div>

        </div>
    </header>

    <script>
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>

    <!-- Main Content -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @elseif (session('error'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
    <x class=" min-h-[calc(100vh-200px)] flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16  mb-4">
                        <img src="images/email.png" alt="">
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Xác Thực OTP</h1>
                    <p class="text-gray-600">Nhập mã 6 chữ số được gửi đến <span
                            class="font-semibold">{{ Auth::user()->email }}</span></p>
                </div>

                <!-- Form -->
                <form class="space-y-6" method="POST" action="{{ route('verify_post') }}">
                    <!-- OTP Input -->
                    @csrf
                    <div class="space-y-2">
                        <label class="block text-sm text-center font-medium text-gray-700">Mã OTP</label>
                        <div class="flex gap-2 justify-center">
                            <input type="text" name="otp[]" maxlength="1"
                                class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:outline-none transition" />
                            <input type="text" name="otp[]" maxlength="1"
                                class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:outline-none transition" />
                            <input type="text" name="otp[]" maxlength="1"
                                class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:outline-none transition" />
                            <input type="text" name="otp[]" maxlength="1"
                                class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:outline-none transition" />
                            <input type="text" name="otp[]" maxlength="1"
                                class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:outline-none transition" />
                            <input type="text" name="otp[]" maxlength="1"
                                class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:outline-none transition" />
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg transition duration-200">
                        Xác thực
                    </button>
                </form>

                <!-- Resend OTP -->
                <div class="text-center mt-6">
                    <div class="flex items-center justify-center gap-2 text-sm">
                        <p class="text-gray-600">Không nhận được mã?</p>

                        <form method="POST" action="{{ route('verify_post') }}">
                            @csrf
                            <button type="submit"
                                class="text-indigo-600 hover:text-indigo-700 font-semibold transition">
                                Gửi lại
                            </button>
                        </form>
                    </div>

                    <p class="text-gray-500 text-xs mt-2">Gửi lại trong 60s</p>
                </div>



                <!-- Change Phone -->
                <div class="text-center mt-4">
                    <button type="button" class="text-gray-600 hover:text-gray-800 text-sm font-medium transition">
                        Thay đổi số điện thoại
                    </button>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-6 text-gray-600 text-xs">
                <p>Mã OTP có hiệu lực trong 5 phút</p>
            </div>
        </div>
    </x>

</body>

</html>
