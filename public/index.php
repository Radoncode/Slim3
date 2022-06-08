<?php

require '../vendor/autoload.php';

class DemoMiddleware {

    public function __invoke(\Slim\Http\Request $request, \Slim\Http\Response $response, $next){
        $response->write('<h1>Bienvenue</h1>');
        $response = $next($request, $response);
        $response->write('<h1>Au revoir</h1>');
        return $response;
    }
}

$app = new \Slim\App();
$app->add(new DemoMiddleware());

$app->get('/salut/{nom}', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    return $response->write('hello ' . $args['nom']);
});

$app->run();

