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


$mdw = function ($request,$response,$next){
    $response->getBody()->write("Estoy en la entrada\n");

    $response = $next($request,$response);
    return $response;
};

$app->get('/prueba', function (Request $request, Response $response) {
    $response->getBody()->write("Estamos dentro\n");
    return $response;
})->add($mdw);


$app->post('/hello', function (Request $request, Response $response) {
    $body=$request->getParsedBody();
    $token = array(
        "nombre" => $body['name'],
        "tipo" => $body['tipo'],
        "exp" => time() + 60,
        "nbf" => time()
    );
    $tk = new SecurityToken();
    $prueba = $tk->Encode($token);
    $response->getBody()->write($prueba);
    return $response;
});

$validarToken = function($request,$response,$next){
    try{
        $header = $request->getHeader("token");
        $tk = new SecurityToken();
        $decode = $tk->Decode($header[0]);
        
        $newResponse= $response->withAddedHeader("tipo",$decode->tipo);
        // var_dump($newResponse);
        $response = $next($request,$newResponse);
    }catch(BeforeValidException $e){
        $response->getBody()->write("Sucedio esta excepcion ".$e->getMessage());
        return $response;
    }catch(ExpiredException $e){    
        $response->getBody()->write("Sucedio esta excepcion ".$e);
        return $response;
    }catch(SignatureInvalidException $e){
        $response->getBody()->write("Sucedio esta excepcion ".$e);
        return $response;
    }catch(Exception $e){
        $response->getBody()->write("Sucedio esta excepcion ".$e);
        return $response;
    }
        return $response;
    
};

//cambiar a request
 $validarNivel = function($request,$response,$next){
      $header = $response->getHeader("tipo");
      var_dump($header);
      if($header[0] == "alumno"){
          $response->getBody()->write("entramos a alumno");
         $newResponse = $next($request,$response);
     }else{
         $response->getBody()->write("no entramos a alumno");
     }

     return $response;
 };

$app->post('/hello2', function (Request $request, Response $response) {
    $response->getBody()->write("LLego ok!");

    
    //return $decode;
    return $response;
})->add($validarNivel)->add($validarToken);



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