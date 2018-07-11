<?php

require './vendor/autoload.php';
use \Firebase\JWT\JWT;

class SecurityToken{

    private $key;

    public function __construct()
    {
        $this->key = "examen_key";
    }

    private function Encode($token)
    {
        $jwt = JWT::encode($token, $this->key);
        return $jwt;
    }

    private function Decode($jwt)
    {
        $decoded = JWT::decode($jwt, $this->key, array('HS256'));
        return $decoded;
    }


    public function CodeToken($usuario)
    {
        $fecha = new Datetime("now", new DateTimeZone('America/Buenos_Aires'));
        $token = array(
            "iss" => "https://example/marinaCardozo",
            "aud" => "marinaCardozo",
            "iat" => $fecha->getTimestamp(),
            "nbf" => $fecha->getTimestamp(),
            //"exp" => "", //Hasta cuando va a funcionar
            "user" => $usuario->__get('nombre'),
            "tipoUser" => $usuario->__get('tipo'),
            "idUsuario" => $usuario->__get('idUsuario')
        );
        $jwt = self::Encode($token);
        return $jwt;
    }

    public function DecodificarToken($token)
    {
        try{
            $verificarTk = self::Decode($token);
            $decoded = array("Estado" => "OK", "Mensaje" => "OK", "VerificarToken" => $verificarTk);
        }catch(\Firebase\JWT\BeforeValidException $e){
            $mensaje = $e->getMessage();
            $decoded = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        catch(\Firebase\JWT\ExpiredException $e){
            $mensaje = $e->getMessage();
            $decoded = array("Estado" => "ERROR", "Mensaje" => "$mensaje.");
        }
        catch(\Firebase\JWT\SignatureInvalidException $e){
            $mensaje = $e->getMessage();
            $decoded = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        catch(Exception $e){
            $mensaje = $e->getMessage();
            $decoded = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }        
        return $decoded;
    }

  

}


?>