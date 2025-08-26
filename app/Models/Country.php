<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['continent_id', 'name', 'slug'];

    public function continent(): BelongsTo
    {
        return $this->belongsTo(Continent::class);
    }

    public function places(): HasMany
    {
        return $this->hasMany(Place::class);
    }
}
