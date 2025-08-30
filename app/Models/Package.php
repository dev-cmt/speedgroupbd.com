<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_id', 
        'title', 
        'slug', 
        'price', 
        'sale_price',
        'duration', 
        'description',
        'is_featured',
        'is_bestseller',
        'max_persons',
        'review_count',
        'rating',
        'status'
    ];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function includes(): HasMany
    {
        return $this->hasMany(PackageInclude::class, 'package_id');
    }
    public function images(): HasMany
    {
        return $this->hasMany(PackageImage::class, 'package_id');
    }
    public function itineraries(): HasMany
    {
        return $this->hasMany(PackageItinerary::class, 'package_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tourPackage) {
            $tourPackage->slug = Str::slug($tourPackage->title);
        });

        static::updating(function ($tourPackage) {
            $tourPackage->slug = Str::slug($tourPackage->title);
        });
    }
}
