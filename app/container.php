<?php

use Slim\Views\Twig;

$container = $app->getContainer();

$container['view'] = function ($container) {
    $dir = dirname(__DIR__);

    $view = new Twig($dir . '/app/views', [
        'cache' => false //$dir . '/tmp/cache'
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new \Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};