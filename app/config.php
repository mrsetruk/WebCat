<?php
/**
 * Created by PhpStorm.
 * User: DEV
 * Date: 2018-03-07
 * Time: 07:29
 */

return array_merge(
    [
        /**
         *  Facebook Setting
         */
        'fb_app_id'     => 123456,
        'fb_app_secret' => 'facebook_app_secret',
        /**
         * Configuration for: Hashing strength
         *
         * It defines the strength of the password hashing/salting. '10' is the default value by PHP.
         * @see http://php.net/manual/en/function.password-hash.php
         *
         */
        'hash_cost_factor' => '10',
    ],
    require(__DIR__ . '/config/app.config.php'),
    require(__DIR__ . '/config/database.config.php'),
    require(__DIR__ . '/config/encryption.config.php'),
    require(__DIR__ . '/config/smtp.config.php'),
    require(__DIR__ . '/config/cookie.config.php')
);