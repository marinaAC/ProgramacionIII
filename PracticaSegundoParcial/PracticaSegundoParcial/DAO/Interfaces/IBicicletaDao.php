<?php
interface IBicicletaDao {

    public function GetByFiltro($filtro);
    public function GetByIdBicicleta($id);
    public function RemoveBicicleta($id);
    public function SaveBicicleta($bicicleta);
    public function UpdateBicicleta($bicicleta);
    public function GetBicicletaByModelo($modelo);
    public function GetBicicletaByPrecio($precio);
    public function GetAllBicicletas();
    
}


?>