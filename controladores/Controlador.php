<?php
class Controlador
{
    public function run()
    {
        //Comprobamos cual es la accion que ha llevado a cabo el usuario
        if (isset($_POST['form_insertar']) || isset($_GET['form_insertar'])) { //El usuario quiere insertar datos
            $this->mostrarInsertar();
            exit();
        } else if (isset($_POST['form_consultar']) || isset($_GET['form_consultar'])) { //El usuario quiere consultar datos
            $this->mostrarConsultar();
        } else if (isset($_POST['insertar'])) { //El usuario ya ha insertado datos
            $aula = $_POST['aula'];
            //IMPORTANTE A HACER explode 
            $articulo = $_POST['articulo'];
            $cantidadArticulos = $_POST['cantidadArticulos'];
            $resultado = "$aula  $articulo $cantidadArticulos";
            $this->mostrarResultado($resultado);
            exit();
        } else { //Si el usuario no ha realizado ninguna accion mostramos la pagina inicial
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
        include 'vistas/vista_resultado.php';
    }
}
