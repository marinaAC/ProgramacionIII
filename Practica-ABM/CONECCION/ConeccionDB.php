<?php
    class ConeccionDB{
        
        public static function connect()
        {
            $con = 'mysql:host=localhost;dbname=cdcol;charset=utf8';
            $user = "root";
            $clave = "";
            $coneccionBase = new PDO($con,$user,$clave);
            return $coneccionBase;
        }

    }



?>