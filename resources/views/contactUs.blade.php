@extends('layouts.app')
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
        <div class="max-w-7xl mx-auto px-4 py-16">
            <!-- Tiêu đề -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-[#0F3B37] mb-3">Contact Us</h1>
                <p class="text-gray-600 max-w-xl mx-auto">
                    Nếu bạn có bất kỳ câu hỏi hay cần hỗ trợ, đừng ngần ngại liên hệ với chúng tôi.
                </p>
            </div>

            <!-- Nội dung -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                <!-- Thông tin liên hệ -->
                <div class="bg-white rounded-2xl shadow-lg p-8 space-y-6">
                    <h2 class="text-2xl font-semibold text-[#0F3B37] mb-4">
                        Thông tin liên hệ
                    </h2>

                    <div class="flex items-start gap-4">
                        <div class="text-[#F5A623] text-xl">📍</div>
                        <p class="text-gray-700">
                            123 ĐHĐN, Đà Nẵng, Việt Nam
                        </p>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="text-[#F5A623] text-xl">📞</div>
                        <p class="text-gray-700">
                            +84 123 456 JQK
                        </p>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="text-[#F5A623] text-xl">✉️</div>
                        <p class="text-gray-700">
                            combany36@gmail.com
                        </p>
                    </div>

                    <div class="pt-4 text-sm text-gray-500">
                        Thời gian làm việc: Thứ 2 – Thứ 7 (8:00 – 18:00)
                    </div>
                    <div class="mt-16">
                        <h2 class="text-2xl font-bold text-[#0F3B37] mb-6 text-center">
                            Vị trí của chúng tôi
                        </h2>

                        <div class="w-full h-[400px] rounded-2xl overflow-hidden shadow-lg">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.0740370773774!2d108.1565490749039!3d16.061647384616748!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31421924682e8689%3A0x48eb0bdbeec05215!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBTxrAgUGjhuqFtIC0gxJDhuqFpIGjhu41jIMSQw6AgTuG6tW5n!5e0!3m2!1svi!2s!4v1766034510258!5m2!1svi!2s"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade" class="w-full h-full border-0"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>

                <!-- Form liên hệ -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-semibold text-[#0F3B37] mb-6">
                        Gửi liên hệ
                    </h2>

                    <form method="POST" action="{{ route('contactStore') }}">
                        @csrf
                        <!-- Name -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Họ và tên
                            </label>
                            <input type="text" name="name"
                                class="w-full rounded-lg border px-4 py-2 focus:ring-2 focus:ring-[#F5A623] focus:outline-none">
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Email
                            </label>
                            <input type="email" name="email"
                                class="w-full rounded-lg border px-4 py-2 focus:ring-2 focus:ring-[#F5A623] focus:outline-none">
                        </div>

                        <!-- Message -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Nội dung
                            </label>
                            <textarea name="message" rows="4"
                                class="w-full rounded-lg border px-4 py-2 focus:ring-2 focus:ring-[#F5A623] focus:outline-none"></textarea>
                        </div>

                        <!-- Button -->
                        <button type="submit"
                            class="w-full bg-[#0F3B37] text-white py-3 rounded-xl
                           hover:bg-[#F5A623] hover:text-[#0F3B37]
                           transition-all duration-300 font-medium">
                            Gửi liên hệ
                        </button>
                    </form>
                    <!-- Google Map -->


                </div>

            </div>
        </div>
    </body>
    <script>
        < script >
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
        } <
        />
    </script>
@endsection
