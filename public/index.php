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

class Database {

    private $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function query($sql) {
        $req = $this->pdo->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

$app = new \Slim\App();
$container = $app->getContainer();

$container['pdo'] = function () {
    $pdo = new PDO('mysql:dbname=slim3;host=localhost','radoncode','root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
};

$container['db'] = function ($container) {
    return new Database($container->pdo);
};

$app->add(new DemoMiddleware());

$app->get('/salut/{nom}', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $posts = $this->db->query('SELECT * FROM posts');
    dump($posts);
    return $response->write('hello ' . $args['nom']);
});

$app->run();

