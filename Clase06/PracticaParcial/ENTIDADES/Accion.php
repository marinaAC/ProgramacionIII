<?php
   
    include_once("Cliente.php");
    include_once("Helados/Helados.php");
    include_once("Helados/Archivos.php");
   function MetodoPost($accion){
    switch($accion)
    {
        case "CargarCliente":
            if(Cliente::CargaClientes(new Cliente($_POST["nombre"], $_POST["correo"], $_POST["clave"]))==true){
                echo "Guardo Cliente";
            }else{
                echo "No lo hizo";
            }
            break;
        case "CargarHelado":
            $helado = new Helado($_POST["sabor"],$_POST["precio"],$_POST["foto"]);
            if(Helado::CargarHelados($helado)){
                Archivos::UploadFile();
            }
            
        break;
        case "Vender":
            if(Helado::VenderHelado($_POST["sabor"],$_POST["cantidad"])){
                echo "estaba el helado";
            }else{
                echo "no buey";
            }
        break;
    }
}


?>