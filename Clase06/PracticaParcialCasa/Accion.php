<?php
    include_once("ENTIDADES/CLIENTES/ClientesFile.php");
    include_once("ENTIDADES/CLIENTES/Clientes.php");
    include_once("ENTIDADES/HELADOS/Helados.php");
    include_once("ENTIDADES/HELADOS/HeladosFile.php");

    define("fileClientes","ENTIDADES/CLIENTES/clientesActuales.txt");
    define("fileListaSabores","ENTIDADES/HELADOS/sabores.txt");
    define("urlImagenes","ENTIDADES/HELADOS/heladosImagen/");
    define("fileVentas","ENTIDADES/HELADOS/vendidos.txt");
    define("URLIMGBORRADAS","ENTIDADES/HELADOS/heladosBorrados/");

    
    class Accion
    {
        
        public static function MetodoPost($accion)
        {
            switch($accion)
            {
                /**
                 * ALTA DE CLIENTES
                 */
                case "cargarCliente":
                    $cliente = new Clientes($_POST["nombre"], $_POST["correo"], $_POST["clave"]);
                    if(ClientesFile::GuardarEnArchivo($cliente,fileClientes))
                    {
                        echo "Guardo cliente";
                    }else{
                        echo "Nop";
                    }
                    break;
                /**
                 * MODIFICACION DE CLIENTES
                 */
                case "modificarCliente":
                    $cliente = new Clientes($_POST["nombre"], $_POST["correo"], $_POST["clave"]);
                    if(!ClientesFile::ModificarClientes($cliente,fileClientes))
                    {
                        echo "nop nop";
                    }else{
                        echo "en teoria lo modifico";
                    }

                    break;
                /**
                 * BAJA DE CLIENTES
                 */    
                case "borrarCliente":
                    $cliente = new Clientes($_POST["nombre"], $_POST["correo"], $_POST["clave"]);
                    if(!ClientesFile::BorrarCliente($cliente,fileClientes)){
                        echo "\n no se finalizo el borrado";
                    }else{
                        echo "\n Borrado exitoso";
                    }
                    break;
                /**
                 * CARGA HELADOS
                 */    
                case "cargarHelados":
                    $helado = new Helados($_POST["sabor"],$_POST["precio"],"");
                    if(!HeladosFile::GuardarHelado($helado,urlImagenes,fileListaSabores)){
                        echo "\nNo pudo cargarse el helado";
                    }else{
                        echo "\nVer que guardo";
                    }
                
                    break;
                case "venderPost":
                    $sabor = $_POST["sabor"];
                    $cantidad = $_POST["cantidad"];
                    if(!HeladosFile::ConsultarHelados($sabor,$cantidad,fileListaSabores,fileVentas)){
                        echo "\nNo se encontro el sabor insertado";
                    }
                    break;
                case "mostrarLista":
                    $tabla = HeladosFile::ListarHelados(fileListaSabores);
                    echo "$tabla";
                    break;
                case "borrarHelado":
                    $sabor = $_POST["sabor"];
                    $coso = $_POST["coso"];
                    HeladosFile::BorrarHelado(fileListaSabores,$sabor,$coso,urlImagenes,URLIMGBORRADAS);
                    break;
                case "modificarHelado":
                    $helado = new Helados($_POST["sabor"],$_POST["precio"],"");
                    if(!HeladosFile::ModificarHelado($helado,fileListaSabores,urlImagenes)){
                        echo "no se pudo encontrar el helado";
                    }
                    break;
                default:
                    echo "No entro a ninguno de los casos anteriores";
                    break;
            }
        }

        public static function MetodoGet($accion)
        {
            switch($accion)
            {
                case "vender":
                    $sabor = $_GET["sabor"];
                    $cantidad = $_GET["cantidad"];
                    if(!HeladosFile::ConsultarHelados($sabor,$cantidad,fileListaSabores,fileVentas)){
                        echo "\nNo se encontro el sabor insertado";
                    }
                    break;
                case "litadoHelados":
                    $tabla = HeladosFile::ListarHelados(fileListaSabores);
                    echo "$tabla";
                    break;
                case "borrarHelados":
                    $sabor = $_GET["sabor"];
                    $coso = "";
                    HeladosFile::BorrarHelado(fileListaSabores,$sabor,$coso,urlImagenes,URLIMGBORRADAS);
                    break;
                default:
                    echo "No entro a ninguno de los casos anteriores";
                break;
            }
        }

    }


?>