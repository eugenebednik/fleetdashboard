<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowedRole extends Model
{
    use HasFactory;

    protected $table = 'allowed_roles';

    protected $fillable = [
        'role_id',
        'role_name',
    ];
}
