@extends('layouts.app')

@section('title', 'Danh sách phòng')

@section('content')
<div class="max-w-7xl mx-auto p-6">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Danh sách phòng</h1>
    <a href="{{ route('admin.posts.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Tạo mới</a>
  </div>

  @if(session('success'))
    <div class="mb-4 p-4 rounded bg-green-50 border border-green-200 text-green-800">
      {{ session('success') }}
    </div>
  @endif

  <div class="bg-white shadow rounded overflow-hidden">
    <table class="w-full">
      <thead class="bg-gray-50 border-b">
        <tr>
          <th class="text-left p-3 w-16">ID</th>
          <th class="text-left p-3">Tên phòng</th>
          <th class="text-left p-3 w-32">Ảnh</th>
          <th class="text-left p-3 w-36">Trạng thái</th>
          <th class="text-left p-3 w-48">Hành động</th>
        </tr>
      </thead>
      <tbody>
        @forelse($posts as $post)
          <tr class="border-b last:border-b-0">
            <td class="p-3 align-top">{{ $post->id }}</td>

            <td class="p-3 align-top">
              <div class="font-medium text-gray-800">{{ $post->title }}</div>
              <div class="text-xs text-gray-500 mt-1">Slug: {{ $post->slug }}</div>
            </td>

            <td class="p-3 align-top">
              @if($post->featured_image_url)
                <img src="{{ $post->featured_image_url }}" alt="thumb-{{ $post->id }}" style="width:100px; height:70px; object-fit:cover; border-radius:6px; border:1px solid #e5e7eb;">
              @else
                <div style="width:100px; height:70px; display:flex; align-items:center; justify-content:center; background:#f8fafc; color:#94a3b8; border-radius:6px; border:1px dashed #e5e7eb; font-size:12px;">
                  Không có ảnh
                </div>
              @endif
            </td>

            <td class="p-3 align-top">
              @if($post->isAvailable())
                <span class="px-2 py-1 bg-green-100 text-green-700 rounded">Còn phòng</span>
              @else
                <span class="px-2 py-1 bg-red-100 text-red-700 rounded">Hết phòng</span>
              @endif

              @if($post->published_at)
                <div class="text-xs text-gray-400 mt-1">Đã đăng: {{ $post->published_at->format('Y-m-d H:i') }}</div>
              @endif
            </td>

            <td class="p-3 align-top">
              <div class="flex items-center gap-2">
                <a href="{{ route('admin.posts.edit', $post) }}" class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded text-sm">Sửa</a>

                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Bạn chắc muốn xóa?')" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm">Xóa</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="p-6 text-center text-gray-500">Chưa có phòng nào.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $posts->links() }}
  </div>
</div>
@endsection
