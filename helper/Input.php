<?php

/*
     *  Clase Input: Contiene funciones para las entradas.
     */
class Input
{
    /**
     * Función estática siEnviado: Verifica si se han enviado los datos.
     * Solo configurado para $_POST;
     *
     * @param mixed $tipo: Tipo de envío.
     * @return bool Devuelve (true/false) si se ha realizado el envío.
     */
    public static function siEnviado($tipo = 'post')
    {
        switch ($tipo) {
            case 'post':
                return !empty($_POST);
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * Función estática get: Obtiene el valor del campo
     *
     * @param mixed $campo: Campo a solicitar.
     * @return mixed El valor del campo ya filtrado.
     */
    public static function get($campo) //SI
    {
        if (isset($_POST[$campo])) {
            $campovalue = $_POST[$campo];
        } else {
            $campovalue = "";
        }

        return Input::filtrar($campovalue);
    }

    /**
     * Función estática filtrar: Sanea los datos
     *
     * @param mixed $datos: Datos a sanear.
     * @return mixed Los datos ya saneados.
     */
    public static function filtrar($datos)
    {
        $datos;
        $datos = strip_tags($datos);
        $datos = htmlspecialchars($datos);
        $datos = trim($datos);
        return $datos;
    }
}
