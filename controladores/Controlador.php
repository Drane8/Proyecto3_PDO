<?php
class Controlador
{
    public function run()
    {
        if (isset($_POST['form_insertar']) || isset($_GET['form_insertar'])) {
            //Se muestra el el formulario de insertar
            $this->mostrarInsertar();
            exit();
        } else if (isset($_POST['form_consultar']) || isset($_GET['form_consultar'])) {
            //mostrar consultar
            $this->mostrarConsultar();
        } else if (isset($_POST['insertar'])) {
            $aula = $_POST['aula'];
            //IMPORTANTE A HACER explode 
            $articulo = $_POST['articulo'];
            $cantidadArticulos = $_POST['cantidadArticulos'];
            $resultado = "$aula  $articulo $cantidadArticulos";
            $this->mostrarResultado($resultado);
            exit();
        } else {
            //se llama al método para mostrar el formulario inicial
            $this->mostrarInicio();
            exit();
        }
    }

    private function mostrarInicio()
    {
        include "vistas/bienvenida.php";
    }

    private function mostrarInsertar()
    {
        //se muestra la vista del formulario (la plantilla form_bienvenida.php)   
        include 'vistas/form_insertar.php';
    }

    private function mostrarConsultar()
    {
        include "vistas/form_consultar.php";
    }

    private function mostrarResultado($resultado)
    {
        // y se muestra la vista del resultado (la plantilla resultado.,php)
        include 'vistas/vista_resultado.php';
    }
}
