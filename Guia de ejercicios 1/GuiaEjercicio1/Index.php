<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplicacion N1</title>
</head>
<body>
    <?php
    	include 'AplicacioN1.php';

    	/* Realizado con un objeto del tipo persona
		 * y un metodo que lo concatena
    	*/
    	$persona1 = new Persona("Maria","Cardozo");
    	echo "El nombre es: <br>";
    	echo($persona1->Conact());

    	/**
		 * Realizado solo con variables
		 */
		echo "<br>";
		$nombre = "Juana";
		$apellido = "Perez";

		echo "Ella es ".$apellido.",".$nombre;



     ?>
</body>
</html>