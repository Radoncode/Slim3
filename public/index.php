<?php

require '../vendor/autoload.php';

$app = new \Slim\App();

dump($app);

$app->get('/', function (\Slim\Http\Request $request, \Slim\Http\Response $response){
    return $response->write('hello world');
});

//$app->run();

