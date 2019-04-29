<?php


return [
    /**
     * Route middlewares.
     */
    'middlewares' => [
    ],

    /**
     * Url of info file.
     */
    'info_file' => '',

    /**
     * Before update commands.
     */
    'before_update_commands' => [
        'artisan view:clear',
        'php -v'
    ],

    /**
     * After update commands.
     */
    'after_update_commands' => [
        'artisan migrate --force',
        'php -v'
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
