<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Ship extends Model
{
    use HasFactory;

    protected $table = 'ships';

    protected $fillable = [
        'name',
        'description',
        'asset',
    ];

    public function getImageAttribute()
    {
        return $this->asset
            ? asset('storage/' . Str::replaceFirst('public/', '', $this->asset))
            : asset('images/redacted_ship.png');
    }

    public function manufacturer() : BelongsTo
    {
        return $this->belongsTo(ShipManufacturer::class);
    }
}
