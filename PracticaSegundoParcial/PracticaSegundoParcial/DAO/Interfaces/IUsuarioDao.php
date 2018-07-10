<?php

interface IUsuarioDao{
    public function GetByFiltro($filtro);
    public function GetByIdUsuario($id);
    public function RemoveUsuario($usuario);
    public function SaveUsuario($usuario);
    public function UpdateUsuario($usuario);
    public function GetUsuarioByNombre($nombre);
    public function GetUsuarioByTipo($tipo);
    public function GetUsuarioByNombreyPass($nombre,$pass);
}


?>