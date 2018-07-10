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
        $consulta = $this->conexion->GetConsulta("INSERT INTO usuario (nombre, tipo, pass)
        VALUES(:nombre, :tipo, :pass)");
        $consulta->bindValue(':nombre', $usuario->__get('nombre'), PDO::PARAM_STR);
        $consulta->bindValue(':tipo',$usuario->__get('tipo'), PDO::PARAM_INT);
        $consulta->bindValue(':pass', $usuario->__get('pass'), PDO::PARAM_STR);
        $consulta->execute(); 
        return $retorno;
    }

    public function RemoveUsuario($usuario)
    {
        $retorno = true;
        if($usuario==null){
            $retorno = false;
            echo"Error en el usuario que se desea borrar";
            return $retorno;
        }
        $consulta = $this->conexion->GetConsulta("DELETE FROM usuario WHERE id = :id");
        $consulta->bindValue(':id',$usuario->__get('idUsuario'), PDO::PARAM_INT);
        $consulta->execute();
        return $retorno;
    }

    public function UpdateUsuario($usuario)
    {
        $retorno = true;
        if($usuario==null){
            $retorno = false;
            echo"Error en el usuario que se desea updatear";
            return $retorno;
        }
        $consulta = $this->conexion->GetConsulta("UPDATE usuario SET nombre = :nombre, tipo = :tipo, pass = :pass
        WHERE id = :id");
        $consulta->bindValue(':nombre', $usuario->__get('nombre'), PDO::PARAM_STR);
        $consulta->bindValue(':tipo',$usuario->__get('tipo'), PDO::PARAM_STR);
        $consulta->bindValue(':pass', $usuario->__get('pass'), PDO::PARAM_STR);
        $consulta->bindValue(':id',$usuario->__get('idUsuario'), PDO::PARAM_INT);
        $consulta->execute(); 
        return $retorno;
    }

    public function GetByFiltro($filtro){
        $listaUsuarios = [];
        $consulta = $this->conexion->GetConsulta("SELECT * FROM usuario WHERE ".$filtro);
        $consulta->execute();
        $usuarios = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach ($usuarios as $key) {
            $auxUsuarios = new Usuario($key['id'],$key['nombre'],$key['tipo'],$key['pass']);
            array_push($listaUsuarios,$auxUsuarios);
        }
        return $listaUsuarios;
        
    }

    public function GetByIdUsuario($id){
        $listaUsuarios = self::GetByFiltro("id= ".$id);
        return $listaUsuarios;
    }

    public function GetUsuarioByNombre($nombre){
        $listaUsuarios = self::GetByFiltro("nombre=".$nombre);
        return $listaUsuarios;
    }
    public function GetUsuarioByTipo($tipo){
        $listaUsuarios = self::GetByFiltro("tipo=".$tipo);
        return $listaUsuarios;
    }
    public function GetUsuarioByNombreyPass($nombre,$pass){
        $listaUsuarios = self::GetByFiltro("nombre =".$nombre."AND pass = ".$pass);
        return $listaUsuarios;
    }

}



?>