<?php

use App\Controllers\PagesController;

require '../vendor/autoload.php';

session_start();

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

require '../app/container.php';

$container = $app->getContainer();

// Middleware 
$app->add(new \App\Middlewares\FlashMiddleware($container->view->getEnvironment()));
$app->add(new \App\Middlewares\OldMiddleware($container->view->getEnvironment()));
$app->add(new \App\Middlewares\TwigCsrfMiddleware($container->view->getEnvironment(), $container->csrf));
$app->add($container->csrf);


$app->get('/', PagesController::class . ':home')->setName('root');
$app->get('/nous-contacter', PagesController::class . ':getContact')->setName('contact');
$app->post('/nous-contacter', PagesController::class . ':postContact');

$app->run();
