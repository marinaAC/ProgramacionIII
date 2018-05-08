<?php
    class Alumno
    {
        private $nombre;
        private $apellido;
        private $correo;
        private $foto;

        public function __construct($nombre,$apellido,$correo,$foto)
        {
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->correo = $correo;
            $this->foto = $foto;
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
            return "$this->nombre-$this->apellido-$this->correo-$this->foto".PHP_EOL;
        }

    }
    

?>