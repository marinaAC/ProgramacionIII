<?php
    include_once("IVendible.php");
    class Helados implements IVendible
    {
        private $sabor;
        private $precio;
        private $foto;

        public function __construct($sabor,$precio,$foto)
        {
            $this->sabor = $sabor;
            $this->precio = $precio;
            $this->foto = $foto;
        }

        public function __get($prop)
        {
            return $this->$prop;
        }

        public function __set($prop,$value)
        {
            $this->$prop = $value;
        }

        public function __toString()
        {
            return "$this->sabor-$this->precio-$this->foto".PHP_EOL;
        }

        public function PrecioMasIva()
        {
            $total = (float)$this->precio * 0.21;
            $total = $total +(float) $this->precio;
            return $total;
        }
    }
    

?>