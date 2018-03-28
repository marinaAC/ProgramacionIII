<?php
    
    class Direccion implements IMostrable{
        private $calle;
        private $altura;
        private $localidad;

        public function __construct($calle,$altura,$localidad){
            $this->calle =$calle;
            $this->altura = $altura;
            $this->localidad = $localidad;
        }

        public function SetCalle($calle){
            $this->calle = $calle;
        }

        public function SetAltura($altura){
            $this->altura = $altura;
        }

        public function SetLocalidad($localidad){
            $this->localidad = $localidad;
        }

        public function GetCalle(){
            return $this->calle;
        }
        public function GetAltura(){
            return $this->altura;
        }
        public function GetLocalidad(){
            return $this->localidad;
        }

        public function toHtml(){
            $datosCabecera = "<div ><table> <th>Direccion</th>";
            $datosCalle = "<tr><td>Calle</td><td>".$this->calle."</td></tr>";
            $datosAltura = "<tr><td>Altura</td><td>".$this->altura."</td></tr>";
            $datosLocalidad = $this->localidad->toHtml();
            $datosFinal = "</table></div>";
            return $datosCabecera.$datosCalle.$datosAltura.$datosLocalidad.$datosFinal;
        }

    }


?>