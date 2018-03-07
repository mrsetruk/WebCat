<?php
/**
 * Created by PhpStorm.
 * User: DEV
 * Date: 2018-03-07
 * Time: 07:08
 */

return [
    'is_prod' => true,
    'base_dir' => str_replace("\\", "/", dirname(__DIR__)),
    'public_dir' => str_replace("\\", "/", dirname(__DIR__)).'/public/',
    'base_url' => $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/'
];