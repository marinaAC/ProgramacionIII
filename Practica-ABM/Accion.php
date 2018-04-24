<?php
    include_once("../Entidades/Archivo.php");

    
    function MetodoPost($accion){
        switch($accion)
        {
            case "Cargar":
                $img = Archivo::UploadFile();
                if(Persona::CargarPersona(new Persona($_POST["nombre"], $_POST["apellido"], $_POST["legajo"], $_POST["dni"], $img)) == true)
                    echo "Cargado";
                break;
            case "Modificar":
                $img = Archivo::ObtenerImg();
                if(Persona::ModificarPersona(new Persona($_POST["nombre"], $_POST["apellido"], $_POST["legajo"], $_POST["dni"], $img)) == true)
                {
                    $img = ModificarImg();
                    echo "Modificado";
                }
                    
                break;
            case "Borrar":
                if(Persona::BorrarPersona(new Persona($_POST["nombre"], $_POST["apellido"], $_POST["legajo"], $_POST["dni"], $img)) == true)
                    echo "Borrado";
                break;

        }
    }

   

?>

<br><br><a href="Index.php">VOLVER</a>