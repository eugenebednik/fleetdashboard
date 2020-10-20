<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ship extends Model
{
    use HasFactory;

    protected $table = 'ships';

    protected $fillable = [
        'name',
        'description',
        'asset',
    ];

    public function manufacturer() : BelongsTo
    {
        return $this->belongsTo(ShipManufacturer::class);
    }
}
