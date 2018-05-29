<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';

$app = new \Slim\App;
//Lo que escriba en el get es lo que va a recibir en el parametro. Es una funcion anonima
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});
$app->post('/hello', function (Request $request, Response $response) {
    $body=$request->getParsedBody();
    $newResponse = $response->withJson($body,200);
    var_dump($newResponse);
    $response->getBody()->write("Hello, POST");
    return $response;
});
$app->run();
?>