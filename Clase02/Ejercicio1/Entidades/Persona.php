<?php

    
    abstract class Persona implements IMostrable{
        private $nombre;
        private $apellido;
        private $dni;
        private $direccion;

        public function __construct($nombre,$apellido,$dni,$direccion){
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->dni = $dni;
            $this->direccion = $direccion;
        }

        // public function SetNombre($nombre){
        //     $this->nombre = $nombre;
        // }

        // public function GetNombre(){
        //     return $this->nombre;
        // }

        // public function SetApellido($apellido){
        //     $this->apellido = $apellido;
        // }

        // public function GetApellido(){
        //     return $this->apellido;
        // }

        // public function SetDni($dni){
        //     $this->dni = $dni;
        // }

        // public function GetDni(){
        //     return $this->dni;
        // }

        // public function SetDireccion($direccion){
        //     $this->direccion = $direccion;
        // }

        // public function GetDireccion(){
        //     return $this->direccion;
        // }

        /*
            *Metodo magico
        */
        public function __get($prop){
            return $this->$prop;
        }

        public function __set($prop,$valor){
            $this->$prop=$valor;
        }

        public function toHtml(){
            $datosCabecera = "<div ><h4>Persona</h4><table>";
            $datosNombre = "<tr><td>Nombre</td><td>".$this->nombre."</td></tr>";
            $datosApellido = "<tr><td>Apellido</td><td>".$this->apellido."</td></tr>";
            $datosDni = "<tr><td>DNI</td><td>".$this->dni."</td></tr>";
            $datosDireccion = $this->direccion->toHtml();
            $datosFinal = "</table></div>";
            return $datosCabecera.$datosNombre.$datosApellido.$datosDni.$datosDireccion.$datosFinal;
        }

        public function __toString(){
            return $this->toHtml();
        }

    }


?>