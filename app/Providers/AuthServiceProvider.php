<?php

namespace App\Providers;

use App\Models\AllowedRole;
use App\Models\Ship;
use App\Models\ShipManufacturer;
use App\Models\Team;
use App\Policies\AllowedRolePolicy;
use App\Policies\ShipManufacturerPolicy;
use App\Policies\ShipPolicy;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
        ShipManufacturer::class => ShipManufacturerPolicy::class,
        Ship::class => ShipPolicy::class,
        AllowedRole::class => AllowedRolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
