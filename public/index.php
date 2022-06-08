<?php

require '../vendor/autoload.php';

$app = new \Slim\App();


$app->get('/salut/{nom}', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    return $response->write('hello ' . $args['nom']);
});

$app->run();

