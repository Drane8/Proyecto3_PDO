<?php

/*
 * No lo utilizamos en el primer ejemplo de validación
 */

class Utilidades
{

    public static function verificarLista($valor, $valorMenu)
    {
        if($valor == $valorMenu){
            return 'selected = "selected"';
        }
    }

}