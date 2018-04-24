<?php
    class Persona
    {
        private nombre;
        private apellido;
        private legajo;
        private dni;
        private imagen;

        /**
         * Constructor
         */
        public function __construc($nombre,$apellido,$legajo,$dni,$imagen)
        {
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->legajo = $legajo;
            $this->dni = $dni;
            $this->imagen = $imagen;
        }

        /**
         * Getters y Setters
         */

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
             return "$this->nombre-$this->apellido-$this->legajo-$this->dni-$this->imagen" . PHP_EOL;
         }

         public static function LeerArchivo($file)
         {           
            $fp = fopen($file,"r");
            $personas = [];
            while (!feof($fp)) {
                $personaDatos = explode("-", fgets($fp));
                if (count($personaDatos) == 5) {
                    $personas[] = new Persona($personaDatos[0], $personaDatos[1], $personaDatos[2], $personaDatos[3], $personaDatos[4]);
                }
            }
            fclose($fp);
            return $personas;
         }

         public static function BajarPersonas($personas, $file)
         {
             $fp = fopen($file, "w");
             foreach ($personas as $p) {
                 fwrite($fp, "$p");
             }
             fclose($fp);
         }

         public static function BuscarPorLegajo($ppl, $legajo)
         {
             $retorno = null;
             foreach ((array) $ppl as $key) {
                 if ((int) $key->legajo == (int) $legajo) {
                    $retorno = $key;
                 }
             }
             return $retorno;
         }

         public static function CargarPersona($p)
         {
             $retorno = false;
             $listaPersonas = self::LeerArchivo("Lista.txt");
             if (self::BuscarPorLegajo($listaPersonas, $p->legajo)) {
                 echo "La persona ya se encuentra en la lista";
             } else {
                 $listaPersonas[] = $p;
                 $ret = true;
             }
             self::BajarPersonas($listaPersonas, "Lista.txt");
             return $retorno;
         }

         public static function ModificarPersona($p)
         {
             $ret = false;
             $listaPersonas = self::LeerArchivo("Lista.txt");
             $persona = self::BuscarPorLegajo($listaPersonas, $p->legajo);
             echo "$persona";
             if ($persona == null) {
                 echo "No se encuentra la persona que quiere modificar.";
             } else {
                 $key = array_search($persona, $listaPersonas);
                 $persona = $p;
                 $ret = true;
                 $listaPersonas[$key] = $persona;
             }
             self::BajarPersonas($listaPersonas, "Lista.txt");
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
            self::BajarPersonas($ppl, "Lista.txt");
            return $ret;
        }
    }
    



?>