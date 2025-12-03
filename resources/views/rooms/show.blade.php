@extends('layouts.app')

@section('title', $post->title ?? 'Phòng')

@section('content')
<div class="max-w-4xl mx-auto p-6">
  <div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-semibold">{{ $post->title }}</h1>
    <div class="text-sm text-gray-500 mb-4">Slug: {{ $post->slug }}</div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        @if($post->featured_image_url)
          <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full rounded">
        @endif

        <div class="mt-4 text-gray-700">{!! nl2br(e($post->content)) !!}</div>
      </div>

      <aside>
        <div class="p-4 border rounded mb-4">
          <div class="text-lg font-medium mb-2">Đặt phòng</div>

          <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">

            <label class="block text-sm">Tên</label>
            <input name="guest_name" value="{{ old('guest_name') }}" class="border p-2 w-full" required>
            @error('guest_name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror

            <label class="block text-sm mt-2">Email</label>
            <input name="guest_email" value="{{ old('guest_email') }}" class="border p-2 w-full" required>
            @error('guest_email') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror

            <label class="block text-sm mt-2">Ngày nhận</label>
            <input type="date" name="check_in" value="{{ old('check_in') }}" class="border p-2 w-full" required>
            @error('check_in') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror

            <label class="block text-sm mt-2">Ngày trả</label>
            <input type="date" name="check_out" value="{{ old('check_out') }}" class="border p-2 w-full" required>
            @error('check_out') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror

            <label class="block text-sm mt-2">Số khách</label>
            <input type="number" name="guests" value="{{ old('guests',1) }}" min="1" class="border p-2 w-full">

            <div class="mt-4">
              <button class="px-4 py-2 bg-green-600 text-white rounded">Đặt ngay</button>
            </div>
          </form>
        </div>

        <div class="p-4 border rounded text-sm text-gray-700">
          <div>Giá / đêm: <strong>{{ number_format($post->price ?? 0,0,',','.') }} đ</strong></div>
          <div>Sức chứa: {{ $post->capacity }} người</div>
          <div class="mt-2">Trạng thái: 
            @if(method_exists($post,'isAvailableBetween') && $post->isAvailableBetween(now()->toDateString(), now()->addDay()->toDateString()))
              <span class="text-green-600">Còn phòng</span>
            @else
              <span class="text-red-600">Hết phòng</span>
            @endif
          </div>
        </div>
      </aside>
    </div>
  </div>
</div>
@endsection
