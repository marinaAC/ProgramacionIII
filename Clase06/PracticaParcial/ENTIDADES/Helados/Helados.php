<?php
    include_once("IVendible.php");
    class Helado implements IVendible{
        private $sabor;
        private $precio;
        private $foto;

        public function __construct($sabor,$precio,$foto)
        {
            $this->sabor= $sabor;
            $this->precio=$precio;
            $this->foto = $foto;
        }

        public function __get($prop)
        {
            return $this->$prop;
        }
        public function __set($prop,$value)
        {
            $this->$prop = $value;
        }
        public function __toString()
        {
            return "$this->sabor-$this->precio-$this->foto".PHP_EOL;
        }

        public function PrecioMasIva()
        {
           $retorno= (int)$this->precio*0.21;
           return $retorno;
        }

        
        public static function GuardarArchivo($helados,$file)
        {
          
           $return = false;
           $fp = fopen($file, "w");
           foreach ($helados as $h) {
               fwrite($fp, "$h");
               $return = true;
               echo "se guardo";
           }
           fclose($fp);
           return $return;
        }
        public static function LeerArchivo($file)
        {           
           $fp = fopen($file,"r");
           $helados = [];
           while (!feof($fp)) {
                $heladosDatos = explode("-", fgets($fp));
                if (count($heladosDatos) == 3) {
                    $helados[] = new Helado($heladosDatos[0], $heladosDatos[1], $heladosDatos[2]);
                }
           }
           fclose($fp);
           return $helados;
        }

        public static function CargarHelados($h)
        {
            $retorno = false;
            $file = "Helados/heladosLista.txt";
            var_dump($h);
            $listaHelados = self::LeerArchivo($file);
            foreach($listaHelados as $helados)
            {
                if($helados->sabor == $h->sabor)
                {
                    $retorno = true;
                    break;
                }
            }
            if(!$retorno){
                $listaHelados[]=$h;
            }
            self::GuardarArchivo($listaHelados,$file);
            return $retorno;
        }

        public static function VenderHelado($saborHelado,$cantidad)
        {   
            $file = "Helados/heladosLista.txt";
            $listaHelados = self::LeerArchivo($file);
            $return = false;
            foreach($listaHelados as $key){
                if($key->sabor==$saborHelado){
                    $precioConIva = (int)$key->precio*(int)$cantidad;
                    echo "Precio con iva ->".$precioConIva;
                    $return = true;
                    break;  
                }else{
                    echo "No se encuentra el sabor";
                }
            }
            return $return;
        }

    }


?>