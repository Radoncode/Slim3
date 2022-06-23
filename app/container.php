<?php

use Slim\Views\Twig;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;

$container = $app->getContainer();

$container['debug'] = function () {
    return true;
};

$container['view'] = function ($container) {
    $dir = dirname(__DIR__);

    $view = new Twig($dir . '/app/views', [
        'cache' => $container->debug ? false : $dir . '/tmp/cache',
        'debug' => $container->debug
    ]);

    if ($container->debug) {
        $view->addExtension(new Twig_Extension_Debug());
    }

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new \Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

$container['mailer'] = function ($container) {
    $transport = Transport::fromDsn('smtp://localhost:1025');
    $mailer = new Mailer($transport);
    
    return $mailer;
};