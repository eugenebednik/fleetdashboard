<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ShipManufacturer extends Model
{
    use HasFactory;

    protected $table = 'ship_manufacturers';

    protected $fillable = [
        'tag',
        'name',
        'description',
        'xplorer_tag',
        'asset',
    ];

    public function getImageAttribute()
    {
        return $this->asset
            ? asset('storage/' . Str::replaceFirst('public/', '', $this->asset))
            : asset('images/default_avatar.png');
    }

    public function ships() : HasMany
    {
        return $this->hasMany(Ship::class);
    }
}
