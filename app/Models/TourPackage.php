<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TourPackage extends Model
{
    use HasFactory;

    protected $fillable = ['place_id', 'title', 'price', 'duration', 'description', 'image'];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function includes(): HasMany
    {
        return $this->hasMany(PackageInclude::class, 'package_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
