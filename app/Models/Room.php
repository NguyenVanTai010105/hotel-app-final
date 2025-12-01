<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    // Khai báo tên bảng (không bắt buộc nếu tên chuẩn, nhưng nên có cho chắc)
    protected $table = 'rooms';

    // Cho phép nhập dữ liệu vào các cột này
    protected $fillable = [
        'name',
        'slug',
        'type',
        'capacity',
        'price',
        'description',
        'status',
        'image'
    ];
    // Một phòng có nhiều ảnh phụ
public function images()
{
    return $this->hasMany(RoomImage::class);
}
}