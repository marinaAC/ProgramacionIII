<?php
    include_once("Clientes.php");
    include_once("./ARCHIVOS/accionesArchivos.php");
    /**
     * Intento de realizar un dao con la clase de archivos
     */
    class ClientesFile
    {
        public static function GuardarEnArchivo($cliente,$file)
        {
            $retorno = true;
            $fileClass = new AccionesArchivos($file);
            if(!$fileClass->addLineFile($cliente))
            {
                echo "No pudo guardarse la linea con el nuevo cliente";
                $retorno = false;
            }
            return $retorno;
        }

        public static function LeerClientes($file)
        {
            $fp =fopen($file,"r");
            $listaClientes = [];
            while(!feof($fp))
            {
                $clientesDatos = explode("-", fgets($fp));
                if (count($clientesDatos) == 3) {
                    $listaClientes[] = new Clientes($clientesDatos[0], $clientesDatos[1], $clientesDatos[2]);
                }
            }
            fclose($fp);
            return $listaClientes;
        }

        public static function ModificarClientes($cliente,$file)
        {
            $return = false;

            $listaClientes = self::LeerClientes($file);
            foreach ($listaClientes as $key) 
            {
                if($key->nombre==$cliente->nombre)
                {
                    $key->correo = $cliente->correo;
                    $return = true;
                    echo "Lo encontro ";
                    break;
                }
            }
            $fileObj = new AccionesArchivos($file);
            $return = $fileObj->saveFile($listaClientes);
            return $return;
        }

        public static function BorrarCliente($cliente,$file)
        {
           $return = false;
           $listaClientes = self::LeerClientes($file);
           foreach($listaClientes as $key){
                if($key->nombre == $cliente ->nombre){
                    $index = array_search($key,$listaClientes);
                    unset($listaClientes[$index]);
                    echo "lo borro de la lista ";
                    break;
                }
            }
            $fileObj = new AccionesArchivos($file);
            $return = $fileObj->saveFile($listaClientes);
            return $return;
        } 


    }


?>