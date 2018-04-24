<?php

    include_once("Persona.php");

    class Archivo{
        
        public static function MetodoGet($param){
            Persona::LeerPersonas();
        }
    
        public static function ObtenerImg()
        {
            $extension = explode("/",$_FILES["archivo"]["type"]);
            $nameFile = "imagen".$_POST["legajo"];
            return $nameFile.".".$extension[1];
        }
    
        public static function UploadFile()
        {
            $retorno = "";
            $nombreArchivo = ObtenerImg();
            if(move_uploaded_file($_FILES["archivo"]["tmp_name"],"../Upload/".$nombreArchivo)){
                $retorno = $nombreArchivo;
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
            if(unlink("../ARCHIVO/UPLOAD/".$nombreArchivo))
            {
                $retorno = true;
            }
            return $retorno;
        }

    }






?>