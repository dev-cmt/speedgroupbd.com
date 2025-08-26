<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Place extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'name', 'description', 'image', 'slug'];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function tourPackages(): HasMany
    {
        return $this->hasMany(TourPackage::class);
    }
}
