{{-- resources/views/layouts/app.blade.php --}}
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', 'Admin')</title>

  {{-- Dùng Tailwind CDN như bạn đang dùng (nếu muốn vite, thay bằng @vite) --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  @stack('head') {{-- nếu view con cần thêm css/js vào head --}}
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800">

  {{-- Header chung --}}
  @includeIf('components.header')

  {{-- Main layout:
      nếu là route admin* => hiển thị sidebar bên trái + nội dung bên phải
      khác => hiển thị nội dung bình thường
  --}}
  <div class="flex grow">
    @if(request()->is('admin*'))
      {{-- Sidebar (chứa link Posts / Bookings / quick filter). Tạo file partial ở resources/views/partials/admin_sidebar.blade.php --}}
      <aside class="hidden md:block w-64 border-r bg-white">
        @includeIf('partials.admin_sidebar')
      </aside>

      {{-- Nội dung chính --}}
      <main class="flex-1 p-6">
        @if (session('success'))
          <div class="mb-4 p-3 rounded bg-green-50 border border-green-200 text-green-800">
            {{ session('success') }}
          </div>
        @endif

        @yield('content')
      </main>

    @else
      {{-- Non-admin layout (public) --}}
      <main class="grow container mx-auto px-4 py-8">
        @if (session('success'))
          <div class="mb-4 p-3 rounded bg-green-50 border border-green-200 text-green-800">
            {{ session('success') }}
          </div>
        @endif

        @yield('content')
      </main>
    @endif
  </div>

  {{-- Footer chung --}}
  @includeIf('components.footer')

  @stack('scripts') {{-- để push('scripts') ở view con --}}
</body>
</html>
