<?php
   
    include_once("Accion.php");

    if(isset($_POST["btn"]))
    {
        MetodoPost($_POST["btn"]);
    }else if(isset($_GET["params"])){
        MetodoGet($_GET["params"]);
    }

    if(isset($_GET["db"]))
    {
        echo "entro a la db";
        DB::Test();
    }
    


?>