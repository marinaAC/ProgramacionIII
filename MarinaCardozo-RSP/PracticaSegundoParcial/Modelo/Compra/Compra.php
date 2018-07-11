<?php

class Compra{

    public $articulo;
    public $precio;
    public $fecha;
    public $usuario;

    public function __construct($articulo,$precio,$fecha,$usuario)
    {
        $this->articulo = $articulo;
        $this->precio = $precio;
        $this->fecha = $fecha;
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
        return $this->articulo."-".$this->precio."-".$this->fecha."-".$this->usuario;
    }
}

?>