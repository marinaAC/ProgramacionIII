<?php
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
        public static function InsertToDb($objPersona)
        {
            $sql = self::ConexionDb();
            $string = "INSERT TO "
            $sql->query($string);
        }
        
    }
?>