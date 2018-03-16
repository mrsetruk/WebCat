<?php
/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer Autoload
 */
require dirname(__DIR__) . '/vendor/autoload.php';

define('CONFIG_PATH', str_replace("\\", "/", dirname(__DIR__).'/app/config.php'));

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
| Configuration
|--------------------------------------------------------------------------
|
*/
$config = new Config(require(CONFIG_PATH));
//var_dump($config);

\PicORM\PicORM::configure(array(
    'datasource' => new PDO('mysql:dbname=jnpsoft_partfinder;host=localhost:3308', 'root', '')
));

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

$router->mount('/auth', function() use ($router, $config) {

    $router->get('/login', function() use($config) {
        var_dump($config);
    });

    $router->match('GET|POST', '/logout', function() {

    });

});

/*
* catalog Routing
*/
$router->get('/(\w+)', 'catalog@access');


$router->run();