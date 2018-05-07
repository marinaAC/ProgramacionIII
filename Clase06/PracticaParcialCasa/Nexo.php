<?php
    include_once("Accion.php");
    /**
     * Comunicacion con las capa de accion que se va a comunicar con las entidades
     */

    if(isset($_POST["btn"]))
    {
        Accion::MetodoPost($_POST["btn"]);
    }
    else if(isset($_GET["btn"]))
    {
        Accion::MetodoGet($_GET["btn"]);
    }


?>