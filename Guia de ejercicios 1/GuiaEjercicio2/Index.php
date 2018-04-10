<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplicacion N2</title>
</head>
<body>
    <?php
        include 'AplicacionN2.php';
        $a = -3;
        $b = 15;
        $objCalculadora = new Calculadora();
        echo ($objCalculadora->Sumador($a, $b));
    ?>

</body>
</html>