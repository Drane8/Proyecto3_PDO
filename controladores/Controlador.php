<?php

/**
 * Se encarga de gestionar las interacciones del usuario en la vista, 
 * pide los datos al modelo y los devuelve de nuevo a la vista para que 
 * esta los muestre al usuario.
 * 
 * @author Daniel García e Idoia Palomar
 */
class Controlador
{
    /**
     * Función principal que gestiona las interacciones
     *
     */
    public function run()
    {
        //Comprobamos cual es la acción que ha llevado a cabo el usuario
        if (isset($_POST['form_insertar']) || isset($_GET['form_insertar'])) { //El usuario quiere insertar datos
            $this->mostrarInsertar();
            exit();
        } else if (isset($_POST['form_consultar']) || isset($_GET['form_consultar'])) { //El usuario quiere consultar datos
            $this->mostrarConsultar();
        } else if (isset($_POST['insertar'])) { //El usuario ya ha insertado datos

            $aula = $_POST['aula'];
            $articulo = explode("|", $_POST['articulo']);
            $cantidadArticulos = $_POST['cantidadArticulos'];
            $fecha = date("d/m/Y", strtotime($_POST['fecha']));
            $observaciones = $_POST['observaciones'];
            $resultado = "Aula: $aula <br/>" .
                "Artículo: " . $articulo[0] . " " . $articulo[1] . "<br/>" .
                "Cantidad: $cantidadArticulos<br/>" .
                "Fecha compra: $fecha<br/>" .
                "Observaciones: $observaciones";
            $this->mostrarResultado($resultado);
            exit();
        } else { //Si el usuario no ha realizado ninguna acción mostramos la página inicial
            $this->mostrarInicio();
            exit();
        }
    }

    /**
     * Se encarga de mostrar la vista inicial de la página
     */
    private function mostrarInicio()
    {
        include "vistas/bienvenida.php";
    }

    /**
     * Se encarga de mostrar la vista del formulario de insertar
     */
    private function mostrarInsertar()
    {
        include 'vistas/form_insertar.php';
    }

    /**
     * Se encarga de mostrar la vista del formulario de consultar
     */
    private function mostrarConsultar()
    {
        include "vistas/form_consultar.php";
    }

    /**
     * Se encarga de mostrar la vista del resultado
     */
    private function mostrarResultado($resultado)
    {
        include 'vistas/form_insertar.php';
    }
}
