<?php

    
     class Usuario{

         private $id;
         private $nombre;
         private $apellido;
         private $pass;
        //  private $type;

         function __construct($nombre,$apellido){
            $this->nombre = $nombre;
            $this->apellido = $apellido;
         }

         public function __get($prop)
         {
            return $this->$prop;
         }



     }


?>