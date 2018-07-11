<?php
include_once("./Seguridad/SecurityToken.php");
include_once("./DAO/Entidades/UsuarioDao.php");
include_once("./DAO/Entidades/CompraDao.php");
include_once("./Modelo/Usuario/Usuario.php");
include_once("./Modelo/Compra/Compra.php");
use \Firebase\JWT\JWT;


class TokenApi extends SecurityToken{

    public function GenerarToken($request, $response, $args){
        $parametros = $request->getParsedBody();
        $user = $parametros["nombre"];
        $password  = $parametros["clave"];
        $bd = new ConexionDb('segundoparcial','root','');
        $usDao = new UsuarioDao($bd);
        $usuario = $usDao->GetUsuarioByNombreyPass($user,$password)[0];
        if($usuario->__get('tipo') != ""){
            $tk = new SecurityToken(); 
            $tkGenerado = $tk->CodeToken($usuario);
            $respuesta = array("Estado" => "OK", "Mensaje" => "OK", "Token" => $tkGenerado);
            
        }
        else{
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "Usuario o clave invalidos.", "Usuario" => $user , "Password" => $password);
        }
        $newResponse = $response->withJson($respuesta,200);
        return $newResponse;
    }

    public function AltaUsuario($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $user = $parametros["nombre"];
        $password  = $parametros["clave"];
        $sexo = $parametros["sexo"];
        $bd = new ConexionDb('segundoparcial','root','');
        $usDao = new UsuarioDao($bd);

        $retorno = $usDao->SaveUsuario(new Usuario('',$user,'usuario',$password,$sexo));
        if($retorno=='1'){
            $respuesta ="se inserto correctamente";
        }
        $newResponse = $response->withJson($respuesta,200);
        return $newResponse;
    }

    public function TraerTodosUsuarios($request, $response, $args)
    {
        $bd = new ConexionDb('segundoparcial','root','');
        $usDao = new UsuarioDao($bd);
        $todos = $usDao->GetAllUs();      
        $newResponse = $response->withJson($todos, 200);
        return $newResponse;
    }

    public function Compra($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $articulo = $parametros["articulo"];
        $precio  = $parametros["precio"];
        $fecha = $parametros["fecha"];
        //$rq=$request->getAttribute("ValidacionToken")["VerificarToken"]
        $bd = new ConexionDb('segundoparcial','root','');
        $cpDao = new CompraDao($bd);
        $compra = new Compra($articulo,$precio,$fecha,'1');
        $retorno=$cpDao->SaveCompra($compra);
        $newResponse = $response->withJson($respuesta,200);
         return $newResponse;
    }
}