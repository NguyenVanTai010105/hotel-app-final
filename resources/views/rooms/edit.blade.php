<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa phòng</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg p-6 relative">
        <!-- Thanh thông báo -->
        <div class="absolute top-0 left-0 w-full bg-blue-600 text-white text-center py-2 rounded-t-2xl font-semibold">
            Trang chỉnh sửa phòng - Phòng số {{ $room->id }}
        </div>

        <h2 class="text-2xl font-bold mb-6 text-gray-800 mt-10 text-center">
            ✏️ Sửa thông tin phòng
        </h2>
        <form method="POST" action="{{ route('admin.update', $room->id) }}" enctype="multipart/form-data">
            @csrf

            <!-- Tên phòng -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Tên phòng</label>
                <input type="text" name="name" value="{{ old('name', $room->name) }}"
                    class="w-full rounded-lg border px-4 py-2 focus:ring focus:ring-blue-300">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Sức chứa -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Sức chứa</label>
                <input type="number" name="capacity" value="{{ old('capacity', $room->capacity) }}"
                    class="w-full rounded-lg border px-4 py-2">
                @error('capacity')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Giá -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Giá phòng</label>
                <input type="number" name="price" value="{{ old('price', $room->price) }}"
                    class="w-full rounded-lg border px-4 py-2">
                @error('price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Mô tả -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Mô tả</label>
                <textarea name="description" class="w-full rounded-lg border px-4 py-2" rows="3">{{ old('description', $room->description) }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Trạng thái -->
            <div class="mb-6">
                <label class="block font-medium mb-1">Trạng thái</label>
                <select name="status" class="w-full rounded-lg border px-4 py-2">
                    <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>
                        Còn trống
                    </option>
                    <option value="not available" {{ $room->status == 'not available' ? 'selected' : '' }}>
                        Đã có người
                    </option>

                </select>
            </div>
            <!-- Ảnh phòng -->
            <div class="mb-6">
                @if ($room->image)
                    <p class="block font-medium mb-1">Ảnh hiện tại</p>
                    <img src="{{ asset('storage/' . $room->image) }}" alt="Ảnh phòng"
                        class="mt-2 w-auto h-24 object-cover rounded-lg border">
                @endif
                <label class="block font-medium mb-1">Ảnh phòng sau khi chỉnh sửa</label>
                <input type="file" name="image" class="w-full rounded-lg border px-4 py-2">
                @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Button -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.index') }}" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
                    Hủy
                </a>

                <button type="submit"
                    class="px-5 py-2 rounded-lg bg-blue-600 text-white
                           hover:bg-blue-700 transition hover:scale-105">
                    Lưu thay đổi
                </button>
            </div>
        </form>
    </div>

</body>

</html>
