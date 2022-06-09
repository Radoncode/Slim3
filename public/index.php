<?php

use App\Controllers\PagesController;

require '../vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

require '../app/container.php';

$app->get('/', PagesController::class . ':home');
$app->get('/nous-contacter', PagesController::class . ':getContact')->setName('contact');

$app->run();
