<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HotelBooking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hotel_bookings';

    protected $fillable = [
        'user_id',
        'hotel_id',
        'checkin_date',
        'checkout_date',
        'total_days',
        'total_amount',
        'is_paid',
        'proof',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function hotel(): BelongsTo {
        return $this->belongsTo(Hotel::class);
    }
}