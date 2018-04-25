<?php
    class Cliente
    {
        private $nombre;
        private $correo;
        private $clave;
        
        public function __construct($nombre,$correo,$clave)
        {
            $this->nombre = $nombre;
            $this->correo = $correo;
            $this->clave = $clave;
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
             return "$this->nombre-$this->correo-$this->clave".PHP_EOL;
         }

         public static function GuardarArchivo($cliente,$file)
         {
           
            $return = false;
            $fp = fopen($file, "w");
            foreach ($cliente as $p) {
                fwrite($fp, "$p");
                $return = true;
            }
            fclose($fp);
            return $return;
         }

        public static function ValidarLoggeo($cliente)
        {   
            $retorno = false;
            $file = "clientesActuales.txt";
            $listaClientes = self::LeerArchivo($file);
            foreach($listaClientes as $key){
                if($key->correo==$cliente->correo || $key->clave == $cliente->clave){
                    $retorno = true;
                    echo "cliente loggueado".$key->nombre;
                    
                }else{
                    echo "cliente inexistente";
                }
            }
            return $retorno;
        }


         public static function LeerArchivo($file)
         {           
            $fp = fopen($file,"r");
            $clientes = [];
            while (!feof($fp)) {
                $clientesDatos = explode("-", fgets($fp));
                if (count($clientesDatos) == 3) {
                    $clientes[] = new Cliente($clientesDatos[0], $clientesDatos[1], $clientesDatos[2]);
                }
            }
            fclose($fp);
            return $clientes;
         }


         public static function CargaClientes($p)
         {
             $retorno = false;
             $file = "clientesActuales.txt";
             $listaPersonas = self::LeerArchivo($file);
             if (!self::ValidarLoggeo($p)) {
                $listaPersonas[] = $p;
                $retorno = true;
             } 
             self::GuardarArchivo($listaPersonas,$file);
             return $retorno;
         }

         //Borrar
         public static function ModificarPersona($p)
         {
             $ret = false;
             $listaPersonas = self::LeerArchivo("Lista.txt");
             $persona = self::BuscarPorLegajo($listaPersonas, $p->clave);
             echo "$persona";
             if ($persona == null) {
                 echo "No se encuentra la persona que quiere modificar.";
             } else {
                 $key = array_search($persona, $listaPersonas);
                 $persona = $p;
                 $ret = true;
                 $listaPersonas[$key] = $persona;
             }
             self::GuardarArchivo($listaPersonas, "Lista.txt");
             return $ret;
         }

         public static function LeerPersonas(){
            $ppl = self::LeerArchivo("Lista.txt");
            foreach($ppl as $person){
                $nom = $person->nombre;
                echo "Nombre: ".$nom;
            }
            return $ppl;
        }

        public static function BorrarPersona($p)
        {
            $ret = false;
            $ppl = self::LeerArchivo("Lista.txt");
            if (self::BuscarPorLegajo($ppl, $p->legajo)) {
                $key = array_search($p, $ppl);
                echo $key;
                unset($ppl[$key]);
                $ret = true;
            } else {
                echo "La persona no se encuentra en la lista";
            }
            self::GuardarArchivo($ppl, "Lista.txt");
            return $ret;
        }
    }
?>