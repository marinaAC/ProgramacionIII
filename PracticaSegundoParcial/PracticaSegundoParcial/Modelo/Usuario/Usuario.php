<?php

//include_once('./Enum/TipoUsuario.php');

class Usuario{
    public $idUsuario;
    public $nombre;
    public $tipo;
    public $pass;

    public function __construct($idUsuario,$nombre, $tipo,$pass)
    {
        $this->idUsuario = $idUsuario;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->pass = $pass;
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
        return "$this->idUsuario-$this->nombre-$this->tipo".PHP_EOL;
    }

    // public function ValidarTipoUs()
    // {
    //     $tipoUs = false;
    //     if($this->tipo == TipoUsuario::ADMIN){
    //         $tipoUs = true;
    //     }
    //     return $tipoUs;
    // }
}

?>