<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShipManufacturer extends Model
{
    use HasFactory;

    protected $table = 'ship_manufacturers';

    protected $fillable = [
        'tag',
        'name',
        'description',
    ];

    public function ships() : HasMany
    {
        return $this->hasMany(Ship::class);
    }
}
