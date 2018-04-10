<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplicacion N3</title>
</head>
<body>

    <h2>Aplicacion N3</h2>
    <div>
    <h4>Ejercicio</h4>
    <?php
        include 'AplicacionN3.php';
        $a = 10;
        $b = 15;
        $resultado = Sumador($a,$b);
        echo "<p>Variable x : ".$a."</p>";
        echo "<br>";
        echo "<p>Variable y : ".$b."</p>";
        echo "<br>";
        echo "<p>Resultado : ".$resultado."</p>";
    ?>
    </div>
</body>
</html>