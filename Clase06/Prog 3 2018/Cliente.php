<?php
class Cliente
{
    public $nombre;
    public $nacionalidad;
    public $sexo;

    public function __construct($nombre,$nacionalidad,$sexo)
    {
        $this->nombre = $nombre;
        $this->nacionalidad = $nacionalidad;
        $this->sexo = $sexo;
    }

    public function MostrarDatos()
    {
        return $this->nombre . " - " . $this->nacionalidad . " - " . $this->sexo;
    }

    public static function TraerClienteNacionalidadSexoArray($nacionalidad, $sexo)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT nombre, nacionalidad, "
            . "sexo FROM clientes WHERE nacionalidad = :nacionalidad "
            . "AND sexo= :sexo");

        $consulta->execute(array(":nacionalidad" => $nacionalidad, ":sexo" => $sexo));
        $array = [];
        foreach($consulta->fetchAll() as  $row) {
            array_push($array,$row);
        }

        return $array;
    }

    public function InsertarElClienteParametros()
    {
        echo "Ejecutó";

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO clientes (nombre, nacionalidad, sexo)"
            . "VALUES(:nombre, :cantante, :sexo)");

        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':cantante', $this->nacionalidad, PDO::PARAM_STR);
        $consulta->bindValue(':sexo', $this->sexo, PDO::PARAM_STR);
        $consulta->execute();

    }

    public static function ModificarCliente($id, $nombre, $sexo, $cantante)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE cds SET titel = :nombre, interpret = :cantante, 
                                                        jahr = :sexo WHERE id = :id");

        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_INT);
        $consulta->bindValue(':sexo', $sexo, PDO::PARAM_INT);
        $consulta->bindValue(':cantante', $cantante, PDO::PARAM_STR);

        return $consulta->execute();

    }

    public static function EliminarCliente($id)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM cds WHERE id = :id");

        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();

    }

}