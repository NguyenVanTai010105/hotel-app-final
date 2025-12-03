<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EmailVerification extends Model
{
    use Notifiable;
    protected $fillable = ['email', 'otp', 'expires_at'];
    protected $dates = ['expires_at'];
    //
}
