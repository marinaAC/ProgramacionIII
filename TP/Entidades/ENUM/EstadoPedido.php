<?php

    /**
     * EstadoPedido
     * Enum para los distintos estados que puede tener un pedido
     * NUEVO = 0
     * PREPARACION = 1
     * LISTO = 2
     * CANCELADO = 3
     */
    abstract class EstadoPedido{
        const NUEVO =        0;
        const PREPARACION =  1;
        const LISTO =        2;
        const CANCELADO =    3;
    }

?>