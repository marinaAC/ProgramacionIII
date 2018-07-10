<?php

include_once('./DAO/Interfaces/IBicicletaDao.php');
include_once('./Conecciones/ConexionDb.php');

class BicicletaDao implements IBicicletaDao
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }


    public function SaveBicicleta($bicicleta)
    {
        $retorno = true;
        if($bicicleta==null){
            $retorno = false;
            echo"Error en la bicicleta que se desea guardar";
            return $retorno;
        }
        $consulta = $this->conexion->GetConsulta("INSERT INTO bicis (marca, precio, foto)
        VALUES(:marca, :precio, :foto)");
        $consulta->bindValue(':marca', $bicicleta->__get('marca'), PDO::PARAM_STR);
        $consulta->bindValue(':precio',$bicicleta->__get('precio'), PDO::PARAM_INT);
        $consulta->bindValue(':foto', $bicicleta->__get('foto'), PDO::PARAM_STR);
        $consulta->execute(); 
        return $retorno;
    }

    public function RemoveBicicleta($bicicleta)
    {
        $retorno = true;
        if($bicicleta==null){
            $retorno = false;
            echo"Error en la bicicleta que se desea borrar";
            return $retorno;
        }
        $consulta = $this->conexion->GetConsulta("DELETE FROM bicis WHERE id = :id");
        $consulta->bindValue(':id',$bicicleta->__get('idBicicleta'), PDO::PARAM_INT);
        $consulta->execute();
        return $retorno;
    }

    public function UpdateBicicleta($bicicleta)
    {
        $retorno = true;
        if($bicicleta==null){
            $retorno = false;
            echo"Error en la bicicleta que se desea updatear";
            return $retorno;
        }
        $consulta = $this->conexion->GetConsulta("UPDATE bicis SET marca = :marca, precio = :precio, foto = :foto
        WHERE id = :id");
        $consulta->bindValue(':marca', $bicicleta->__get('marca'), PDO::PARAM_STR);
        $consulta->bindValue(':precio',$bicicleta->__get('precio'), PDO::PARAM_INT);
        $consulta->bindValue(':foto', $bicicleta->__get('foto'), PDO::PARAM_STR);
        $consulta->bindValue(':id',$bicicleta->__get('idBicicleta'), PDO::PARAM_INT);
        $consulta->execute(); 
        return $retorno;
    }

    public function GetAllBicicletas(){
        $listaBicis = [];
        $consulta = $this->conexion->GetConsulta("SELECT * FROM bicis");
        $consulta->execute();
        $bicicletas = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach ($bicicletas as $key) {
            $auxBici = new Bicicleta($key['id'],$key['marca'],$key['precio'],$key['foto']);
            array_push($listaBicis,$auxBici);
        }
        return $listaBicis;
    }

    public function GetByFiltro($filtro){
        $listaBicis = [];
        $consulta = $this->conexion->GetConsulta("SELECT id,marca,precio,foto FROM bicis WHERE ".$filtro);
        $consulta->execute();
        $bicicletas = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach ($bicicletas as $key) {
            $auxBici = new Bicicleta($key['id'],$key['marca'],$key['precio'],$key['foto']);
            array_push($listaBicis,$auxBici);
        }
        return $listaBicis;
        
    }

    public function GetByIdBicicleta($id){
        $listaBicis = self::GetByFiltro("id= ".$id);
        return $listaBicis;
    }

    public function GetBicicletaByModelo($modelo){
        $listaBicis = self::GetByFiltro("marca=".$modelo);
        return $listaBicis;
    }
    public function GetBicicletaByPrecio($precio){
        $listaBicis = self::GetByFiltro("precio=".$precio);
        return $listaBicis;
    }

}



?>