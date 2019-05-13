<?php


return [
    /**
     * Route middlewares.
     */
    'middlewares' => [
        'web', // Recommended to use admin only access middleware
    ],

    /**
     * Url of info file.
     */
    'info_file' => '',

    /**
     * Before update commands.
     */
    'before_update_commands' => [
        // Recommended to execute backup command
    ],

    /**
     * After update commands.
     */
    'after_update_commands' => [
        'artisan migrate --force',
        'artisan view:clear',
        'artisan cache:clear',
        'artisan config:clear',
        'artisan route:clear',
        // 'artisan config:cache',
        // 'artisan route:cache',
    ],

    /**
     * Is updating enabled.
     */
    'enabled' => env('LARAVEL_AUTO_UPDATE_ENABLED', true),

    /**
     * Path to save and extract update file.
     */
    'temp_path' => storage_path('update_temp'),
];
