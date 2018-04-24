<?php
    include_once("../Entidades/Personas.php");

    
    function MetodoPost($accion){
        switch($accion)
        {
            case "Cargar":
                $img = UploadFile();
                if(Persona::CargarPersona(new Persona($_POST["nombre"], $_POST["apellido"], $_POST["legajo"], $_POST["dni"], $img)) == true)
                    echo "Cargado";
                break;
            case "Modificar":
                $img = ObtenerImg();
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

    function MetodoGet($param){
        Persona::LeerPersonas();
    }

    function ObtenerImg()
    {
        $extension = explode("/",$_FILES["archivo"]["type"]);
        $nameFile = "imagen".$_POST["legajo"];
        return $nameFile.".".$extension[1];
    }

    function UploadFile()
    {
        $retorno = "";
        $nombreArchivo = ObtenerImg();
        if(move_uploaded_file($_FILES["archivo"]["tmp_name"],"../Upload/".$nombreArchivo)){
            $retorno = $nombreArchivo;
        }
        return $retorno; 
    }

    function ModificarImg()
    {
        $retorno = "";
        $backUpRealizado = RealizarBackUp();
        if($backUpRealizado==true)
        {
           $retorno = UploadFile();
        }
        return $retorno;
    }

    function RealizarBackUp()
    {
        $retorno = false;
        $nombreArchivo = ObtenerImg();
        if(copy("../Upload/".$nombreArchivo,"../BackUp/".$nombreArchivo)){
            $retorno = true;
        }
        return $retorno;
    }


?>

<br><br><a href="Index.php">VOLVER</a>