<?php

class Bicicleta{
    public $idBicicleta;
    public $marca;
    public $precio;
    public $foto;


    public function __construct($idBicicleta,$marca, $precio, $foto)
    {
        $this->idBicicleta = $idBicicleta;
        $this->marca = $marca;
        $this->precio = $precio;
        $this->foto = $foto;
    }

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function __set($prop, $value)
    {
        $this->$prop = $value;
    }

    public function __toString()
    {
        return $this->marca."-".$this->precio."-".$this->foto;
    }
}

?>