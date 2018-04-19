<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 17:20
 */


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'Client/index');
    $r->addRoute('GET', '/decks', 'Client/decks');
    $r->addRoute('GET', '/play', 'Client/play');
    $r->addRoute('GET', '/fin', 'Client/finDeParti');
    $r->addRoute('GET', '/regles', 'Client/regles');

    $r->addRoute('GET', '/admin', 'Admin/Verif');
    $r->addRoute('GET', '/ajouter', 'Admin/ajouter');
    $r->addRoute('GET', '/redirection', 'Admin/redirection');
    //$r->addRoute('GET', '/modifier', 'Admin/modifier');
    //$r->addRoute('GET', '/supprimer', 'Admin/supprimer');
    $r->addRoute('GET', '/test', 'test/test1');
    $r->addRoute('POST', '/addBdd', 'test/AddBdd');
    $r->addRoute('GET', '/changerAccueil', 'Admin/changerAccueil');
    $r->addRoute('POST', '/changerAccueil', 'Admin/changerAccueil');

});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo"404 Not Found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo "405 Method Not Allowed";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        list($class, $method) = explode("/", $handler, 2);
        $class = APP_CONTROLLER_NAMESPACE . $class . APP_CONTROLLER_SUFFIX;
        echo call_user_func_array(array(new $class, $method), $vars);
        break;
}
