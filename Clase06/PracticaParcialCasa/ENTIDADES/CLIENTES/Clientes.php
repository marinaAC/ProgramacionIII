<?php
    class Clientes
    {
        private $nombre;
        private $correo;
        private $clave;

        public function __construct($nombre,$correo,$clave)
        {
            $this->nombre = $nombre;
            $this->correo = $correo;
            $this->clave = $clave;
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
            return "$this->nombre-$this->correo-$this->clave".PHP_EOL;
        }

    }
    

?>