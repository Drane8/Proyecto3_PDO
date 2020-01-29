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

    private $daoArticulo;
    private $daoInstalacion;
    private $daoInventario;
    private $errorInserccion;

    public function __construct()
    {
        $this->daoArticulo = new DaoArticulo();
        $this->daoInstalacion = new DaoInstalacion();
        $this->daoInventario = new DaoInventario();
        $this->errorInserccion = false;
    }

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
            $this->mostrarConsultar("validar", null, null);
            exit();
        } else if (isset($_POST['consultar']) && ($_POST['consultar']) == 'validar') { //El usuario ha seleccionado datos a consultar
            $this->validar();
            exit();
        } else if (isset($_POST['consultar']) && ($_POST['consultar']) == 'continuar') { //Los datos se han validado y mostrado
            unset($_POST);
            $this->mostrarConsultar("validar", null, null);
            exit();
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
    private function mostrarConsultar($fase, $validador, $resultado)
    {
        $instalaciones = $this->daoInstalacion->consultarInstalaciones();
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
        $instalaciones = $this->daoInstalacion->consultarInstalaciones();
        $articulos = $this->daoArticulo->consultarArticulos();
        if ($this->errorInserccion) {
            $errorInserccion = true;
        }
        include 'vistas/form_insertar.php';
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

        //Comprobamos si los datos son validos
        if ($validador->esValido()) {
            //Comprobamos de que formulario se trata
            if (isset($_POST['insertar'])) {
                $aula = $_POST['aula'];
                $articulo = explode("|", $_POST['articulo']);
                $cantidadArticulos = $_POST['cantidadArticulos'];
                $fecha = $_POST['fecha'];
                if (empty($fecha)) {
                    $fecha = null;
                }
                $observaciones = $_POST['observaciones'];
                if (empty($observaciones)) {
                    $observaciones = null;
                }
                $inventario = new Inventario($aula, $articulo[0], $articulo[1], $cantidadArticulos, $fecha, $observaciones);

                //Comprobamos si consulta da error al existir una entrada con las mismas claves
                if (!$this->daoInventario->insertarInventario($inventario)) {
                    $this->errorInserccion = true;
                    $this->mostrarFormulario("validar", $validador, null);
                    exit();
                } else {
                    if ($fecha != null) {
                        $fecha = date("d/m/Y", strtotime($_POST['fecha']));
                    }
                    $resultado = "SE HA INSERTADO CORRECTAMENTE <hr/>Aula: $aula <br/>" .
                        "Artículo: " . $articulo[0] . " " . $articulo[1] . "<br/>" .
                        "Cantidad: $cantidadArticulos<br/>" .
                        "Fecha compra: $fecha<br/>" .
                        "Observaciones: $observaciones";
                    $this->mostrarFormulario("continuar", $validador, $resultado);
                    exit();
                }
            } else if (isset($_POST['consultar'])) {
                $aulas =  "'". implode("','", $_POST['aulas']) . "'";
                $resul = $this->daoInventario->consultarInventario($aulas);
                if (!$resul) {
                } else {
                    $resultado = "<table class='table'>
                <thead class='thead-dark'>
                    <tr>
                    <th>Aula</th>
                    <th>Articulo</th>
                    <th>Cantidad</th>
                    <th>Fecha Compra</th>
                    <th>Observaciones</th>
                </tr></thead>";
                    foreach ($resul as $valor) {
                        $resultado .= "<tr>
                    <td>" . $valor['clave_instalacion'] . "</td>
                    <td>" . $valor['articulo'] . "</td>
                    <td>" . $valor['cantidad'] . "</td>
                    <td>" . $valor['fecha_compra'] . "</td>
                    <td>" . $valor['observaciones'] . "</td>
                    </tr>";
                    }

                    $resultado .= "</table>";
                    $this->mostrarConsultar("continuar", $validador, $resultado);
                    exit();
                }
            }
        }

        // formulario no correcto, mostrarlo nuevamente con los errores
        //Comprobamos de que formulario se trata
        if (isset($_POST['insertar'])) {
            $this->mostrarFormulario("validar", $validador, null);
            exit();
        } else if (isset($_POST['consultar'])) {
            $this->mostrarConsultar("validar", $validador, null);
            exit();
        }
    }
}
