<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;

class User extends Authenticatable
{
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'discord_id',
        'email',
        'nickname',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * @return string
     */
    public function getProfilePhotoUrlAttribute() : string
    {
        return $this->avatar;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        $adminTeam = Team::where('name', 'Administrators')->firstOrFail();
        return $this->belongsToTeam($adminTeam);
    }
}
