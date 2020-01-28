<?php

/*
 * No lo utilizamos en el primer ejemplo de validación
 */

class Utilidades
{

    public static function verificarLista($valor, $valorMenu)
    {
        if ($valor == $valorMenu) {
            return 'selected = "selected"';
        }
    }

    public static function verificarListaMultiple($valores, $valorMenu)
    {
        if (is_array($valores)) {
            if (in_array($valorMenu, $valores)) {
                return 'selected = "selected"';
            }
        }
    }
}
