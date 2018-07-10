<?php

class Historial{
    private $idUsuario;
    private $ruta;
    private $metodo;
    private $hora;

    public function __construct($idUsuario,$ruta,$metodo,$hora)
    {
        $this->idUsuario = $idUsuario;
        $this->ruta = $ruta;
        $this->metodo = $metodo;
        $this->hora = $hora;
    }

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function __set($prop,$value)
    {
        $this->$prop = $value;
    }
}


?>