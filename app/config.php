<?php
/**
 * Created by PhpStorm.
 * User: DEV
 * Date: 2018-03-07
 * Time: 07:29
 */

return array_merge(
    [
        'fb_app_id'     => 123456,
        'fb_app_secret' => 'facebook_app_secret',
    ],
    require(__DIR__.'/app.config.php'),
    require(__DIR__.'/database.config.php')
);