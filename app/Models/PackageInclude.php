<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageInclude extends Model
{
    use HasFactory;

    protected $fillable = ['package_id', 'item'];

    public function tourPackage(): BelongsTo
    {
        return $this->belongsTo(TourPackage::class, 'package_id');
    }
}
