<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Place extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'name', 'description', 'image', 'slug', 'status'];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function tourPackages(): HasMany
    {
        return $this->hasMany(TourPackage::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($place) {
            $place->slug = Str::slug($place->name);
        });

        static::updating(function ($place) {
            $place->slug = Str::slug($place->name);
        });
    }
}
