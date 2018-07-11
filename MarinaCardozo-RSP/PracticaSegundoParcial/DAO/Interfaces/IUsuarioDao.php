<?php

interface IUsuarioDao{
    public function GetByFiltro($filtro);

 
    public function SaveUsuario($usuario);

    public function GetUsuarioByNombreyPass($nombre,$pass);
    public function GetAllUs();
}


?>