<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    // trạng thái chuẩn cho "phòng"
    public const STATUS_AVAILABLE = 'available';     // còn phòng
    public const STATUS_UNAVAILABLE = 'unavailable'; // hết phòng

    /**
     * Các thuộc tính có thể gán hàng loạt
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    /**
     * Các thuộc tính cần cast
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Luôn append URL ảnh khi toArray()/toJson()
     *
     * @var array
     */
    protected $appends = [
        'featured_image_url',
    ];

    /**
     * Accessor: trả về URL public của ảnh hoặc null
     *
     * @return string|null
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        if (empty($this->featured_image)) {
            return null;
        }

        // nếu giá trị đã là một URL đầy đủ
        if (filter_var($this->featured_image, FILTER_VALIDATE_URL)) {
            return $this->featured_image;
        }

        // nếu file tồn tại trong disk public
        if (Storage::disk('public')->exists($this->featured_image)) {
            return asset('storage/' . $this->featured_image);
        }

        return null;
    }

    /**
     * Kiểm tra còn phòng
     *
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->status === self::STATUS_AVAILABLE;
    }

    /**
     * Kiểm tra hết phòng
     *
     * @return bool
     */
    public function isUnavailable(): bool
    {
        return $this->status === self::STATUS_UNAVAILABLE;
    }

    /**
     * Relation tới user (author)
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Tự động sinh slug nếu rỗng khi tạo
     */
    protected static function booted()
    {
        static::creating(function ($post) {
            if (empty($post->slug) && !empty($post->title)) {
                $slug = Str::slug($post->title);
                $base = $slug;
                $i = 1;
                // đảm bảo slug duy nhất (nếu cần)
                while (self::where('slug', $slug)->exists()) {
                    $slug = $base . '-' . $i++;
                }
                $post->slug = $slug . '-' . uniqid();
            }
        });
    }
}
