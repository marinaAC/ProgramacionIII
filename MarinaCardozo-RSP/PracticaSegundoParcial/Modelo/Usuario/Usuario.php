<?php


class Usuario{
    public $idUsuario;
    public $nombre;
    public $tipo;
    public $pass;
    public $sexo;

    public function __construct($idUsuario,$nombre, $tipo,$pass,$sexo)
    {
        $this->idUsuario = $idUsuario;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->pass = $pass;
        $this->sexo =$sexo;
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
        return $this->idUsuario."-".$this->nombre."-".$this->tipo."-".$this->sexo;
    }

}

?>