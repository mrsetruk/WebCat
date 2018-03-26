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
| Http Request And Response
|--------------------------------------------------------------------------
|
*/
$request = new \Core\Http\HttpRequest($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER, file_get_contents('php://input'));
$response = new \Core\Http\HttpResponse;


/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
*/
/**
 * Routing
 */
$router =  new Core\Router($request,$response);

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    Core\View::renderTemplate("404.html");
});

$router->get('/', function() use ($scope) {
//     header('location: http://partcat.com');
//     exit();
});

/*
* staff Api
*/
$router->before('GET|POST', '/api.*', function() use ($session, $router) {
    // Check Ip
});

$router->mount('/api', function() use ($router, $session, $scope) {

    $router->get('/(\w+)?','\\App\\Controllers\\Staff@dashboard');

});

/*
* staff Routing
*/
$router->before('GET|POST', '/staff.*', function() use ($session, $router) {
    // Check Ip
});

$router->mount('/staff', function() use ($router, $session, $scope) {

    $router->get('/','\\App\\Controllers\\Staff@dashboard');

    $router->match('GET|POST', '/login','\\App\\Controllers\\Staff@login');

    $router->match('GET|POST', '/logout', function() use ($session, $scope){
        $staff_id = $session->remove('staff_id');
        unset($scope->staff);
        header('location: /staff/login');
        exit();
    });



    $router->get('/(\w+)?','\\App\\Controllers\\Staff@dashboard');

});

/*
* admin Routing
*/
$router->before('GET|POST', '/admin.*', function() use ($session) {
    $user_id = $session->get('user_id');
//    if (!$user_id) {
//        header('location: /admin/login');
//        exit();
//    }
});

$router->mount('/admin', function() use ($router) {

    $router->get('/', '\\App\\Controllers\\Admin@dashboard');

    $router->get('/login', '\\App\\Controllers\\Admin@login');

    $router->match('GET|POST', '/logout', function() {

    });

});

/*
* catalog Routing
*/
$router->before('GET|POST', '/login.*', function() use ($session) {
    $user_id = $session->get('user_id');
//    if (!$user_id) {
//        header('location: /login');
//        exit();
//    }
});


$router->get('/login.*', '\\App\\Controllers\\Catalog@login');

$router->match('GET|POST', '/logout.*', function() {

});

$router->get('/(\w+)','\\App\\Controllers\\Catalog@index');

$router->run();