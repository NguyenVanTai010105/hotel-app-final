@extends('layouts.app')

@section('title','Danh sách phòng')

@section('content')
<div class="max-w-7xl mx-auto p-6">
  <div class="flex items-center justify-between mb-8">
    <div>
      <h1 class="text-3xl font-extrabold tracking-tight">Danh sách phòng</h1>
      <p class="text-sm text-gray-500 mt-1">Quản lý phòng — giao diện sang trọng, tinh tế.</p>
    </div>
    <div class="flex items-center gap-3">
      <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white px-4 py-2 rounded-lg shadow-lg hover:opacity-95">
        <!-- plus icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tạo mới
      </a>
    </div>
  </div>

  @if(session('success'))
    <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800">
      {{ session('success') }}
    </div>
  @endif

  {{-- Grid cards --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($posts as $post)
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow">
        <div class="relative">
          @if($post->featured_image_url)
            <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-52 object-cover">
          @elseif($post->images->first())
            <img src="{{ $post->images->first()->url }}" alt="{{ $post->title }}" class="w-full h-52 object-cover">
          @else
            <div class="w-full h-52 flex items-center justify-center bg-gray-100 text-gray-400">
              Không có ảnh
            </div>
          @endif

          {{-- Type badge --}}
          <div class="absolute top-3 left-3">
            @php
              $type = strtolower($post->type ?? 'standard');
              $typeClasses = [
                'vip' => 'bg-gradient-to-r from-pink-600 to-violet-600 text-white',
                'deluxe' => 'bg-gradient-to-r from-indigo-600 to-blue-600 text-white',
                'standard' => 'bg-gray-900 text-white'
              ];
              $badgeClass = $typeClasses[$type] ?? $typeClasses['standard'];
            @endphp
            <span class="px-3 py-1 rounded-full text-xs font-semibold shadow-sm {{ $badgeClass }}">{{ ucfirst($post->type ?? 'Standard') }}</span>
          </div>

          {{-- Status pill --}}
          <div class="absolute top-3 right-3">
            @if($post->status === \App\Models\Post::STATUS_AVAILABLE || $post->status === 'available')
              <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-medium">Còn phòng</span>
            @else
              <span class="px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs font-medium">Hết phòng</span>
            @endif
          </div>
        </div>

        <div class="p-5">
          <div class="flex items-start justify-between">
            <div>
              <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
              @if($post->description)
                <p class="text-sm text-gray-500 mt-1">{{ \Illuminate\Support\Str::limit($post->description, 110) }}</p>
              @endif
            </div>
            <div class="text-right">
              {{-- Price --}}
              <div class="text-xl font-bold text-amber-600">
                {{-- format price --}}
                {{ number_format($post->price ?? 0, 0, ',', '.') }}₫
              </div>
              <div class="text-xs text-gray-400 mt-1">/ đêm</div>
            </div>
          </div>

          <div class="mt-4 grid grid-cols-3 gap-2 text-center">
            <div>
              <div class="text-xs text-gray-500">Sức chứa</div>
              <div class="font-medium">{{ $post->capacity ?? '-' }}</div>
            </div>
            <div>
              <div class="text-xs text-gray-500">Gallery</div>
              <div class="font-medium">{{ $post->images->count() }}</div>
            </div>
            <div>
              <div class="text-xs text-gray-500">Ngày tạo</div>
              <div class="font-medium">{{ $post->created_at ? $post->created_at->format('d M Y') : '-' }}</div>
            </div>
          </div>

              <!-- eye icon -->
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7S3.732 16.057 2.458 12z" />
              </svg>
              Xem
            </a>

            <div class="flex items-center gap-2">
              <a href="{{ route('admin.posts.edit', $post->id) }}" class="px-3 py-2 bg-yellow-400 text-white rounded-lg text-sm shadow-sm hover:opacity-95">Sửa</a>

              <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xóa?');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-2 bg-red-600 text-white rounded-lg text-sm shadow-sm hover:opacity-95">Xóa</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-span-full">
        <div class="py-16 text-center border-2 border-dashed rounded-xl text-gray-400">
          Chưa có phòng nào. Hãy tạo phòng mới để bắt đầu.
        </div>
      </div>
    @endforelse
  </div>

  {{-- Pagination --}}
  <div class="mt-8 flex justify-end">
    <nav class="inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
      {{ $posts->links() }}
    </nav>
  </div>
</div>
@endsection
