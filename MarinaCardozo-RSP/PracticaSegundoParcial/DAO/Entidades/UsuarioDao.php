<?php

include_once('./DAO/Interfaces/IUsuarioDao.php');
include_once('./Conecciones/ConexionDb.php');

class UsuarioDao implements IUsuarioDao{
    
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }


    public function SaveUsuario($usuario)
    {
        $retorno = true;
        if($usuario==null){
            $retorno = false;
            echo"Error en el usuario que se desea guardar";
            return $retorno;
        }
        $consulta = $this->conexion->GetConsulta("INSERT INTO usuario (nombre, tipo, pass, sexo)
        VALUES(:nombre, :tipo, :pass, :sexo)");
        $consulta->bindValue(':nombre', $usuario->__get('nombre'), PDO::PARAM_STR);
        $consulta->bindValue(':tipo',$usuario->__get('tipo'), PDO::PARAM_STR);
        $consulta->bindValue(':pass', $usuario->__get('pass'), PDO::PARAM_STR);
        $consulta->bindValue(':sexo', $usuario->__get('sexo'), PDO::PARAM_STR);
        $consulta->execute(); 
        return $retorno;
    }



    public function GetByFiltro($filtro){
        $listaUsuarios = [];
        $consulta = $this->conexion->GetConsulta("SELECT * FROM usuario WHERE ".$filtro);
        $consulta->execute();
        $usuarios = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach ($usuarios as $key) {
            $auxUsuarios = new Usuario($key['id'],$key['nombre'],$key['tipo'],$key['pass'],$key['sexo']);
            array_push($listaUsuarios,$auxUsuarios);
        }
        return $listaUsuarios;
        
    }



    public function GetUsuarioByNombreyPass($nombre,$pass){
        $listaUsuarios = self::GetByFiltro("nombre = '".$nombre."' AND pass = '".$pass."'");
        return $listaUsuarios;
    }

    public function GetAllUs()
    {
        $listaUsuarios = [];
        $consulta = $this->conexion->GetConsulta("SELECT * FROM usuario");
        $consulta->execute();
        $usuarios = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach ($usuarios as $key) {
            $auxUsuarios = new Usuario($key['id'],$key['nombre'],$key['tipo'],$key['pass'],$key['sexo']);
            array_push($listaUsuarios,$auxUsuarios);
        }
        return $listaUsuarios;
    }

}



?>