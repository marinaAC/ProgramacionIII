<?php

interface IVentaDao{
    public function GetByFiltro($filtro);
    public function GetByIdUsuario($id);
    public function RemoveVenta($venta);
    public function SaveVenta($venta);
    public function UpdateVenta($venta);
    public function GetVentaByUsuario($usuario);
    public function GetVentaByMarca($marca);
    public function GetVentaByPrecio($precio);
    public function GetByAll();
}


?>