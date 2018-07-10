<?php

class SecurityNavigation extends SecurityToken{

    public function ValidarToken($request,$response,$next)
    {
        $token = $request->getHeader("token");
        $validacionToken = self::DecodificarToken($token[0]);
        if($validacionToken["Estado"] == "OK"){
            $request = $request->withAttribute("verificarToken", $validacionToken);
            return $next($request,$response);
        }
        else{
            $newResponse = $response->withJson($validacionToken,200);
            return $newResponse;
        }
    }

    public function ValidarAdmin($request,$response,$next){
        $tk = $request->getAttribute("verificarToken")["VerificarToken"];

        if($tk->tipoUser == "admin"){
            return $next($request,$response);
        }
        else{
            $newResponse = $response->withJson("ERROR: No tienes permiso para realizar esta accion (Solo categoria admin).",200);
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