<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';
include_once('./Conecciones/ConexionDb.php');
include_once('./Seguridad/SecurityNavigation.php');
include_once('./Api/TokenApi.php');

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);



$app->post('/usuario[/]', \TokenApi::class . ':AltaUsuario');

$app->post('/login[/]', \TokenApi::class . ':GenerarToken')
->add(\SecurityNavigation::class . ':ValidarAdmin');

$app->get('/usuario[/]', \TokenApi::class . ':TraerTodosUsuarios')
->add(\SecurityNavigation::class . ':ValidarAdminToken');

$app->post('/compra[/]', \TokenApi::class . ':Compra')
->add(\SecurityNavigation::class . ':ValidarToken');


$app->run();

?>