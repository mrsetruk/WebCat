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
set_error_handler('\Core\Handler::errorHandler');
set_exception_handler('\Core\Handler::exceptionHandler');

/*
|--------------------------------------------------------------------------
| Configuration
|--------------------------------------------------------------------------
|
*/
$config = new Core\Config(require(CONFIG_PATH));

$adapter = new Core\DatabaseAdapter();
$adapter->setHostname($config->get('db_hostname'));
$adapter->setPort($config->get('db_port'));
$adapter->setName($config->get('db_name'));
$adapter->setUsername($config->get('db_username'));
$adapter->setPassword($config->get('db_password'));

$db = $adapter->getInstance();

\Core\ORM\ORM::configure(array(
    'data_source' => $db
));

/*
|--------------------------------------------------------------------------
| Start Session
|--------------------------------------------------------------------------
|
*/
new \Core\SessionHandler($db, $config->get('session_name_table'));
$session = \Core\Session::getInstance();

/*
|--------------------------------------------------------------------------
| Start Scope
|--------------------------------------------------------------------------
|
*/

$scope = \Core\Scope::getInstance();
$scope->app = require $config->get('app_dir') . '/config/app.config.php';


/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
*/
/**
 * Routing
 */
$router =  new Core\Router();

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    Core\View::renderTemplate("404.html");
});

$router->get('/', function() {
//     header('location: http://partcat.com');
//     exit();
});

/*
* staff Routing
*/
$router->before('GET|POST', '/staff.*', function() use ($session) {
    $user_id = $session->get('staff_id');
//    if (!$user_id) {
//        header('location: /auth/login-staff');
//        exit();
//    }
});

$router->mount('/staff.*', function() use ($router, $session) {

    $router->get('/','\\App\\Controllers\\Staff@access');

    $router->get('/(\w+)?','\\App\\Controllers\\Staff@access');

});

/*
* admin Routing
*/
$router->before('GET|POST', '/admin.*', function() use ($session) {
    $user_id = $session->get('user_id');
//    if (!$user_id) {
//        header('location: /auth/login');
//        exit();
//    }
});

$router->mount('/admin', function() use ($router) {

    $router->get('/', '\\App\\Controllers\\Admin@access');

});

/*
* Authentification Routing
*/
$router->before('GET|POST', '/auth.*', function() {

});

$router->mount('/auth', function() use ($router, $config) {

    $router->get('/login', '\\App\\Controllers\\Auth@login');

    $router->get('/login-staff', '\\App\\Controllers\\Auth@staff_login');

    $router->post('/login-staff', function (){
        var_dump($_POST);
    });

    $router->match('GET|POST', '/logout', function() {

    });

});

/*
* catalog Routing
*/
//$router->setNamespace('\\App\\Controllers');
$router->get('/(\w+)','\\App\\Controllers\\Catalog@access');


$router->run();