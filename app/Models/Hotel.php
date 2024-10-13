<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hotels';

    protected $fillable = [
        'name',
        'thumbnail',
        'country_id',
        'city_id',
        'star_level',
        'address',
        'gmaps',
        'slug',
    ];

    public function hotel_rooms() : HasMany {
        return $this->hasMany( HotelRoom::class);
    }

    public function hotel_photos(): HasMany {
        return $this->hasMany( HotelPhoto::class);
    }

    public function hotel_bookings(): HasMany {
        return $this->hasMany( HotelBooking::class);
    }

    public function country(): BelongsTo {
        return $this->belongsTo(Country::class);
    }

    public function city(): BelongsTo {
        return $this->belongsTo(City::class);
    }

    public function getLowerRoomPrice() {
        $min_price = $this->hotel_rooms()->min('price');
        return $min_price ?? 0;
    }

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value).'-'.mt_rand(10000, 99999);
    }
}