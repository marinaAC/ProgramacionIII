<?php

	//Required cuando queremos que no tire error al compilar
	include 'Interfaces/IMostrable.php';
	require 'Entidades/Persona.php';
	//include 'Entidades/Persona.php';
	include 'Entidades/Localidad.php';
	include 'Entidades/Direccion.php';
	include 'Entidades/Alumno.php';
	include 'Entidades/Profesor.php';

	echo "Objeto Persona";
	/*$obj1 = new Persona('Pedro','Ramirez','123','calle falsa');

	var_dump($obj1);
	echo "<br>";
	echo "Nombre: ";
	echo($obj1->GetNombre());

	echo "Localidad";
	$obj2 = new Localidad('1879','Quilmes');
	
	echo($obj2->GetNombre());
	
	echo($obj2->toHtml());

	*/
	$localidad = new Localidad(1879,"Quilmes");
	$objDire = new Direccion("falsa",123,$localidad);
	$objAlumno = new Alumno('Pedro','Alonzo',123,$objDire,123569,'sasa');

	$arrayClases[0] = $objAlumno;

	$materias[0] = "Matematicas";
	$dias[0] = "Lunes";
	$materias[1] = "Lengua";
	$dias[1] = "Jueves";
	$objProfesor = new Profesor("Claudio","Perez", 2455, $objDire,$materias,$dias);


	echo "<br> ";
	echo $objProfesor;




 ?>