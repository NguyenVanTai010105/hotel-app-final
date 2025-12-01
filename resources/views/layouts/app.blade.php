<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', 'Admin')</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100 text-gray-900">
  <header class="bg-white shadow">
    <div class="max-w-6xl mx-auto p-4 flex justify-between items-center">
      <div class="text-lg font-semibold"><a href="{{ url('/') }}">My App</a></div>
      <nav class="space-x-4">
        <a href="{{ route('admin.posts.index') }}" class="text-sm text-gray-700">Posts</a>
      </nav>
    </div>
  </header>

  <main class="max-w-6xl mx-auto p-4">
    @yield('content')
  </main>

  <footer class="text-center text-sm text-gray-600 p-4">
    &copy; {{ date('Y') }} My App
  </footer>

  @yield('scripts')
</body>
</html>
