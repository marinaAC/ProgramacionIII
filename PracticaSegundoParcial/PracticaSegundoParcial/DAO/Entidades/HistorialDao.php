<?php

include_once('./DAO/Interfaces/IHistorialDao.php');
include_once('./Conecciones/ConexionDb.php');

class HistorialDao implements IHistorialDao{
 

    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }


    public function SaveHistorial($historial)
    {
        $retorno = true;
        if($historial==null){
            $retorno = false;
            echo"Error en el historial que se desea guardar";
            return $retorno;
        }
        $consulta = $this->conexion->GetConsulta("INSERT INTO historial (idUsuario, ruta, metodo, hora)
        VALUES(:idUsuario, :ruta, :metodo, :hora)");
        $consulta->bindValue(':idUsuario', $historial->__get('idUsuario'), PDO::PARAM_STR);
        $consulta->bindValue(':ruta',$historial->__get('ruta'), PDO::PARAM_STR);
        $consulta->bindValue(':metodo', $historial->__get('metodo'), PDO::PARAM_STR);
        $consulta->bindValue(':hora', $historial->__get('hora'), PDO::PARAM_STR);
        $consulta->execute(); 
        return $retorno;
    }

    public function RemoveHistorial($venta)
    {
        $retorno = true;
        if($venta==null){
            $retorno = false;
            echo"Error en la venta que se desea borrar";
            return $retorno;
        }
        $consulta = $this->conexion->GetConsulta("DELETE FROM ventas WHERE id = :id");
        $consulta->bindValue(':id',$venta->__get('idVenta'), PDO::PARAM_INT);
        $consulta->execute();
        return $retorno;
    }

    public function UpdateHistorial($venta)
    {
        $retorno = true;
        if($venta==null){
            $retorno = false;
            echo"Error en la venta que se desea updatear";
            return $retorno;
        }
        $consulta = $this->conexion->GetConsulta("UPDATE ventas SET marca = :marca, precio = :precio, foto = :foto, idUsuario = :idUsuario
        WHERE id = :id");
        $consulta->bindValue(':marca', $venta->__get('marca'), PDO::PARAM_STR);
        $consulta->bindValue(':precio',$venta->__get('precio'), PDO::PARAM_INT);
        $consulta->bindValue(':foto', $venta->__get('foto'), PDO::PARAM_STR);
        $consulta->bindValue(':id',$venta->__get('usuario')->__get('idUsuario'), PDO::PARAM_INT);
        $consulta->bindValue(':id',$venta->__get('idVenta'), PDO::PARAM_INT);
        $consulta->execute(); 
        return $retorno;
    }

    public function GetByFiltro($filtro){
        $listaVentas = [];
        $consulta = $this->conexion->GetConsulta("SELECT * FROM ventas WHERE ".$filtro);
        $consulta->execute();
        $ventas = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach ($ventas as $key) {
            $usuarioDao = new UsuarioDao($this->conexion);
            $auxUsuario = $usuarioDao->GetByIdUsuario($key['idUsuario']);
            $auxVentas = new Venta($key['id'],$key['marca'],$key['precio'],$key['foto'],$auxUsuario[0]);
            array_push($listaVentas,$auxVentas);
        }
        return $listaVentas;
        
    }


    public function GetVentaByUsuario($usuario){
        $listaVentas = self::GetByFiltro("idUsuario=".$usuario->__get('idUsuario'));
        return $listaVentas;
    }

}


?>