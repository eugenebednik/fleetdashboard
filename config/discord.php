<?php

return [
    'api_base_url' => env('DISCORD_API_BASE_URL', 'https://discordapp.com/api/'),
    'client_id' => env('DISCORD_CLIENT_ID', null),
    'client_secret' => env('DISCORD_CLIENT_SECRET', null),
    'bot_token' => env('DISCORD_BOT_TOKEN', null),
    'guild_id' => env('DISCORD_GUILD_ID', null),
];
