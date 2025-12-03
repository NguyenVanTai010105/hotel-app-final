@extends('layouts.app')

@section('title','Tạo phòng mới')

@section('content')
<div class="max-w-4xl mx-auto p-8">
  <div class="bg-gradient-to-r from-gray-50 via-white to-gray-50 rounded-2xl shadow-2xl overflow-hidden">
    <div class="p-8 bg-[rgba(255,255,255,0.6)] backdrop-blur-sm">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">Tạo phòng mới</h1>
          <p class="mt-1 text-sm text-gray-500">Thiết lập phòng theo phong cách quốc tế — sang trọng, tối giản.</p>
        </div>
        <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg shadow">
          <!-- heroicon: arrow-left -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Quay về danh sách
        </a>
      </div>

      @if($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-100 text-red-700">
          <ul class="list-disc pl-5">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tiêu đề</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   class="w-full rounded-xl border border-gray-200 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-300">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Loại phòng</label>
            <div class="flex gap-3">
              <label class="flex items-center gap-2 rounded-lg cursor-pointer px-3 py-2 border">
                <input type="radio" name="type" value="Standard" {{ old('type')=='Standard' ? 'checked':'' }} onchange="applyPrice()" checked>
                <div>
                  <div class="text-sm font-semibold">Standard</div>
                  <div class="text-xs text-gray-500">Tiện nghi cơ bản — giá ổn định</div>
                </div>
              </label>

              <label class="flex items-center gap-2 rounded-lg cursor-pointer px-3 py-2 border">
                <input type="radio" name="type" value="VIP" {{ old('type')=='VIP' ? 'checked':'' }} onchange="applyPrice()">
                <div>
                  <div class="text-sm font-semibold">VIP</div>
                  <div class="text-xs text-gray-500">Sang trọng hơn — dành cho khách cao cấp</div>
                </div>
              </label>
            </div>
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Mô tả ngắn</label>
          <textarea name="description" rows="4" class="w-full rounded-xl border border-gray-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-300">{{ old('description') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Sức chứa</label>
            <input type="number" name="capacity" min="1" value="{{ old('capacity', 2) }}" class="w-full rounded-xl border border-gray-200 px-4 py-3">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Giá (VNĐ)</label>
            <input id="priceInput" type="number" name="price" value="{{ old('price') }}" step="1" min="0" class="w-full rounded-xl border border-gray-200 px-4 py-3 bg-white" readonly>
            <p class="mt-1 text-xs text-gray-500">Giá mặc định theo loại phòng. Bật "Tùy chỉnh giá" để chỉnh tay.</p>
          </div>

          <div class="flex flex-col">
            <label class="block text-sm font-medium text-gray-700 mb-2">Tùy chọn</label>
            <div class="flex items-center gap-3">
              <label class="inline-flex items-center gap-2">
                <input id="overridePrice" type="checkbox" onchange="togglePriceEditable()" class="h-4 w-4">
                <span class="text-sm">Tùy chỉnh giá</span>
              </label>
              <label class="inline-flex items-center gap-2">
                <select name="status" class="rounded-xl border border-gray-200 px-3 py-2">
                  <option value="available" {{ old('status')=='available' ? 'selected':'' }}>Còn phòng</option>
                  <option value="unavailable" {{ old('status')=='unavailable' ? 'selected':'' }}>Hết phòng</option>
                </select>
              </label>
            </div>
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Ảnh đại diện</label>
          <div class="flex items-center gap-4">
            <div id="featuredPreview" class="w-40 h-28 rounded-xl bg-gray-100 flex items-center justify-center overflow-hidden border border-dashed border-gray-200">
              <span class="text-xs text-gray-400">Chưa có ảnh</span>
            </div>
            <div class="flex-1">
              <input id="featuredInput" type="file" name="featured_image" accept="image/*" class="block w-full text-sm text-gray-500 file:rounded-xl file:border-0 file:px-4 file:py-2 file:bg-amber-600 file:text-white">
              <p class="mt-2 text-xs text-gray-500">Ảnh chính hiển thị trên danh sách và chi tiết. Kích thước đề xuất: 1200x800.</p>
            </div>
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Gallery ảnh (chọn nhiều)</label>
          <div id="galleryDrop" class="min-h-[120px] rounded-xl border border-dashed border-gray-200 p-4 flex flex-wrap gap-3 bg-white">
            <div class="w-full text-xs text-gray-500">Kéo thả ảnh vào đây hoặc bấm chọn. Xem trước sẽ hiển thị bên dưới.</div>
          </div>
          <input id="galleryInput" type="file" name="images[]" multiple accept="image/*" class="hidden">
          <div id="galleryPreview" class="mt-3 flex gap-3 flex-wrap"></div>
        </div>

        <div class="flex items-center justify-end gap-3">
          <a href="{{ route('admin.posts.index') }}" class="px-5 py-2 rounded-lg border border-gray-200">Hủy</a>
          <button type="submit" class="inline-flex items-center gap-2 px-6 py-2 rounded-lg bg-amber-600 hover:bg-amber-700 text-white shadow-xl">
            Lưu phòng
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Prices per type: adjust as required -->
<script>
  const PRICES = {
    Standard: 300000,
    VIP: 600000
  };

  function applyPrice(){
    const type = document.querySelector('input[name="type"]:checked').value;
    const priceInput = document.getElementById('priceInput');
    if (!document.getElementById('overridePrice').checked) {
      priceInput.value = PRICES[type];
    }
  }

  function togglePriceEditable(){
    const priceInput = document.getElementById('priceInput');
    const override = document.getElementById('overridePrice').checked;
    priceInput.readOnly = !override;
    priceInput.classList.toggle('bg-white', override);
    priceInput.classList.toggle('bg-gray-100', !override);
  }

  // Featured preview
  document.getElementById('featuredInput').addEventListener('change', function(e){
    const file = this.files[0];
    const preview = document.getElementById('featuredPreview');
    preview.innerHTML = '';
    if (!file) { preview.innerHTML = '<span class="text-xs text-gray-400">Chưa có ảnh</span>'; return; }
    const img = document.createElement('img');
    img.src = URL.createObjectURL(file);
    img.style.width = '100%';
    img.style.height = '100%';
    img.style.objectFit = 'cover';
    preview.appendChild(img);
  });

  // Gallery drop & preview
  const drop = document.getElementById('galleryDrop');
  const galleryInput = document.getElementById('galleryInput');
  const galleryPreview = document.getElementById('galleryPreview');

  drop.addEventListener('click', () => galleryInput.click());
  drop.addEventListener('dragover', e => { e.preventDefault(); drop.classList.add('ring-2','ring-amber-300'); });
  drop.addEventListener('dragleave', () => drop.classList.remove('ring-2','ring-amber-300'));
  drop.addEventListener('drop', e => {
    e.preventDefault();
    drop.classList.remove('ring-2','ring-amber-300');
    const files = Array.from(e.dataTransfer.files).filter(f => f.type.startsWith('image/'));
    galleryInput.files = fileListFromArray(files);
    renderGallery(files);
  });

  galleryInput.addEventListener('change', () => {
    const files = Array.from(galleryInput.files);
    renderGallery(files);
  });

  function renderGallery(files){
    galleryPreview.innerHTML = '';
    files.forEach((file, idx) => {
      const box = document.createElement('div');
      box.className = 'w-28 h-20 rounded-lg overflow-hidden border';
      const img = document.createElement('img');
      img.src = URL.createObjectURL(file);
      img.style.width = '100%';
      img.style.height = '100%';
      img.style.objectFit = 'cover';
      box.appendChild(img);
      galleryPreview.appendChild(box);
    });
  }

  // helper to set FileList
  function fileListFromArray(files){
    const dt = new DataTransfer();
    files.forEach(f => dt.items.add(f));
    return dt.files;
  }

  // init
  document.addEventListener('DOMContentLoaded', () => {
    applyPrice();
    togglePriceEditable();
  });
</script>
@endsection
