<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clase III - Archivos</title>
</head>
<body>
<fieldset>
    <legend>Formulario</legend>
    <section>
        <form action="Accion.php" method="post" enctype="multipart/form-data">
            <label>Nombre</label>
            <input type="text" value="" placeholder="Nombre" name="nombre"><br>
            <label>Apellido</label>
            <input type="text" value="" placeholder="Apellido" name="apellido"><br>
            <label>Legajo</label>
            <input type="text" value="" placeholder="Legajo" name="legajo"><br>
            <label>DNI</label>
            <input type="number" value="" placeholder="DNI" name="dni"><br>
            <label>Agregar Imagen</label>
            <input type="file" name="archivo" id="archivo"><br>
            <!-- Botones de acciones-->
            <input type="submit" name="btn" value="Cargar">
            <input type="submit" name="btn" value="Modificar">
            <input type="submit" name="btn" value="Borrar">
        </form>
    </section>
</fieldset>
    
</body>
</html>