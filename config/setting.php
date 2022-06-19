<?php

use MichaelNabil230\LaravelSetting\Models\Setting;

/**
 *
 * @author   Michael Nabil <michaelnabil926@gmail.com>
 * @license  http://opensource.org/licenses/MIT
 * @package  laravel-setting
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Default Settings Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default settings store that gets used while
    | using this settings library.
    |
    | Supported: "json", "database", "redis"
    |
    */

    'default' => 'json',

    /*
    |--------------------------------------------------------------------------
    | Drivers Stores
    |--------------------------------------------------------------------------
    |
    | The settings are stored.
    |
    */

    'drivers' => [
        'database' => [
            'driver' => MichaelNabil230\LaravelSetting\Stores\DatabaseSettingStore::class,
            'options' => [
                'model' => Setting::class,
                'table' => 'settings', // name of table in dataBase
                'cache' => [
                    'enableCache' => false,
                    'cacheTtl' => 15, // TTL in seconds.
                ],
            ],
        ],

        'redis' => [
            'driver' => MichaelNabil230\LaravelSetting\Stores\RedisSettingStore::class,
            'options' => [
                'client' => 'predis',
                'default' => [
                    'host' => env('REDIS_HOST', '127.0.0.1'),
                    'port' => env('REDIS_PORT', 6379),
                    'database' => env('REDIS_DB', 0),
                ],
            ],
        ],

        'json' => [
            'driver' => MichaelNabil230\LaravelSetting\Stores\JsonSettingStore::class,
            'options' => [
                'path' => storage_path('settings.json'),
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Keys
    |--------------------------------------------------------------------------
    |
    | Your keys are used to insert settings data.
    |
    */

    'keys' => [
        // 
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Settings
    |--------------------------------------------------------------------------
    |
    | Default settings are used when a setting is not found in the store.
    |
    */

    'defaults' => [
        // 
    ],
];
