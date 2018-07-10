<?php
include_once("./Seguridad/SecurityToken.php");
include_once("./Seguridad/SecurityHistorial.php");
include_once("./DAO/Entidades/UsuarioDao.php");
include_once("./Modelo/Usuario/Usuario.php");

class TokenApi extends SecurityToken{

    public function GenerarToken($request, $response, $args){
        $parametros = $request->getParsedBody();
        $user = $parametros["nombre"];
        $password  = $parametros["clave"];
        $bd = new ConexionDb('examen','root','');
        $usDao = new UsuarioDao($bd);
        $usuario = $usDao->GetUsuarioByNombreyPass($user,$pass)[0];
        if($usuario->tipo_usuario != ""){
            $token = new SecurityToken(); 
            $tkGenerado = $token->CodeToken($usuario);
            $respuesta = array("Estado" => "OK", "Mensaje" => "OK", "Token" => $tkGenerado);
            
        }
        else{
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "Usuario o clave invalidos.");
        }
        $newResponse = $response->withJson($respuesta,200);
        return $newResponse;
    }

    public function CrearUsuario($request, $response, $args){
        $parametros = $request->getParsedBody();
        $user = $parametros["nombre"];
        $password  = $parametros["clave"];
        $nivel = $parametros["nivel"];
        $bd = new ConexionDb('examen','root','');
        $usDao = new UsuarioDao($bd);
        $usuario = $usDao->SaveUsuario(new Usuario('',$user,$nivel,$password));
        $respuesta = "Insertado Correctamente.";
        $newResponse = $response->withJson($respuesta,200);
        return $newResponse;
    }
}