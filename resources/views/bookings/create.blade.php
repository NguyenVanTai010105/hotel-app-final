@extends('layouts.app')

@section('title','Đặt phòng')

@section('content')
<div class="max-w-2xl mx-auto p-6">
  <h1 class="text-xl font-semibold mb-4">Đặt phòng: {{ $post->title }}</h1>

  @if($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
      Vui lòng kiểm tra thông tin.
    </div>
  @endif

  <form action="{{ route('bookings.store') }}" method="POST">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">

    <div class="mb-3">
      <label class="block text-sm">Họ tên</label>
      <input type="text" name="customer_name" value="{{ old('customer_name') }}" class="border p-2 w-full" required>
    </div>

    <div class="mb-3">
      <label class="block text-sm">Số điện thoại</label>
      <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" class="border p-2 w-full" required>
    </div>

    <div class="mb-3">
      <label class="block text-sm">Email (tuỳ chọn)</label>
      <input type="email" name="customer_email" value="{{ old('customer_email') }}" class="border p-2 w-full">
    </div>

    <div class="grid grid-cols-2 gap-3 mb-3">
      <div>
        <label class="block text-sm">Nhận</label>
        <input type="date" name="check_in" value="{{ old('check_in') }}" class="border p-2 w-full" required>
      </div>
      <div>
        <label class="block text-sm">Trả</label>
        <input type="date" name="check_out" value="{{ old('check_out') }}" class="border p-2 w-full" required>
      </div>
    </div>

    <div class="mb-3">
      <label class="block text-sm">Số khách</label>
      <input type="number" name="guests" value="{{ old('guests',1) }}" min="1" class="border p-2 w-24">
    </div>

    <div class="mt-4">
      <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Đặt phòng</button>
    </div>
  </form>
</div>
@endsection
