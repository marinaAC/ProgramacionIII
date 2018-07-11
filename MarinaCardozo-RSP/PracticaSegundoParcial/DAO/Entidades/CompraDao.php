<?php

include_once('./DAO/Interfaces/ICompraDao.php');
include_once('./DAO/Entidades/UsuarioDao.php');
include_once('./Conecciones/ConexionDb.php');

class CompraDao implements ICompraDao{

    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }


    public function SaveCompra($compra)
    {
        $retorno = true;
        if($Compra==null){
            $retorno = false;
            echo"Error en la Compra que se desea guardar";
            return $retorno;
        }
        $consulta = $this->conexion->GetConsulta("INSERT INTO compra (articulo, precio, fecha, idUsuario)
        VALUES(:articulo, :precio, :fecha, :idUsuario)");
        $consulta->bindValue(':articulo', $compra->__get('articulo'), PDO::PARAM_STR);
        $consulta->bindValue(':precio',$compra->__get('precio'), PDO::PARAM_STR);
        $consulta->bindValue(':fecha', $compra->__get('fecha'), PDO::PARAM_STR);
        $consulta->bindValue(':idUsuario', $compra->__get('usuario')->__get('idUsuario'), PDO::PARAM_INT);
        $consulta->execute(); 
        return $retorno;
    }

    public function RemoveCompra($Compra)
    {
        $retorno = true;
        if($Compra==null){
            $retorno = false;
            echo"Error en la Compra que se desea borrar";
            return $retorno;
        }
        $consulta = $this->conexion->GetConsulta("DELETE FROM compra WHERE id = :id");
        $consulta->bindValue(':id',$Compra->__get('idCompra'), PDO::PARAM_INT);
        $consulta->execute();
        return $retorno;
    }

    public function UpdateCompra($Compra)
    {
        $retorno = true;
        if($Compra==null){
            $retorno = false;
            echo"Error en la Compra que se desea updatear";
            return $retorno;
        }
        $consulta = $this->conexion->GetConsulta("UPDATE compra SET articulo = :articulo, precio = :precio, fecha = :fecha, idUsuario = :idUsuario
        WHERE id = :id");
        $consulta->bindValue(':articulo', $Compra->__get('articulo'), PDO::PARAM_STR);
        $consulta->bindValue(':precio',$Compra->__get('precio'), PDO::PARAM_INT);
        $consulta->bindValue(':fecha', $Compra->__get('fecha'), PDO::PARAM_STR);
        $consulta->bindValue(':id',$Compra->__get('usuario')->__get('idUsuario'), PDO::PARAM_INT);
        $consulta->execute(); 
        return $retorno;
    }

    public function GetByFiltro($filtro){
        $listaCompras = [];
        $consulta = $this->conexion->GetConsulta("SELECT * FROM compra WHERE ".$filtro);
        $consulta->execute();
        $Compras = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach ($Compras as $key) {
            $usuarioDao = new UsuarioDao($this->conexion);
            $auxUsuario = $usuarioDao->GetByIdUsuario($key['idUsuario']);
            $auxCompras = new Compra($key['articulo'],$key['precio'],$key['fecha'],$auxUsuario[0]);
            array_push($listaCompras,$auxCompras);
        }
        return $listaCompras;
        
    }

    public function GetByAll(){
        $listaCompras = [];
        $consulta = $this->conexion->GetConsulta("SELECT * FROM compra");
        $consulta->execute();
        $Compras = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach ($Compras as $key) {
            $usuarioDao = new UsuarioDao($this->conexion);
            $auxUsuario = $usuarioDao->GetByIdUsuario($key['idUsuario']);
            $auxCompras = new Compra($key['articulo'],$key['precio'],$key['fecha'],$auxUsuario[0]);
            array_push($listaCompras,$auxCompras);
        }
        return $listaCompras;
        
    }

    public function GetAllUs()
    {
        $listaCompras = [];
        $consulta = $this->conexion->GetConsulta("SELECT * FROM Compras");
        $consulta->execute();
        $Compras = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach ($Compras as $key) {
            $usuarioDao = new UsuarioDao($this->conexion);
            $auxUsuario = $usuarioDao->GetByIdUsuario($key['idUsuario']);
            $auxCompras = new Compra($key['id'],$key['articulo'],$key['precio'],$key['fecha'],$auxUsuario[0]);
            array_push($listaCompras,$auxCompras);
        }
        return $listaCompras;
    }

}

?>