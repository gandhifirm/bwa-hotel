<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HotelRoom extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hotel_rooms';

    protected $fillable = [
        'name',
        'price',
        'photo',
        'total_people',
        'hotel_id',
    ];

    public function hotel(): BelongsTo {
        return $this->belongsTo( Hotel::class);
    }
}