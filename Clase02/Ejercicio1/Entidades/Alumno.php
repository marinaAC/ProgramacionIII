<?php
	class Alumno extends Persona{
		
		private $legajo;
		private $E_Inscripcion;

		public function __construct($nombre,$apellido,$dni,$direccion,$legajo,$e_inscrip){
			parent::__construct($nombre,$apellido,$dni,$direccion);
			$this->legajo = $legajo;
			$this->E_Inscripcion = $e_inscrip;
		}

		public function __toString(){
			$datosPadre = parent::__toString();
			$datosLegajo = "<p>".$this->legajo."</p>";
			return $datosPadre.$datosLegajo;
		}


	}



 ?>