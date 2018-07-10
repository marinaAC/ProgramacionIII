<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';
include_once('./Modelo/Bicicleta/Bicicleta.php');
include_once('./DAO/Entidades/BicicletaDao.php');
include_once('./Conecciones/ConexionDb.php');
include_once('./Api/BicicletaApi.php');
include_once('./Seguridad/SecurityHistorial.php');
include_once('./Api/TokenApi.php');

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);


$app->post('/test[/]', function (Request $request, Response $response) {
    $body=$request->getParsedBody();
    $bicicleta = new Bicicleta($body['idBicicleta'],$body['marca'],$body['precio'],$body['foto']);
    //var_dump($bicicleta);
    $bd = new ConexionDb('examen','root','');
    $biciDao = new BicicletaDao($bd);
    //$respuesta=$biciDao->SaveBicicleta($bicicleta);
    //echo('La respuesta de salvar bicicleta es '.$respuesta);
    //$bicicleta->__set('marca','pepito');
    //$respUpdate=$biciDao->UpdateBicicleta($bicicleta);
    //echo('Se modifico la base de datos '.$respUpdate);
    echo('Impresion del select con filtro');
    //$lista = $biciDao->GetByFiltro("marca='italian'");
    
    $lista = $biciDao->GetByIdBicicleta('3');
    var_dump($lista);
    
    return $response;
});

$app->post('/crearUsuario[/]', \TokenApi::class . ':CrearUsuario')
->add(\SecurityHistorial::class . ':GenerarHistorial');

$app->post('/login[/]', \TokenApi::class . ':GenerarToken')
->add(\SecurityHistorial::class . ':GenerarHistorial');  

$app->get('/bicicletas[/]', \BicicletaApi::class . ':TraerTodos')
->add(\SecurityHistorial::class . ':GenerarHistorial');

$app->post('/bicicletas[/]', \BicicletaApi::class . ':Cargar')
->add(\SecurityHistorial::class . ':GenerarHistorial')
->add(\SecurityNavigation::class . ':ValidarAdmin')
->add(\SecurityNavigation::class . ':ValidarToken'); 

$app->get('/ventas[/]', \VentaApi::class . ':TraerComprasUsuario')
->add(\HistorialMiddleware::class . ':GenerarHistorial')
->add(\SecurityNavigation::class . ':ValidarUsuario')
->add(\SecurityNavigation::class . ':ValidarToken'); 

$app->post('/ventas[/]', \VentaApi::class . ':TraerTodos')
->add(\HistorialMiddleware::class . ':GenerarHistorial')
->add(\SecurityNavigation::class . ':ValidarAdmin')
->add(\SecurityNavigation::class . ':ValidarToken'); 


$app->run();

?>