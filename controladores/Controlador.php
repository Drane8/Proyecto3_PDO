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
            $this->mostrarFormulario("validar", null, null);
            exit();
        } else if (isset($_POST['form_consultar']) || isset($_GET['form_consultar'])) { //El usuario quiere consultar datos
            $this->mostrarConsultar();
        } else if (isset($_POST['insertar']) && ($_POST['insertar']) == 'validar') { //El usuario ya ha insertado datos para validar
            $this->validar();
            exit();
        } elseif (isset($_POST['insertar']) && ($_POST['insertar']) == 'continuar') { //Los datos ya han sido insertados y validados.
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
     * Se encarga de mostrar la vista del formulario de consultar
     */
    private function mostrarConsultar()
    {
        include "vistas/form_consultar.php";
    }

    /**
     * Funcion para mostrar el formulario de insertar
     *
     * @param mixed $fase: El estado en la que se encuentra el formulario (validar o continuar) 
     * @param mixed $validador: El objeto con el que se va a validar los datos
     * @param mixed $resultado: El resultado para mostrar los datos una vez validados
     */
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

    /**
     * Esta funcion se encarga de realizar la conexión con la base de datos
     */
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

    /**
     * Metodo usado para crear las reglas de validacion que necesitemos
     *
     * @return mixed Devuelve un array con las reglas de validacion
     */
    private function crearReglasDeValidacion()
    {
        $reglasValidacion = array(
            "aula" => array("required" => true),
            "articulo" => array("required" => true),
            "cantidadArticulos" => array("min" => 1, "max" => 100, "required" => true),
            "fecha" => array("fechaMax" => date('Y-m-d')),
            "observaciones" => array("maxCaracteres" => 250),
        );

        return $reglasValidacion;
    }

    /**
     * Funcion utilizada para validar los datos. A traves de esta funcion
     * hacemos uso de la clase ValidadorForm.
     */
    private function validar()
    {
        $validador = new ValidadorForm();
        $reglasValidacion = $this->crearReglasDeValidacion();
        $validador->validar($_POST, $reglasValidacion);
        if ($validador->esValido()) {
            $aula = $_POST['aula'];
            $articulo = explode("|", $_POST['articulo']);
            $cantidadArticulos = $_POST['cantidadArticulos'];
            $fecha = "";
            if ($_POST['fecha'] != "") {
                $fecha = date("d/m/Y", strtotime($_POST['fecha']));
            }
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
