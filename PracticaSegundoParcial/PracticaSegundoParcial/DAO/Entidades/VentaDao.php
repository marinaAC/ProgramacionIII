<?php

include_once('./DAO/Interfaces/IVentaDao.php');
include_once('./DAO/Entidades/UsuarioDao.php');
include_once('./Conecciones/ConexionDb.php');

class VentaDao implements IVentaDao{

    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }


    public function SaveVenta($venta)
    {
        $retorno = true;
        if($venta==null){
            $retorno = false;
            echo"Error en la venta que se desea guardar";
            return $retorno;
        }
        $consulta = $this->conexion->GetConsulta("INSERT INTO ventas (marca, precio, foto, idUsuario)
        VALUES(:marca, :precio, :foto, :idUsuario)");
        $consulta->bindValue(':marca', $venta->__get('marca'), PDO::PARAM_STR);
        $consulta->bindValue(':precio',$venta->__get('precio'), PDO::PARAM_INT);
        $consulta->bindValue(':foto', $venta->__get('foto'), PDO::PARAM_STR);
        $consulta->bindValue(':idUsuario', $venta->__get('usuario')->__get('idUsuario'), PDO::PARAM_STR);
        $consulta->execute(); 
        return $retorno;
    }

    public function RemoveVenta($venta)
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

    public function UpdateVenta($venta)
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

    public function GetByAll(){
        $listaVentas = [];
        $consulta = $this->conexion->GetConsulta("SELECT * FROM ventas");
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


    public function GetByIdVenta($id){
        $listaVentas = self::GetByFiltro("id= ".$id);
        return $listaVentas;
    }

    public function GetVentaByUsuario($usuario){
        $listaVentas = self::GetByFiltro("idUsuario=".$usuario->__get('idUsuario'));
        return $listaVentas;
    }
    public function GetVentaByPrecio($precio){
        $listaVentas = self::GetByFiltro("precio=".$precio);
        return $listaVentas;
    }
    public function GetVentaByMarca($marca){
        $listaVentas = self::GetByFiltro("marca=".$marca);
        return $listaVentas;
    }


}

?>