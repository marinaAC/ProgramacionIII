<?php
include_once("./DAO/Entidades/VentaDao.php");
include_once("./Modelo/Foto/Foto.php");

class VentaAPI extends VentaDao{
    public function TraerTodos($request, $response, $args){
        $bd = new ConexionDb('examen','root','');
        $vtaDao = new VentaDao($bd);
        $todos = $vtaDao->GetByAll();
        $newResponse = $response->withJson($todos, 200);
        return $newResponse;
    }

    public function TraerComprasUsuario($request, $response, $args){
        $payload = $request->getAttribute("payload")["Payload"];
        $bd = new ConexionDb('examen','root','');
        $vtaDao = new VentaDao($bd);
        $idUsuario = $payload->idUsuario;
        $todos = $vtaDao->GetVentaByUsuario($idUsuario);
        $newResponse = $response->withJson($todos, 200);
        return $newResponse;
    }

}


?>