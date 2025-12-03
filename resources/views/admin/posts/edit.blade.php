@extends('layouts.app')

@section('title','Sửa phòng')

@section('content')
<div class="max-w-4xl mx-auto p-6">
  <div class="bg-gradient-to-r from-gray-50 via-white to-gray-50 rounded-2xl shadow-lg overflow-hidden">
    <div class="p-6 bg-white/60 backdrop-blur-sm">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-2xl font-extrabold tracking-tight">Chỉnh sửa phòng</h1>
          <p class="text-sm text-gray-500">{{ $post->title }}</p>
        </div>
        <div class="text-right">
          <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-gray-200 bg-white text-sm hover:shadow">
            ← Quay lại danh sách
          </a>
        </div>
      </div>

      @if($errors->any())
        <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-100 text-red-700">
          <ul class="list-disc pl-5">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Tiêu đề</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required
              class="mt-1 w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-indigo-200 p-3" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Slug (tùy chọn)</label>
            <input type="text" name="slug" value="{{ old('slug', $post->slug) }}"
              class="mt-1 w-full rounded-lg border-gray-200 shadow-sm p-3" />
            <p class="text-xs text-gray-400 mt-1">Để trống để hệ thống tự sinh từ tiêu đề.</p>
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Mô tả</label>
          <textarea name="description" rows="5"
            class="mt-1 w-full rounded-lg border-gray-200 shadow-sm p-3">{{ old('description', $post->description) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Sức chứa</label>
            <input type="number" name="capacity" min="1" value="{{ old('capacity', $post->capacity) }}"
              class="mt-1 w-full rounded-lg border-gray-200 shadow-sm p-3" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Loại phòng</label>
            <select name="type" class="mt-1 w-full rounded-lg border-gray-200 shadow-sm p-3">
              <option value="Standard" {{ old('type', $post->type)=='Standard' ? 'selected':'' }}>Standard</option>
              <option value="VIP" {{ old('type', $post->type)=='VIP' ? 'selected':'' }}>VIP</option>
              <option value="Deluxe" {{ old('type', $post->type)=='Deluxe' ? 'selected':'' }}>Deluxe</option>
              <option value="Deluxe+ (Luxury)" {{ old('type', $post->type)=='Deluxe+ (Luxury)' ? 'selected':'' }}>Deluxe+ (Luxury)</option>
            </select>
            <p class="text-xs text-gray-400 mt-1">Nếu bạn áp giá chung theo loại, xử lý logic trong controller.</p>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Giá (VNĐ)</label>
            <input type="number" name="price" step="0.01" min="0" value="{{ old('price', $post->price) }}"
              class="mt-1 w-full rounded-lg border-gray-200 shadow-sm p-3" />
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Ảnh đại diện hiện tại</label>
            <div class="mt-2">
              @if(!empty($post->featured_image_url))
                <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}"
                  class="w-full md:w-64 h-40 object-cover rounded-lg shadow-sm border" />
              @else
                <div class="w-full md:w-64 h-40 flex items-center justify-center bg-gray-50 border rounded-lg text-gray-400">Chưa có ảnh</div>
              @endif
            </div>
            <div class="mt-3">
              <label class="block text-sm font-medium text-gray-700">Thay ảnh đại diện</label>
              <input type="file" name="featured_image" class="mt-1 w-full" />
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Gallery hiện tại</label>
            <div class="mt-2 grid grid-cols-2 gap-3">
              @foreach($post->images ?? collect() as $img)
                <div class="relative bg-white rounded-lg overflow-hidden border">
                  <img src="{{ $img->url }}" alt="img-{{ $img->id }}" class="w-full h-32 object-cover">
                  <div class="p-2 flex items-center justify-between">
                    <span class="text-xs text-gray-500">#{{ $img->id }}</span>

                    {{-- dùng url() thay cho route() để tránh lỗi route không tồn tại --}}
                    <form action="{{ url('/admin/posts/images/'.$img->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa ảnh này?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-white text-xs bg-red-600 px-2 py-1 rounded">Xóa</button>
                    </form>
                  </div>
                </div>
              @endforeach

              @if(($post->images ?? collect())->isEmpty())
                <div class="col-span-2 p-4 text-center text-gray-400 border rounded">Chưa có ảnh gallery</div>
              @endif
            </div>

            <div class="mt-3">
              <label class="block text-sm font-medium text-gray-700">Thêm ảnh (gallery) — chọn nhiều</label>
              <input type="file" name="images[]" multiple class="mt-1 w-full" />
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
          <div>
            <label class="block text-sm font-medium text-gray-700">Trạng thái</label>
            <select name="status" class="mt-1 w-full rounded-lg border-gray-200 shadow-sm p-3">
              <option value="available" {{ old('status', $post->status)=='available' ? 'selected':'' }}>Còn phòng</option>
              <option value="unavailable" {{ old('status', $post->status)=='unavailable' ? 'selected':'' }}>Hết phòng</option>
              <option value="hidden" {{ old('status', $post->status)=='hidden' ? 'selected':'' }}>Ẩn (Draft)</option>
            </select>
          </div>

          <div class="flex justify-end gap-3">
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg shadow hover:scale-[1.01] transition">
              Lưu thay đổi
            </button>
            <a href="{{ route('admin.posts.index') }}" class="px-6 py-3 border rounded-lg">Hủy</a>
          </div>
        </div>
      </form>

      {{-- small helper --}}
      <div class="mt-6 text-xs text-gray-400">
        Ghi chú: nếu bạn muốn xóa ảnh bằng route helper (ví dụ route('admin.posts.images.destroy')), hãy định nghĩa route đó trong routes/web.php:
        <pre class="mt-2 p-2 bg-gray-100 rounded text-xs">Route::delete('admin/posts/images/{id}', [PostImageController::class,'destroy'])->name('admin.posts.images.destroy');</pre>
        Hoặc giữ cách dùng URL như trên — đều OK.
      </div>
    </div>
  </div>
</div>
@endsection
