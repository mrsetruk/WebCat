<?php
/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Define Application ConfigurationOld Constants
|--------------------------------------------------------------------------
|
| PUBLIC_ROOT: 	the root URL for the application (see below).
| BASE_DIR: 	path to the directory that has all of your "app", "public", "vendor", ... directories.
| IMAGES:		path to upload images, don't use it for displaying images, use ConfigurationOld::get('root') . "/img/" instead.
| APP:			path to app directory.
|
*/

define('BASE_DIR', str_replace("\\", "/", dirname(__DIR__)));
define('PUBLIC_DIR',  BASE_DIR . "/public/");
define('SHOW_ERRORS', true);

/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Handler::errorHandler');
set_exception_handler('Handler::exceptionHandler');

/*
|--------------------------------------------------------------------------
| Start Session
|--------------------------------------------------------------------------
|
*/
//Session::init();

/*
|--------------------------------------------------------------------------
| ConfigurationOld App
|--------------------------------------------------------------------------
|
*/
//$appConfig = new ConfigurationOld(array(
//    'base_dir' => BASE_DIR.'/',
//    'public_dir' => PUBLIC_DIR,
//    'base_url' => $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/'
//
//));
//define('APP_CONFIG',$appConfig->toArray());

//var_dump($GLOBALS);

/**
 * Routing
 */
$router =  new Router();

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    View::renderTemplate("404.html");
});

$router->get('/', function() {
//     header('location: http://partcat.com');
//     exit();
});

/*
* admin Routing
*/
$router->before('GET|POST', '/admin/.*', function() {
    if (!isset($_SESSION['admin'])) {
        header('location: /auth/login');
        exit();
    }
});

$router->mount('/admin', function() use ($router) {

    $router->get('/', function() {

    });

    // will result in '/admin/id'
    $router->get('/(\d+)', function($id) {

    });

});

/*
* Authentification Routing
*/
$router->before('GET|POST', '/auth/.*', function() {

});

$router->mount('/auth', function() use ($router) {

    $router->get('/login', function() {

    });

    $router->match('GET|POST', '/logout', function() {

    });

});

/*
* catalog Routing
*/
$router->get('/(\w+)', 'catalog@access');


$router->run();