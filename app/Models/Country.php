<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['continent_id', 'name', 'slug', 'flag', 'description', 'status'];

    public function continent(): BelongsTo
    {
        return $this->belongsTo(Continent::class);
    }

    public function places(): HasMany
    {
        return $this->hasMany(Place::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($country) {
            $country->slug = Str::slug($country->name);
        });

        static::updating(function ($country) {
            $country->slug = Str::slug($country->name);
        });
    }
}
