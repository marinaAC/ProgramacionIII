<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;
include_once("token/SecurityToken.php");

require './vendor/autoload.php';

/*
$key = "ejemplo";
$token = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "iat" => 1356999524,
    "nbf" => 1357000000
);


$tk = new SecurityToken();
$repuesta = $tk->Encode($token);
print_r($repuesta);

/*
$jwt = JWT::encode($token, $key);
$decoded = JWT::decode($jwt, $key, array('HS256'));
print_r($jwt);
$decoded_array = (array) $decoded;
JWT::$leeway = 60; // $leeway in seconds
$decoded = JWT::decode($jwt, $key, array('HS256'));
*/
$app = new \Slim\app;

$app->post('/hello', function (Request $request, Response $response) {
    $body=$request->getParsedBody();

    

    $token = array(
        "nombre" => $body['name'],
        "tipo" => $body['tipo'],
        "exp" => time() + 60,
        "nbf" => time()+60
    );
    $tk = new SecurityToken();
    $prueba = $tk->Encode($token);
    $response->getBody()->write($prueba);
    return $response;
});

$app->post('/hello2', function (Request $request, Response $response) {
    try{
        $header = $request->getHeader("token");
        $tk = new SecurityToken();
        $decode = $tk->Decode($header[0]);
        var_dump($decode);
    }catch(BeforeValidException $e){
        $response->getBody()->write("Sucedio esta excepcion ".$e->getMessage());
    }catch(ExpiredException $e){    
        $response->getBody()->write("Sucedio esta excepcion ".$e);
    }catch(SignatureInvalidException $e){
        $response->getBody()->write("Sucedio esta excepcion ".$e);
    }catch(Exception $e){
        $response->getBody()->write("Sucedio esta excepcion ".$e);
    }
    //return $decode;
});



$app->run();
/*
$app = new \Slim\App;
//Lo que escriba en el get es lo que va a recibir en el parametro. Es una funcion anonima
$app->get('/hello', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello");
    $jwt = JWT::encode($token, $key);
  //  $decoded = JWT::decode($jwt, $key, array('HS256'));
    print_r($decoded);
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
*/
?>