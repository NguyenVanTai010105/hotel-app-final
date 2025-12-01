@csrf

<div class="mb-4">
    <label class="block font-medium">Tên phòng</label>
    <input type="text" name="title" id="title"
           value="{{ old('title', $post->title ?? '') }}"
           class="border p-2 w-full" required>
    @error('title') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
</div>

<div class="mb-4">
    <label class="block font-medium">Slug</label>
    <input type="text" name="slug" id="slug"
           value="{{ old('slug', $post->slug ?? '') }}"
           class="border p-2 w-full">
    <p class="text-xs text-gray-500">Để trống để tự sinh từ tiêu đề.</p>
</div>

<div class="mb-4">
    <label class="block font-medium">Nội dung</label>
    <textarea name="content" rows="6"
              class="border p-2 w-full">{{ old('content', $post->content ?? '') }}</textarea>
    @error('content') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
</div>

<div class="mb-6">
    <label class="block font-medium">Ảnh đại diện</label>

    {{-- Input để upload ảnh mới, KHÔNG hiển thị preview trong form --}}
    <input
        type="file"
        name="featured_image"
        id="featured_image"
        class="border p-2 w-full"
    >

    <p class="text-xs text-gray-500 mt-1">
        Chọn ảnh mới nếu muốn thay ảnh hiện tại.
    </p>
</div>

<div class="mb-4">
    <label class="block font-medium">Trạng thái phòng</label>
    <select name="status" class="border p-2 w-full">
        <option value="available"
            @if(old('status', $post->status ?? '') === 'available') selected @endif>
            Còn phòng
        </option>

        <option value="unavailable"
            @if(old('status', $post->status ?? '') === 'unavailable') selected @endif>
            Hết phòng
        </option>
    </select>
</div>

<div class="mt-4">
    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
        {{ $buttonText }}
    </button>
    <a href="{{ route('admin.posts.index') }}"
       class="ml-2 px-4 py-2 border rounded">
        Hủy
    </a>
</div>
