<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    use HasFactory;
    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
    protected $fillable = ['name', 'type', 'capacity', 'price', 'description', 'status', 'image'];
}
