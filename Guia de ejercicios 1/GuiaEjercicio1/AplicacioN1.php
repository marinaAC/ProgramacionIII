<?php
    /**
     * Realizar un programa que guarde su nombre en $nombre y su apellido en $apellido. 
     * Luego mostrar el contenido de las variables con el siguiente formato: Pérez, Juan. 
     * Utilizar el operador de concatenación.
     */

    class Persona{
        
        private $nombre;
        private $apellido;

        public function __construct($nombre,$apellido)
        {
           $this->nombre = $nombre;
           $this->apellido = $apellido;
        }

        public function __get($prop)
        {
           return $this->$prop;
        }

        public function __set($prop,$value)
        {
            $this->$prop = $value;
        }

        public function Conact()
        {
            $contactenado = "".$this->apellido.",".$this->nombre."";
            return $contactenado;
        }

    }




?>