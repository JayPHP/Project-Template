<?php
/**
 * Bootstrap
 *
 * @author James Byrne <jamesbwebdev@gmail.com>
 */

namespace Jay;

// Composer used for autoload
require __DIR__ . '/../vendor/autoload.php';

$environment = 'development';

use Symfony\Component\Yaml\Yaml;
$config = Yaml::parse(file_get_contents(__DIR__.'/database.yml'))[$environment];

/**
 * Whoops for error handling. More information + documentation
 * - https://github.com/filp/whoops 
 */
$whoops = new \Whoops\Run;

if ($environment !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function($e){
        echo 'Error';
    });
}

$whoops->register();

// Using Auryn, see file for more info
include('Dependencies.php');

/**
 * Define request and response objects. Using Symfony's HttpFoundation. 
 * http://symfony.com/doc/current/components/http_foundation/.
 */
$request = $injector->make('Symfony\Component\HttpFoundation\Request');
$response = $injector->make('Symfony\Component\HttpFoundation\Response');

// Define Template used in route handling
$template = $injector->make('Jay\System\Template');

/**
 * Configure routing. Using FastRoute, https://github.com/nikic/FastRoute. 
 */
$allRoutes = function (\FastRoute\RouteCollector $r) {
    $routes = include('Routes.php');
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};

$dispatcher = \FastRoute\simpleDispatcher($allRoutes);

// Get dirname of PHP_SELF and remove /public directory name from string.
$base = str_replace('/public', '', dirname($_SERVER['PHP_SELF']));

// Do not incluce URL paramters in route request 
$uri = explode('?', str_replace($base, '', $_SERVER['REQUEST_URI']), 2)[0];

// Get route information from dispatcher
$route = $dispatcher->dispatch($request->getMethod(), $uri);

// Switch to route status
switch ($route[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        // 404 HTTP status code
        $response->setStatusCode(404);
        // Render 404 html error page
        $template->render('errors/404');
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        // 405 HTTP status code
        $response->setStatusCode(405);
        // Render 405 html error page
        $template->render('errors/405');
        break;
    case \FastRoute\Dispatcher::FOUND:
        $class = $route[1][0];
        $method = $route[1][1];
        $vars = $route[2];

        $class = $injector->make($class);
        $class->$method($vars);
        break;
}

$response->send();