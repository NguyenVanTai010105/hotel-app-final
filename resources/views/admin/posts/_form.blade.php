@csrf

<div class="mb-4">
  <label class="block font-medium">Tiêu đề</label>
  <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}" class="border p-2 w-full" required>
</div>

<div class="mb-4">
  <label class="block font-medium">Slug</label>
  <input type="text" name="slug" value="{{ old('slug', $post->slug ?? '') }}" class="border p-2 w-full">
  <p class="text-xs text-gray-500">Để trống để tự sinh từ tiêu đề.</p>
</div>

<div class="mb-4">
  <label class="block font-medium">Loại phòng</label>
  <input type="text" name="type" value="{{ old('type', $post->type ?? '') }}" class="border p-2 w-full">
</div>

<div class="grid grid-cols-2 gap-4 mb-4">
  <div>
    <label class="block font-medium">Sức chứa</label>
    <input type="number" name="capacity" value="{{ old('capacity', $post->capacity ?? 1) }}" class="border p-2 w-full">
  </div>
  <div>
    <label class="block font-medium">Giá (VNĐ)</label>
    <input type="number" step="0.01" name="price" value="{{ old('price', $post->price ?? 0) }}" class="border p-2 w-full">
  </div>
</div>

<div class="mb-4">
  <label class="block font-medium">Mô tả</label>
  <textarea name="description" rows="6" class="border p-2 w-full">{{ old('description', $post->description ?? '') }}</textarea>
</div>

<<div class="mb-4">
  <label class="block font-medium">Ảnh (có thể chọn nhiều ảnh)</label>
  <input type="file" name="images[]" id="images" class="border p-2" multiple accept="image/*">

  @if(isset($post) && $post->images->count())
    <div class="mt-3 grid grid-cols-3 gap-3">
      @foreach($post->images as $image)
        <div class="relative border rounded p-1">
          <img src="{{ $image->url }}" style="width:100%; height:150px; object-fit:cover;">
          <form action="{{ route('admin.posts.images.destroy', [$post->id, $image->id]) }}" method="POST" 
                onsubmit="return confirm('Xóa ảnh này?')" style="position:absolute; top:6px; right:6px;">
            @csrf
            @method('DELETE')
            <button class="bg-red-500 text-white px-2 py-1 text-xs rounded">Xóa</button>
          </form>
        </div>
       
<div class="mb-4">
  <label class="block font-medium">Trạng thái</label>
  <select name="status" class="border p-2 w-full">
    <option value="available" {{ old('status', $post->status ?? 'available') === 'available' ? 'selected' : '' }}>Còn phòng</option>
    <option value="unavailable" {{ old('status', $post->status ?? '') === 'unavailable' ? 'selected' : '' }}>Hết phòng</option>
  </select>
</div>

<div class="mt-4">
  <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">{{ $buttonText ?? 'Lưu' }}</button>
  <a href="{{ route('admin.posts.index') }}" class="ml-2 px-4 py-2 border rounded">Hủy</a>
</div>
