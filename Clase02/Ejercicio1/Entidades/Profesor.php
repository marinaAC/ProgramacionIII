<?php
	/**
	*  
	*/
	class Profesor extends Persona
	{
		private $materias;
		private $dias;
		
		function __construct($nombre,$apellido,$dni,$direccion,$materias,$dias)
		{
			parent::__construct($nombre,$apellido,$dni,$direccion);
			$this->materias = $materias;
			$this->dias = $dias;
		}

		function __toString(){
			$datos = parent::__toString();
			//$datosMaterias = "<tr><td>".$this->materias."</td><td>".$this->dias."</td></tr>";
			$datosCabeceraM = "<div><h3>Materias</h3>";
			$datosMaterias = "";
			foreach ($this->materias as $materias) {
				$datosMaterias = $datosMaterias."<p>".$materias."</p>";
			}
			$datosF = "</div>";
			$datosCabeceraD = "<div><h3>Dias</h3>";
			$datosDias = "";
			foreach ($this->dias as $key) {
				$datosDias = $datosDias."<p>".$key."</p>";
			}
			return $datos.$datosCabeceraM.$datosMaterias.$datosF.$datosCabeceraD.$datosDias.$datosF;
		}
	}





 ?>