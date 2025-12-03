@extends('layouts.app')

@section('title','Chi tiết booking')

@section('content')
<div class="max-w-3xl mx-auto p-6">
  <a href="{{ route('admin.bookings.index') }}" class="text-sm text-gray-600 mb-4 inline-block">← Quay về</a>

  <div class="bg-white shadow rounded p-6">
    <h2 class="text-xl font-semibold mb-2">Booking #{{ $booking->id }}</h2>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <div class="text-sm text-gray-500">Phòng</div>
        <div class="font-medium">{{ $booking->post->title ?? '—' }}</div>
      </div>
      <div>
        <div class="text-sm text-gray-500">Trạng thái</div>
        <div class="font-medium">{{ $booking->status }}</div>
      </div>

      <div>
        <div class="text-sm text-gray-500">Khách</div>
        <div class="font-medium">{{ $booking->customer_name }}</div>
        <div class="text-xs text-gray-500">{{ $booking->customer_phone }} • {{ $booking->customer_email }}</div>
      </div>

      <div>
        <div class="text-sm text-gray-500">Số khách</div>
        <div class="font-medium">{{ $booking->guests }}</div>
      </div>

      <div>
        <div class="text-sm text-gray-500">Nhận</div>
        <div class="font-medium">{{ $booking->check_in }}</div>
      </div>

      <div>
        <div class="text-sm text-gray-500">Trả</div>
        <div class="font-medium">{{ $booking->check_out }}</div>
      </div>
    </div>

    <div class="mt-6 flex items-center gap-3">
      <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
        @csrf
        @method('PUT')
        <select name="status" class="border p-2">
          <option value="pending" @if($booking->status=='pending') selected @endif>pending</option>
          <option value="confirmed" @if($booking->status=='confirmed') selected @endif>confirmed</option>
          <option value="cancelled" @if($booking->status=='cancelled') selected @endif>cancelled</option>
        </select>
        <button class="ml-2 px-3 py-1 bg-blue-600 text-white rounded">Lưu</button>
      </form>

      <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Xóa?')">
        @csrf @method('DELETE')
        <button class="px-3 py-1 bg-red-600 text-white rounded">Xóa</button>
      </form>
    </div>
  </div>
</div>
@endsection
