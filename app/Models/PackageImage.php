<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PackageImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id', 
        'image_path', 
        'is_default'
    ];

    public function tourPackage(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
