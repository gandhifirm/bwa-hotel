<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HotelPhoto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hotel_photos';

    protected $fillable = [
        'photo',
        'hotel_id',
    ];

    public function hotel(): BelongsTo {
        return $this->belongsTo( Hotel::class);
    }
}