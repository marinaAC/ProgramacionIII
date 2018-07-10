<?php

interface IHistorialDao{
    public function GetByFiltro($filtro);
    public function RemoveHistorial($historial);
    public function SaveHistorial($historial);
    public function UpdateHistorial($historial);
    public function GetVentaByUsuario($historial);
}


?>