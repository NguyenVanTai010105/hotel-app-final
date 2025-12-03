<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostImage extends Model
{
    use HasFactory;

    protected $fillable = ['post_id','path','alt','order'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getUrlAttribute()
    {
        if (!$this->path) return null;
        if (filter_var($this->path, FILTER_VALIDATE_URL)) return $this->path;
        return asset('storage/' . $this->path);
    }
}
