<?php

include_once('./Seguridad/SecurityToken.php');

class SecurityNavigation extends SecurityToken{

    public function ValidarToken($request,$response,$next)
    {
        $token = $request->getHeader("token");
        $validacionToken = self::DecodificarToken($token[0]);
        if($validacionToken["Estado"] == "OK"){
            $request = $request->withAttribute("ValidacionToken", $validacionToken);
            return $next($request,$response);
        }
        else{
            $newResponse = $response->withJson($validacionToken,200);
            return $newResponse;
        }
    }

    public function ValidarAdmin($request,$response,$next){
        $tk = $request->getParsedBody();
        if($tk['clave'] == "admin"){
            return $next($request,$response);
        }
        else{
            $newResponse = $response->withJson("ERROR: No tienes permiso para realizar esta accion (Solo categoria admin).",200);
            return $newResponse;
         }
    }

     public function ValidarAdminToken($request,$response,$next){
        $header = $request->getHeader("token");
        $tk = self::DecodificarToken($header[0]);
        if($tk["VerificarToken"]->tipoUser == "admin"){
            return $next($request,$response);
        }
        else{
            $newResponse = $response->withJson("Hola ",200);
            return $newResponse;
         }
    }


    public function ValidarUsuario($request,$response,$next){
        $tk = $request->getAttribute("verificarToken")["VerificarToken"];
        if($tk->tipoUser == "usuario"){
            return $next($request,$response);
        }
        else{
            $newResponse = $response->withJson("ERROR: No tienes permiso para realizar esta accion (Solo categoria usuario).",200);
            return $newResponse;
        }
    }
}


?>