<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Continent extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'status'];

    public function countries(): HasMany
    {
        return $this->hasMany(Country::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($continent) {
            $continent->slug = Str::slug($continent->name);
        });

        static::updating(function ($continent) {
            $continent->slug = Str::slug($continent->name);
        });
    }
}
