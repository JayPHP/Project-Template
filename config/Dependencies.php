<?php
/**
 * Dependencies
 *
 * This application uses Auryn. You can find docuentation here
 * https://github.com/rdlowrey/Auryn.
 *
 * @author James Byrne <jamesbwebdev@gmail.com>
 */

$injector = new \Auryn\Injector;

/**
 * Every time the type-hint of 1st argument is found inject an 
 * instance of second argument.
 */
$injector->alias('Jbyrne\Interfaces\Template', 'Jbyrne\System\TwigRenderer');
$injector->alias('Jbyrne\Interfaces\Database', 'Jbyrne\System\MySql');

/**
 * Share the same instance across application
 */
$injector->share('Symfony\Component\HttpFoundation\Request');
$injector->share('Symfony\Component\HttpFoundation\Response');

/**
 * The below dependencies have construct parameters that are scalar
 * or non-object. These arguments are defined below. Some parameter 
 * names can be prefixed with : as by default, Auryn assumes all 
 * paramter names are classes - prefixing with : removes this behaviour. 
 */
$injector->define('Symfony\Component\HttpFoundation\Request', [
        $_GET, 
        $_POST,
        array(), 
        $_COOKIE,
        $_FILES, 
        $_SERVER
    ]);

$injector->define('PDO', [
        "mysql:host={$config['host']};dbname={$config['database']}",
        $config['username'],
        $config['password']
    ]);

// delegates
$injector->delegate('Twig_Environment', function() use ($injector) {
    $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/src/views');
    $twig = new Twig_Environment($loader);
    return $twig;
});

return $injector;