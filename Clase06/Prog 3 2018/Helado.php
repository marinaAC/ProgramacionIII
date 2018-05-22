<?php
class Helado
{
    public $sabor;
    public $precio;
    public $tipo;

    public function MostrarDatos()
    {
        return $this->sabor . " - " . $this->precio . " - " . $this->tipo;
    }

    public static function TraerClienteNacionalidadSexoArray($sabor, $tipo)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT sabor, precio, "
            . "tipo FROM helados WHERE sabor = :sabor"
            . "AND tipo= :tipo");

        $consulta->execute(array(":sabor" => $sabor, ":tipo" => $tipo));
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

        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO clientes (sabor, precio, tipo)"
            . "VALUES(:sabor, :cantante, :tipo)");

        $consulta->bindValue(':sabor', $this->sabor, PDO::PARAM_STR);
        $consulta->bindValue(':cantante', $this->precio, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function ModificarCliente($id, $sabor, $tipo, $cantante)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE cds SET titel = :sabor, interpret = :cantante, 
                                                        jahr = :tipo WHERE id = :id");

        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':sabor', $sabor, PDO::PARAM_INT);
        $consulta->bindValue(':tipo', $tipo, PDO::PARAM_INT);
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