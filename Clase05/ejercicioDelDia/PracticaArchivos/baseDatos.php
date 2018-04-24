<?php
    include_once("Entidades/Personas.php");
    class DB
    {
        public static function Test()
        {
            $con = 'mysql:host=localhost;dbname=cdcol;charset=utf8';
            $user = "root";
            $clave = "";
            $coneccionBase = new PDO($con,$user,$clave);
            
    
            $sql = $coneccionBase->query("select * from cds");
            // $resp =$sql->fetchAll();
            // foreach($resp as $fila){
            //     var_dump($resp);
            //     echo"--->";
            // }
            
            while($fila = $sql->fetch(PDO::FETCH_ASSOC)){
                var_dump($fila);
                echo"--->";
            }
           

        }

        public static function ConexionDb()
        {
            $con = 'mysql:host=localhost;dbname=cdcol;charset=utf8';
            $user = "root";
            $clave = "";
            $coneccionBase = new PDO($con,$user,$clave);
            return $coneccionBase;
        }

        
        public static function SelectListaDb(){
            $sql = self::ConexionDb();
            $query = $sql->query("select * from persons");
            $listaPersonas = [];
            while($fila = $query->fetch(PDO::FETCH_ASSOC)){
                $person = new Person($fila["nombre"],$fila["apellido"],$fila["legajo"],$fila["dni"],$fila["imagen"]);
                array_push($listaPersonas,$person);
            }
            return $listaPersonas;
        }


        
        public static function InsertToDb($persona)
        {
            $auxiliar = false;
            if($persona != "undefined")
            {
                $listaPersonas = self::SelectListaDb();
                foreach ($listaPersonas as $p) {
                    if($p->legajo==$persona->legajo)
                    {
                        $auxiliar = true;
                        break;
                    }
                }
                if(!$auxiliar)
                {
                    $sql = self::ConexionDb();
                    $query = $sql->query("INSERT INTO persons (nombre, apellido, legajo, dni, imagen) VALUES ('$persona->nombre', '$persona->apellido', '$persona->legajo', '$persona->dni', '$persona->imagen');");
                }
            }
        }
        
    }
?>