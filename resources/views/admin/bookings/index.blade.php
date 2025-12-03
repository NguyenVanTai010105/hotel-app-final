@extends('layouts.app')

@section('title','Danh sách đặt phòng')

@section('content')
<div class="max-w-7xl mx-auto p-6">
  <h1 class="text-2xl font-semibold mb-4">Danh sách đặt phòng</h1>

  @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
  @endif

  <div class="bg-white shadow rounded overflow-hidden">
    <table class="w-full">
      <thead class="bg-gray-50 border-b">
        <tr>
          <th class="p-3 text-left">#</th>
          <th class="p-3 text-left">Phòng</th>
          <th class="p-3 text-left">Khách hàng</th>
          <th class="p-3 text-left">Nhận</th>
          <th class="p-3 text-left">Trả</th>
          <th class="p-3 text-left">Trạng thái</th>
          <th class="p-3 text-left">Hành động</th>
        </tr>
      </thead>
      <tbody>
        @forelse($bookings as $b)
          <tr class="border-b">
            <td class="p-3">{{ $b->id }}</td>
            <td class="p-3">{{ $b->post->title ?? '—' }}</td>
            <td class="p-3">
              {{ $b->customer_name }}<div class="text-xs text-gray-500">{{ $b->customer_phone }}</div>
            </td>
            <td class="p-3">{{ $b->check_in }}</td>
            <td class="p-3">{{ $b->check_out }}</td>
            <td class="p-3">
              <span class="px-2 py-1 rounded bg-gray-100 text-gray-800">{{ $b->status }}</span>
            </td>
            <td class="p-3">
              <div class="flex gap-2">
                <a href="{{ route('admin.bookings.show', $b) }}" class="px-3 py-1 bg-blue-500 text-white rounded text-sm">Xem</a>
                <form action="{{ route('admin.bookings.destroy', $b) }}" method="POST" onsubmit="return confirm('Xóa booking?')">
                  @csrf
                  @method('DELETE')
                  <button class="px-3 py-1 bg-red-600 text-white rounded text-sm">Xóa</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" class="p-6 text-center text-gray-500">Không có booking.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $bookings->links() }}
  </div>
</div>
@endsection
