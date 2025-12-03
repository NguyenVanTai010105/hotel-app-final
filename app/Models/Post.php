<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    public const STATUS_AVAILABLE = 'available';
    public const STATUS_UNAVAILABLE = 'unavailable';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'featured_image',
        'status',
        'capacity',
        'price',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // relation to gallery images
    public function images()
    {
        return $this->hasMany(PostImage::class)->orderBy('order');
    }

    // accessor for featured image full url
    public function getFeaturedImageUrlAttribute()
    {
        if (empty($this->featured_image)) {
            return null;
        }
        if (filter_var($this->featured_image, FILTER_VALIDATE_URL)) {
            return $this->featured_image;
        }
        return asset('storage/' . $this->featured_image);
    }
}
