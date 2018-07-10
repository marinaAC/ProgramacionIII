<?php

include_once('./Conecciones/ConexionDb.php');
include_once('./DAO/Entidades/BicicletaDao.php');

class BicicletaApi extends BicicletaDao{

    public function TraerTodos($request, $response, $args){
        $bd = new ConexionDb('examen','root','');
        $biciDao = new BicicletaDao($bd);
        $todos = $biciDao->GetAllBicicletas();      
       // $newResponse = $response->getBody()->write($todos);
        $newResponse = $response->withJson($todos, 200);
        return $newResponse;
    }

    public function Cargar($request, $response, $args){
        $parametros = $request->getParsedBody();
        $files = $request->getUploadedFiles();
        $marca = $parametros["marca"];
        $precio = $parametros["precio"];
        $foto = $files["foto"];
 
        //Consigo la extensión de la foto.  
        $ext = Foto::ObtenerExtension($foto);
        if($ext != "ERROR"){
            //Genero el nombre de la foto.
            $nombreFoto = $marca."_Foto".$ext;  

            //Guardo la foto.
            $rutaFoto = "./Fotos/".$nombreFoto;
            Foto::GuardarFoto($foto,$rutaFoto);
    
            $respuesta = "Insertado Correctamente.";
            $bd = new ConexionDb('examen','root','');
            $biciDao = new BicicletaDao($bd);

            $biciDao->SaveBicicleta(new Bicicleta('',$marca,$precio,$nombreFoto));
            $newResponse = $response->withJson($respuesta,200);
            return $newResponse;
        }
        else{
            $respuesta = "Ocurrio un error.";
            $newResponse = $response->withJson($respuesta,200);
            return $newResponse;
        }        
    }
}



?>