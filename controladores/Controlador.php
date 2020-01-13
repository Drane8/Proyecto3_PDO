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

            $this->mostrarInsertar("validar");

            exit();
        } else if (isset($_POST['form_consultar']) || isset($_GET['form_consultar'])) { //El usuario quiere consultar datos
            $this->mostrarConsultar();
        } else if (isset($_POST['insertar']) && ($_POST['insertar']) == 'validar') { //El usuario ya ha insertado datos
            $this->validar();
            exit();
        } elseif (isset($_POST['insertar']) && ($_POST['insertar']) == 'continuar') {
            unset($_POST);
            $this->mostrarFormulario("validar", null, null);
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
    private function mostrarInsertar($fase)
    {
        $db = $this->conectaDb();
        $consultaAulas = "SELECT clave_instalacion FROM instalaciones";
        $aulas = $db->prepare($consultaAulas);
        $aulas->execute();
        $consultaArticulos = "SELECT * FROM articulos";
        $articulos = $db->prepare($consultaArticulos);
        $articulos->execute();
        $db = null;
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

    function conectaDb()
    {
        try {
            $db = new PDO("mysql:host=" . "localhost" . ";dbname=" .
                "inventario_daid_p3", "alumno", "alumno");
            // Se puede configurar el objeto 
            $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $db->exec("set names utf8mb4");
            return ($db);
        } catch (PDOException $e) {
            echo " <p>Error: " . $e->getMessage() . "</p>\n";
            exit();
            //OTRA Opción podría ser enviar a otra página 
            header('Location: vistas/error.php?error=ERROR');
            exit();
        }
    }




    //-------------------------------------------------




    private function mostrarFormulario($fase, $validador, $resultado)
    {
        $db = $this->conectaDb();
        $consultaAulas = "SELECT clave_instalacion FROM instalaciones";
        $aulas = $db->prepare($consultaAulas);
        $aulas->execute();
        $consultaArticulos = "SELECT * FROM articulos";
        $articulos = $db->prepare($consultaArticulos);
        $articulos->execute();
        $db = null;
        include 'vistas/form_insertar.php';
    }

    private function crearReglasDeValidacion()
    {
        $reglasValidacion = array(
            "aula" => array("required" => true),
            "articulo" => array("required" => true),
            "cantidadArticulos" => array("min" => 1, "max" => 100, "required" => true),
            "fecha" => array("fechaMax" => "2020-01-13"),
            "observaciones" => array("maxCaracteres" => 250),
        );

        return $reglasValidacion;
    }

    private function validar()
    {
        $validador = new ValidadorForm();
        $reglasValidacion = $this->crearReglasDeValidacion();
        $validador->validar($_POST, $reglasValidacion);
        if ($validador->esValido()) {
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
            $this->mostrarFormulario("continuar", $validador, $resultado);
            exit();
        }

        // formulario no correcto, mostrarlo nuevamente con los errores
        $this->mostrarFormulario("validar", $validador, null);
        exit();
    }
}
