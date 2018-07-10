<?php
    class Pedido{
        private $cliente;
        private $estadoPedido; // usar enum del pedido
        private $mesaAsignada; //mesa a ala que corresponde
        private $importe;
        private $encuestaFinal; //ver si es que va aca o realizarlo con un metodo
        private $tiempoEspera;
        private $fechaDelPedido;
        private $mozo;

        public function __construct($cliente,$estadoPedido,$tiempoEspera,$encuestaFinal,$fechaDelPedido,$mesaAsignada,$mozo,$importe)
        {
            $this->cliente=$cliente;
            $this->estadoPedido=$estadoPedido;
            $this->mesaAsignada=$mesaAsignada;
            $this->importe=$importe;
            $this->encuestaFinal=$encuestaFinal;
            $this->tiempoEspera=$tiempoEspera;
            $this->fechaDelPedido=$fechaDelPedido;
            $this->mozo=$mozo;
        }

        public function __get($prop)
        {
            return $this->$prop;
        }

        public function __toString()
        {
            return "$this->cliete-$this->estadoPedido-$this->mesaAsignada-$this->importe-$this->tiempoEspera-$this->fechaDelPedido".PHP_EOL;
        }

        public function AsignarFecha()
        {
            $retorno = false;
            if($this->fechaDelPedido==null||$this->fechaDelPedido == undefined){
                $this->fechaDelPedido=date("d/m/Y");
                $retorno = true;   
            }
            return $retorno;
        }

        public function AsignarTiempoInicial($tiempo)
        {
            $retorno=false;
            if($this->tiempoEspera!=null){
                echo 'Hay un error asignado el tiempo por primera vez';
            }else{
                $this->tiempoEspera = $tiempo;
                $retorno = true;
            }
            return $retorno;
        }

        public function CalculoTiempoFinal()
        {
            date_default_timezone_set("America/Argentina/Buenos_Aires");
            $retorno=false;
            if($this->tiempoEspera == null){
                echo 'Hay un error calculando el tiempo ';
            }else{
                $tiempoActual = explode(":",date("h:i:sa"));
                $tiempoInicial = explode(":",$this->tiempoEspera);
                $horaFinal = $tiempoActual[0]-$tiempoInicial[0];
                $minutosFinal = $tiempoActual[1]-$tiempoInicial[1];
                $segundosFinal = $tiempoActual[2]-$tiempoInicial[2];
                $this->tiempoEspera = $horaFinal.":".$minutosFinal.":".$segundosFinal;
                echo($this->tiempoEspera);
                $retorno = true;
            }
            return $retorno;
        }

        /**
         * Asignar alguna validacion posible
         */
        public function CambiarEstado($estado)
        {
            $this->estadoPedido=$estado;
        }

    }


?>