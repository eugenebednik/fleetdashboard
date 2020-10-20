<?php

namespace App\Providers;

use App\Services\DiscordService;
use Illuminate\Support\ServiceProvider;

class DiscordServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $config = config('discord');

        $this->app->singleton(DiscordService::class, function ($app) use ($config) {
            return new DiscordService(
                $config['api_base_url'],
                $config['client_id'],
                $config['bot_token'],
                $config['guild_id']
            );
        });
    }
}
