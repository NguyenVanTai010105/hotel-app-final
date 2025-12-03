<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'post_id', 'user_id', 'guest_name', 'guest_email', 'guest_phone',
        'check_in', 'check_out', 'guests', 'total_price', 'status', 'notes'
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'total_price' => 'decimal:2',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * Determine if this booking overlaps given dates (inclusive check-in, exclusive check-out).
     */
    public function overlaps($otherCheckIn, $otherCheckOut): bool
    {
        $start = \Carbon\Carbon::parse($this->check_in);
        $end = \Carbon\Carbon::parse($this->check_out);
        $oStart = \Carbon\Carbon::parse($otherCheckIn);
        $oEnd = \Carbon\Carbon::parse($otherCheckOut);

        // Overlap if start < oEnd and oStart < end  (treat check_out as exclusive optionally)
        return $start->lt($oEnd) && $oStart->lt($end);
    }
}
