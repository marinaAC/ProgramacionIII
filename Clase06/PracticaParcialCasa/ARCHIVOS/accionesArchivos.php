<?php
    class AccionesArchivos
    {
        private $file;

        public function __construct($file)
        {
            $this->file =$file;
        }

        public function __get($prop)
        {
            return $this->$prop;
        }

        public function saveFile($listObj)
        {
            $retorno = false;
            if($listObj!=null && file_exists($this->file))
            {
                $fp = fopen($this->file,"w");
                foreach ($listObj as $key) 
                {
                    fwrite($fp,"$key");
                    $retorno = true;
                }
                fclose($fp);
            }
            return $retorno;
        }

        public function addLineFile($line)
        {
            $retorno = false;
            $existe = file_exists($this->file);
            if(file_exists($this->file)&&$line!="")
            {
                $fp = fopen($this->file,"a");
                fwrite($fp, PHP_EOL."$line");
                $retorno = true;
            }
            fclose($fp);
            return $retorno;
        }

        /**
         * ObtenerFileTemp: Obtiene el nombre de un archivo
         * $tag_name: recibe el tag con el cual lo va agarrar del metodo post
         * $tag_condicion: las condiciones para ponerle el nombre dependiendo del archivo.
         * return: nombre del archivo
         */
        public static  function ObtenerFileTemp($tag_name,$tag_condicion)
        {
            $extension = explode("/",$_FILES[$tag_name]["type"]);
            $nameFile = $tag_condicion.".".$extension[1];
            return $nameFile;
        }

        /**
         * UploadFile: carga un archivo a la url que se le envie por parametros
         * $tag_name: recibe el tag con el cual lo va agarrar del metodo post
         * $tag_condicion: las condiciones para ponerle el nombre dependiendo del archivo.
         * $url: direccion donde se desea realizar el guardado del archivo
         * return: si la carga es exitosa, retorna el nombre del archivo, sino devuelve un string vacio
         */
        public static function UploadFile($tag_name,$tag_condicion,$url)
        {
            $return = "";
            $nameFile =self::ObtenerFileTemp($tag_name,$tag_condicion);
            if(move_uploaded_file($_FILES[$tag_name]["tmp_name"],$url.$nameFile)){
                $return = $nameFile;
            }
            return $return;
        }

        /**
         * BackUpFile: realiza una copia del archivo donde fue guardado y copiarlo en otra carpeta
         * $tag_name: recibe el tag con el cual lo va agarrar del metodo post
         * $tag_condicion: las condiciones para ponerle el nombre dependiendo del archivo.
         * $url: direccion donde se desea realizar el guardado del archivo
         * $url2: direccion donde se realizara el respaldo del archivo
         * return: true si pudo hacer el copiado, false sino se llevo acabo.
         */
        public static function BackUpFile($tag_condicion,$url,$tag_name2,$url2){
            $retorno = false;
            if(copy($url.$tag_condicion,$url2.$tag_name2)){
                $retorno = true;
            }
            return $retorno;
        }

        /**
         * ModificarFile: realiza un guardado del archivo antes de modificarlo.
         * $tag_name: recibe el tag con el cual lo va agarrar del metodo post
         * $tag_condicion: las condiciones para ponerle el nombre dependiendo del archivo.
         * $url: direccion donde se desea realizar el guardado del archivo
         * $url2: direccion donde se realizara el respaldo del archivo
         * return: devuelve vacio sino pudo copiar el archivo sino retorna el nombre del archivo.
         */
        public static function ModificarFile($tag_name,$tag_condicion,$url)
        {
            $retorno = "";
        //    $backUpFileResult = self::BackUpFile($tag_condicion,$url,$tag_name2,$url2);
        //    if($backUpFileResult){
                $retorno = self::UploadFile($tag_name,$tag_condicion,$url);
         //   }
            return $retorno;   
        }

        public static function BorrarFile($tag_condicion,$url,$tag_name2,$url2){
            $retorno=false;
            $aux = trim($tag_condicion);
            $aux2 = trim($tag_name2);
            $backUpFileResult = self::BackUpFile($aux,$url,$aux2,$url2);
            if($backUpFileResult){
               $retorno = unlink($url.$aux);
            }
            return $retorno;
        }

        public static function BorrarFileSinBackUp($filename,$url)
        {
            $retorno = false;
            $aux = trim($filename);
            if(unlink($url.$aux)){
                $retorno = true;
            }
            return $retorno;
        }
    }



?>