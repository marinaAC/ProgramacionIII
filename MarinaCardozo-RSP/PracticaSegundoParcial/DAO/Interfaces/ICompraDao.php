<?php

interface ICompraDao{
    public function GetByFiltro($filtro);
    
    public function RemoveCompra($Compra);
    public function SaveCompra($Compra);
    public function UpdateCompra($Compra);
    public function GetByAll();
}


?>