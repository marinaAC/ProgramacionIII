<?php

    include_once("Helados.php");

    class Archivos{
    
        public static function getFecha()
        {
            $time = getdate();
            $s= $time["seconds"];
            $m= $time["minutes"];
            $h= $time["hours"];
            var_dump($time);
            return $s.$m.$h;
        }
        public static function ObtenerImg()
        {
            $extension = explode("/",$_FILES["archivo"]["type"]);
            $time = self::getFecha();
            $nameFile = $_POST["sabor"].$time;
            return $nameFile.".".$extension[1];
        }
    
        public static function UploadFile()
        {
            $retorno = "";
            $nombreArchivo = self::ObtenerImg();
            if(move_uploaded_file($_FILES["archivo"]["tmp_name"],"Helados/heladosImagen/".$nombreArchivo)){
                $retorno = $nombreArchivo;
                echo "se guardo";
            }
            return $retorno; 
        }
    
        public static function ModificarImg()
        {
            $retorno = "";
            $backUpRealizado = self::RealizarBackUp();
            if($backUpRealizado==true)
            {
               $retorno = UploadFile();
            }
            return $retorno;
        }
    
        public static function RealizarBackUp()
        {
            $retorno = false;
            $nombreArchivo = self::ObtenerImg();
            if(copy("../ARCHIVO/UPLOAD/".$nombreArchivo,"../ARCHIVO/BACKUP/".$nombreArchivo)){
                $retorno = true;
            }
            return $retorno;
        }
        
        public static function EliminarArchivo()
        {
            $retorno = false;
            $nombreArchivo = self::ObtenerImg();
            if(unlink("heladosImagen/".$nombreArchivo))
            {
                $retorno = true;
            }
            return $retorno;
        }

    }






?>