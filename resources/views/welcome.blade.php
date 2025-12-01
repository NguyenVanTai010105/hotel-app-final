@extends('layouts.app')
@section('content')

    <body class="bg-gray-100 text-gray-800 flex flex-col items-center min-h-screen">

        <!-- Hero Section -->
        <!-- Image Carousel -->
        <section class="w-full max-w-6xl mx-auto mt-12 px-6" x-data="{
            active: null,
            slides: [
                'https://images.unsplash.com/photo-1501117716987-c8e1ecb210ff?auto=format&fit=crop&w=1500&q=80',
                'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=1500&q=80',
                'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=1500&q=80'
            ]
        }">

            <div class="relative h-64 sm:h-80 lg:h-[450px] overflow-hidden rounded-2xl shadow-xl">

                <!-- Slides -->
                <template x-for="(slide, index) in slides" :key="index">
                    <img x-show="active === index" :src="slide"
                        class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-in-out">
                </template>

                <!-- Left Button -->
                <button @click="active = active === 0 ? slides.length - 1 : active - 1"
                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/40 hover:bg-white/70 text-gray-900 p-2 rounded-full backdrop-blur-sm">
                    ❮
                </button>

                <!-- Right Button -->
                <button @click="active = active === slides.length - 1 ? 0 : active + 1"
                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/40 hover:bg-white/70 text-gray-900 p-2 rounded-full backdrop-blur-sm">
                    ❯
                </button>
            </div>

            <!-- Indicators -->
            <div class="flex justify-center mt-4 gap-2">
                <template x-for="(slide, index) in slides" :key="index">
                    <div @click="active = index" class="w-3 h-3 rounded-full cursor-pointer transition-all"
                        :class="active === index ? 'bg-indigo-700 scale-110' : 'bg-gray-400'">
                    </div>
                </template>
            </div>

        </section>


        <!-- About Section -->
        <section class="max-w-6xl mx-auto px-6 py-16 text-center">
            <h3 class="text-3xl font-semibold text-indigo-900 mb-4">Giới thiệu khách sạn</h3>
            <p class="text-gray-700 leading-relaxed max-w-3xl mx-auto">
                Royal Ocean Hotel cung cấp hệ thống phòng nghỉ hiện đại, nhà hàng chuẩn 5 sao, hồ bơi ngoài trời,
                spa cao cấp và nhiều trải nghiệm đáng nhớ dành cho kỳ nghỉ của bạn.
            </p>
        </section>

        <!-- Rooms Section -->
        <section id="rooms" class="max-w-6xl mx-auto px-6 pb-16">
            <h3 class="text-3xl font-semibold text-indigo-900 mb-8 text-center">Hạng phòng nổi bật</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Room 1 -->
                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=900&q=80"
                        class="w-full h-48 object-cover">

                    <div class="p-5">
                        <h4 class="text-xl font-bold text-indigo-900 mb-2">Phòng Deluxe</h4>
                        <p class="text-gray-600 text-sm mb-4">
                            View biển – Nội thất cao cấp – Giường King – 35m²
                        </p>
                        <p class="text-indigo-700 font-semibold mb-3">2.000.000đ / đêm</p>
                        <button class="w-full py-2 bg-indigo-700 text-white rounded-md hover:bg-indigo-800">
                            Đặt ngay
                        </button>
                    </div>
                </div>

                <!-- Room 2 -->
                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1554995207-c18c203602cb?auto=format&fit=crop&w=900&q=80"
                        class="w-full h-48 object-cover">

                    <div class="p-5">
                        <h4 class="text-xl font-bold text-indigo-900 mb-2">Phòng Suite</h4>
                        <p class="text-gray-600 text-sm mb-4">
                            Ban công riêng – Phòng khách – View biển – 50m²
                        </p>
                        <p class="text-indigo-700 font-semibold mb-3">3.800.000đ / đêm</p>
                        <button class="w-full py-2 bg-indigo-700 text-white rounded-md hover:bg-indigo-800">
                            Đặt ngay
                        </button>
                    </div>
                </div>

                <!-- Room 3 -->
                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1560448075-bb4a1f5f6f87?auto=format&fit=crop&w=900&q=80"
                        class="w-full h-48 object-cover">

                    <div class="p-5">
                        <h4 class="text-xl font-bold text-indigo-900 mb-2">Phòng VIP Ocean</h4>
                        <p class="text-gray-600 text-sm mb-4">
                            Tầm nhìn toàn biển – Phòng rộng 70m² – Bồn tắm đá
                        </p>
                        <p class="text-indigo-700 font-semibold mb-3">6.500.000đ / đêm</p>
                        <button class="w-full py-2 bg-indigo-700 text-white rounded-md hover:bg-indigo-800">
                            Đặt ngay
                        </button>
                    </div>
                </div>

            </div>
        </section>

    </body>
@endsection
