<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Exception\HttpNotFoundException;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});
$app->get('/wotd', function (Request $request, Response $response, $args) {
    $words = json_decode(file_get_contents("./words.json"));
    $response->getBody()->write((string)json_encode([
        "word" => $words[date('z') + 1],
        "timeLeft" => date("c", strtotime("tomorrow"))
    ]));
    return $response->withHeader('Content-Type', 'application/json');
});
$app->get('/allwords', function (Request $request, Response $response, $args) {
    $words = file_get_contents("./words.json");
    $response->getBody()->write($words);
    return $response;
});

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request);
});

$app->setBasePath("/api");
$app->run();