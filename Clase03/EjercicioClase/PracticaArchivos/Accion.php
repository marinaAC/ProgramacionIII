<?php
    include_once("../Entidades/Personas.php");

    switch($_POST["btn"])
    {
        case "Cargar":
            if(Persona::CargarPersona(new Persona($_POST["nombre"], $_POST["apellido"], $_POST["dni"], $_POST["legajo"])) == true)
                echo "Cargado";
            break;
        case "Modificar":
            if(Persona::ModificarPersona(new Persona($_POST["nombre"], $_POST["apellido"], $_POST["dni"], $_POST["legajo"])) == true)
                echo "Modificado";
            break;
        case "Borrar":
            if(Persona::BorrarPersona(new Persona($_POST["nombre"], $_POST["apellido"], $_POST["dni"], $_POST["legajo"])) == true)
                echo "Borrado";
            break;

    }


?>

<br><br><a href="Index.php">VOLVER</a>