<?php 

    
    class Localidad implements IMostrable{
        private $cp;
        private $nombre;

        public function __construct($cp,$nombre){
            $this->cp = $cp;
            $this->nombre = $nombre;
        }

        public function GetCp(){
        	return $this->cp;
        }

        public function GetNombre(){
        	return $this->nombre;
        }

        public function SetNombre($nombre){
        	$this->nombre = $nombre;
        }

        public function SetCp($cp){
        	$this->cp = $cp;
        }

        public function toHtml(){
            $datosCabecera = "<div ><table><th>Localidad</th>";
            $datosCp = "<tr><td>Codigo Postal</td><td>".$this->cp."</td></tr>";
            $datosNombre = "<tr><td>Nombre</td><td>".$this->nombre."</td></tr>";
            $datosFinal = "</table></div>";
            return $datosCabecera.$datosCp.$datosNombre.$datosFinal;
        }

    }


?>