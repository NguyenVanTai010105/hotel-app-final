@extends('layouts.app')
@section('title', 'Home')
@section('content')

    <body class="bg-gray-100 text-gray-800 flex flex-col items-center min-h-screen">

        <!-- Hero Section -->
        <!-- Image Carousel -->
        <section class="w-full max-w-6xl mx-auto mt-12 px-6" x-data="{
            active: 0,
            slides: [
                'https://images.unsplash.com/photo-1501117716987-c8e1ecb210ff?auto=format&fit=crop&w=1500&q=80',
                'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=1500&q=80',
                'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=1500&q=80'
            ],
            autoplay() {
                setInterval(() => {
                    this.active = this.active === this.slides.length - 1 ? 0 : this.active + 1;
                }, 5000);
            }
        }" x-init="autoplay()">

            <div class="relative h-64 sm:h-80 lg:h-[450px] overflow-hidden rounded-2xl shadow-xl">

                <!-- Slides -->
                <template x-for="(slide, index) in slides" :key="index">
                    <img x-show="active === index" x-transition:enter="transition ease-out duration-700"
                        x-transition:enter-start="opacity-0 transform scale-105"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-700"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95" :src="slide"
                        class="absolute inset-0 w-full h-full object-cover">
                </template>

                <!-- Left Button -->
                <button @click="active = active === 0 ? slides.length - 1 : active - 1"
                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/40 hover:bg-white/70 text-gray-900 p-3 rounded-full backdrop-blur-sm transition-all duration-300 hover:scale-110">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <!-- Right Button -->
                <button @click="active = active === slides.length - 1 ? 0 : active + 1"
                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/40 hover:bg-white/70 text-gray-900 p-3 rounded-full backdrop-blur-sm transition-all duration-300 hover:scale-110">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Indicators -->
            <div class="flex justify-center mt-4 gap-2">
                <template x-for="(slide, index) in slides" :key="index">
                    <div @click = " active = index" class="w-3 h-3 rounded-full cursor-pointer transition-all duration-300"
                        :class="active === index ? 'bg-indigo-700 scale-110 w-8' : 'bg-gray-400 hover:bg-gray-500'">
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
        <section id="rooms" class="max-w-7xl mx-auto px-6 pb-20">
            <h3 class="text-4xl font-extrabold text-center text-indigo-900 mb-12 tracking-wide">
                Hạng Phòng Nổi Bật
            </h3>

            <div class="grid md:grid-cols-3 gap-10">

                @if ($rooms->count() > 0)
                    @foreach ($rooms as $room)
                        <div
                            class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl overflow-hidden transition-all duration-300">

                            {{-- Ảnh --}}
                            <div class="relative">
                                <img src="{{ asset('images/' . $room->image) }}"
                                    class="w-full h-64 object-cover group-hover:scale-105 transition-all duration-500" />

                                <span
                                    class="absolute top-3 right-3 bg-gradient-to-r from-red-500 to-red-400
                            text-white text-sm px-3 py-1 rounded-lg shadow">
                                    Hot
                                </span>
                            </div>

                            {{-- Nội dung --}}
                            <div class="p-6">

                                <h3 class="text-2xl font-bold text-indigo-900 mb-2 group-hover:text-red-500 transition">
                                    {{ $room->name }}
                                </h3>

                                <p class="text-gray-500 text-sm mb-3 flex items-center space-x-3">
                                    <span><i class="fa-solid fa-bed mr-1"></i> {{ $room->type }}</span>
                                    <span>|</span>
                                    <span><i class="fa-solid fa-user-group mr-1"></i> {{ $room->capacity }} Khách</span>
                                </p>

                                <p class="text-gray-600 leading-relaxed mb-6">
                                    {{ Str::limit($room->description, 80) }}
                                </p>

                                <div class="flex justify-between items-center border-t pt-4">

                                    <div>
                                        <p class="text-red-500 font-extrabold text-2xl">
                                            {{ number_format($room->price) }} VNĐ
                                        </p>
                                        <span class="text-gray-500 text-xs">/ đêm</span>
                                    </div>

                                    <a href="{{ route('room.detail', ['id' => $room->id]) }}"
                                        class="px-6 py-2 rounded-full font-semibold border border-red-500 text-red-500
                                hover:bg-red-500 hover:text-white transition-all duration-300 shadow-sm">
                                        Xem chi tiết
                                    </a>
                                </div>

                            </div>

                        </div>
                    @endforeach
                @else
                    <p class="text-center text-gray-600">Chưa có phòng nào!</p>
                @endif

            </div>
        </section>


    </body>
@endsection
