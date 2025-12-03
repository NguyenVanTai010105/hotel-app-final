<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>

</style>

<body class="bg-[#B4D2CC] m-0 p-0 box-border ">
    <header
        class="sticky top-0 my-4 bg-white shadow-md border-4 border-[#C9E0DA] p-2 rounded-3xl z-50 w-4/5 max-w-7xl mx-auto">

        <div class="container flex items-center justify-between h-full w-full px-4 md:px-10">

            <!-- Logo -->
            <div class="logo h-12 w-auto">
                <a href="">
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

            <!-- Desktop Button -->
            @guest
                <div class="hidden md:flex items-center space-x-4">
                    <a href="#"
                        class="flex items-center space-x-2 px-5 py-2 bg-[#0F3B37] text-white font-semibold rounded-full hover:bg-[#F5A623] transition">
                        <span>Đăng nhập</span>
                        <i class="fa-regular fa-user"></i>
                    </a>
                </div>
            @endguest
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

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden mt-2 bg-white rounded-xl shadow-lg p-4 space-y-4">
            <a href="#" class="block text-gray-700 hover:text-black">HomePage</a>
            <a href="#" class="block text-gray-700 hover:text-black">Technology</a>
            <a href="#" class="block text-gray-700 hover:text-black">Careers</a>
            <a href="#"
                class="flex items-center space-x-2 px-4 py-2 bg-[#0F3B37] text-white font-semibold rounded-full hover:bg-[#F5A623] transition">
                <span>Đăng nhập</span>
                <i class="fa-regular fa-user"></i>
            </a>
        </div>
    </header>

    <script>
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
