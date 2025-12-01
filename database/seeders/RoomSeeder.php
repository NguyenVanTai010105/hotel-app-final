<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; // Thêm dòng này để dùng Schema

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tắt kiểm tra khóa ngoại (Dùng cách này chạy được cả MySQL và SQLite)
        Schema::disableForeignKeyConstraints();

        // Xóa sạch dữ liệu cũ
        DB::table('room_images')->truncate();
        DB::table('rooms')->truncate();

        // Bật lại kiểm tra khóa ngoại
        Schema::enableForeignKeyConstraints();

        // 2. Tạo danh sách phòng mẫu
        $rooms = [
            [
                'name' => 'Phòng Deluxe Hướng Biển',
                'slug' => 'phong-deluxe-huong-bien',
                'type' => 'Deluxe',
                'capacity' => 2,
                'price' => 1500000,
                'image' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=800', 
                'desc' => 'Tận hưởng gió biển mát lạnh với phòng Deluxe sang trọng.',
            ],
            [
                'name' => 'Phòng Suite Gia Đình',
                'slug' => 'phong-suite-gia-dinh',
                'type' => 'Suite',
                'capacity' => 4,
                'price' => 2800000,
                'image' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800',
                'desc' => 'Không gian rộng rãi cho cả gia đình vui chơi.',
            ],
            [
                'name' => 'Phòng Standard Giường Đôi',
                'slug' => 'phong-standard-doi',
                'type' => 'Standard',
                'capacity' => 2,
                'price' => 800000,
                'image' => 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=800',
                'desc' => 'Tiết kiệm nhưng vẫn đầy đủ tiện nghi.',
            ],
            [
                'name' => 'Penthouse Thượng Hạng',
                'slug' => 'penthouse-thuong-hang',
                'type' => 'Luxury',
                'capacity' => 6,
                'price' => 5500000,
                'image' => 'https://images.unsplash.com/photo-1590490360182-c87295ec4232?w=800',
                'desc' => 'Đẳng cấp thượng lưu trên tầng cao nhất.',
            ],
             [
                'name' => 'Phòng Đơn Business',
                'slug' => 'phong-don-business',
                'type' => 'Single',
                'capacity' => 1,
                'price' => 600000,
                'image' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800',
                'desc' => 'Yên tĩnh, phù hợp cho người đi công tác.',
            ],
        ];

        // 3. Vòng lặp để thêm Phòng và Ảnh phụ
        foreach ($rooms as $roomData) {
            $roomId = DB::table('rooms')->insertGetId([
                'name' => $roomData['name'],
                'slug' => $roomData['slug'],
                'type' => $roomData['type'],
                'capacity' => $roomData['capacity'],
                'price' => $roomData['price'],
                'description' => $roomData['desc'],
                'status' => 'available',
                'image' => $roomData['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('room_images')->insert([
                ['room_id' => $roomId, 'image_path' => 'https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?w=800', 'created_at' => now(), 'updated_at' => now()],
                ['room_id' => $roomId, 'image_path' => 'https://images.unsplash.com/photo-1590490359683-65813d246f87?w=800', 'created_at' => now(), 'updated_at' => now()],
                ['room_id' => $roomId, 'image_path' => 'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?w=800', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }
}