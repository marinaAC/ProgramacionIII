<?php

class Venta{
    
    public $idVenta;
    public $marca;
    public $precio;
    public $foto;
    public $usuario;

    public function __construct($idVenta,$marca,$precio,$foto,$usuario)
    {
        $this->idVenta = $idVenta;
        $this->marca = $marca;
        $this->precio = $precio;
        $this->foto = $foto;
        $this->usuario = $usuario;
    }

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function __set($prop,$value)
    {
        $this->$prop = $value;
    }

    public function __toString()
    {
        return "$this->idVenta-$this->marca-$this->precio-$this->foto-$this->usuario".PHP_EOL;
    }
}

?>