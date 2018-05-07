<?php
    include_once("ARCHIVOS/accionesArchivos.php");
    include_once("ENTIDADES/HELADOS/Helados.php");

    class HeladosFile{

        public static function GuardarHelado($helado,$urlImg,$file)
        {
            $retorno = false;
            $fileObj = new AccionesArchivos($file);
            $dateF = self::NameDate();
            $nombreArchivo = $helado->sabor.".".$dateF;
            $auxliar = AccionesArchivos::UploadFile("archivo",$nombreArchivo,$urlImg);
            $helado->foto = $auxliar;
            if($fileObj->addLineFile($helado)){
                echo($auxiliar);
                echo "\neste es el resultado de subir el archivo imagen ->".$auxliar;
                $retorno = true;
             }else{
                AccionesArchivos::BorrarFileSinBackUp($auxiliar,$urlImg);
             }
            return $retorno;
        }

        public static function LeerHelados($file)
        {
            $listaHelados = [];
            $fp = fopen($file,"r");
            while(!feof($fp)){
                $helado = explode("-",fgets($fp));
                if(count($helado)==3){
                    $auxHelado = new Helados($helado[0],$helado[1],$helado[2]);
                    array_push($listaHelados,$auxHelado);
                }
            }
            return $listaHelados;
        }

        public static function ConsultarHelados($sabor,$cantidad,$file,$fileVenta)
        {
            $retorno = false;
            $listaHelados = [];
            $listaHelados = self::LeerHelados($file);
            foreach ($listaHelados as $key) {
                if($key->sabor == $sabor){
                    $precioIva = $key->PrecioMasIva();
                    $valorFinal = $precioIva*(float)$cantidad;
                    $lineaGuardar = $key->sabor."-".$cantidad."-".$valorFinal;
                    $fileObj = new AccionesArchivos($fileVenta);
                    $aux = $fileObj->addLineFile($lineaGuardar);
                    echo "este es el resultado de guardar la linea en vendidos->".$aux;
                    $retorno = true;
                    break;
                }
            }
            return $retorno;
        }

        public static function ModificarHelado($helado,$file,$urlImg)
        {
            $retorno = false;
            $listaHelados = self::LeerHelados($file);
            foreach ($listaHelados as $key) {
                if($key->sabor==$helado->sabor){
                    $key->precio = $helado->precio;
                    $sinExt = explode(".",$key->foto);
                    $nombre = $sinExt[0].".".$sinExt[1];
                    $auxliar = AccionesArchivos::ModificarFile("archivo",$nombre,$urlImg);
                    $fileObj = new AccionesArchivos($file);
                    $fileObj->saveFile($listaHelados);
                    $retorno = true;
                    break;
                }
            }
            return $retorno;
        }

        public static function ListarHelados($file)
        {
            $listaHelados = self::LeerHelados($file);
            $tabla = "<table><thead><tr><td>SABOR</td><td>PRECIO</td><td>IMAGEN</td></tr></thead><tbody>";
            foreach ($listaHelados as $key) {
                $tabla .= "<tr><td>".$key->sabor."</td>";
                $tabla .= "<td>".$key->precio."</td>";
                $aux = trim($key->foto);
                $tabla .= "<td><img style='height:10%;width:10%'  src='http://localhost/PracticaParcialCasa/ENTIDADES/HELADOS/heladosImagen/".$aux.".jpeg'>".$aux."</td></tr>";
            }
            $tabla .= "</tbody></tabla>";
            return $tabla;
        }

        public static function BorrarHelado($file,$sabor,$flag,$urlImg,$urlBackUp)
        {
            $retorno = false;
            $listaHelados = self::LeerHelados($file);
            if($flag==""){
                $retorno = array_key_exists($sabor,$listaHelados);
            }else if($flag=="borrarHelado"){
                foreach($listaHelados as $key){
                    if($key->sabor == $sabor){
                        $auxiliar = self::changeNameHelado($key->foto);
                        $index = array_search($key,$listaHelados);
                        unset($listaHelados[$index]);
                        AccionesArchivos::BorrarFile($key->foto,$urlImg,$auxiliar,$urlBackUp);
                        $fileObj = new AccionesArchivos($file);
                        $fileObj->saveFile($listaHelados);
                    }
                }
            }
        }

        private static function NameDate()
        {
            $hora = date("H");
            $minutos = date("i");
            $segundos = date("s");
            return $hora.$minutos.$segundos;
        }

        private static function changeNameHelado($name)
        {
            $newName = explode(".",$name);
            $aux = $newName[2];
            $newName[1] = ".borrado.";
            $newName[2] = self::NameDate();
            $retorno = $newName[0].$newName[1].$newName[2].$aux;
            return $retorno;
        }
    }

?>