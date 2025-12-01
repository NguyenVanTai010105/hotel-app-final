@extends('layouts.app')

@section('title', 'Chỉnh sửa phòng')

@section('content')
<div class="max-w-3xl mx-auto p-6">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Chỉnh sửa phòng</h1>
    <a href="{{ route('admin.posts.index') }}" class="text-sm text-gray-600 hover:underline">← Quay về danh sách</a>
  </div>

  @if($errors->any())
    <div class="mb-4 p-4 rounded bg-red-50 border border-red-200 text-red-700">
      <strong>Có lỗi xảy ra — vui lòng kiểm tra:</strong>
      <ul class="mt-2 list-disc pl-5">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="bg-white shadow rounded p-6">
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      {{-- Nếu muốn hiển thị ảnh lớn ở trên form --}}
      @if(!empty($post->featured_image))
        <div class="mb-4">
          <label class="block font-medium mb-2">Ảnh hiện tại</label>
          <img src="{{ asset('storage/' . $post->featured_image) }}" alt="featured-{{ $post->id }}"
               style="max-width:360px; width:100%; height:auto; object-fit:cover; border-radius:8px; border:1px solid #e5e7eb;">
        </div>
      @endif

      {{-- Gọi partial form (partial dùng biến $post nếu có) --}}
      @include('admin.posts._form', ['buttonText' => 'Lưu thay đổi'])

    </form>
  </div>
</div>
@endsection
