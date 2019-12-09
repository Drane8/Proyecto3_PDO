<?php
class Controlador
{
    public function run()
    {
        if (!isset($_POST['insertar']))//no se ha enviado el formulario
        { // primera petición
            //se llama al método para mostrar el formulario inicial
            $this->mostrarFormulario();
			exit();
        } else
        {
            //el formulario ya se ha enviado
            //se recogen y procesan los datos
            //se llama al método para mostrar el resultado
            $aula=$_POST['aula'];

            //IMPORTANTE A HACER explode 
            $articulo=$_POST['articulo'];
            $cantidadArticulos = $_POST['cantidadArticulos'];
            $resultado ="Bienvenido/a $aula" . $articulo;
            $this->mostrarResultado($resultado);
			exit();		
        }
    }
    private function mostrarFormulario()
    {
     //se muestra la vista del formulario (la plantilla form_bienvenida.php)   
        include 'vistas/form_inicial.php';
    }
    private function mostrarResultado($resultado)
    {
    // y se muestra la vista del resultado (la plantilla resultado.,php)
        include 'vistas/vista_resultado.php';
    }
}
?>