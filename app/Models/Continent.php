<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Continent extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function countries(): HasMany
    {
        return $this->hasMany(Country::class);
    }
}
