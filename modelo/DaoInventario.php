<?php

class DaoInventario
{
    private $db;

    /**
     * Constructor de la clase DaoInventario
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Esta funcion recibe un objeto inventario y lo inserta
     * en la base de datos
     * 
     * @param Inventario $inventario
     * @return boolean Devuelve si la insercion ha sido correcta o no
     */
    public function insertarInventario($inventario)
    {
        $resul = false;
        $args = array(
            $inventario->getClaveInstalacion(),
            $inventario->getCodigoArticulo(),
            $inventario->getArticulo(),
            $inventario->getCantidad(),
            $inventario->getFechaCompra(),
            $inventario->getObservaciones()
        );
        $existe = $this->existeInventario($args[0], $args[1]);
        if (!$existe) {
            $sql = "INSERT INTO inventario(clave_instalacion, codigo_articulo, articulo, cantidad, fecha_compra, observaciones) VALUES (?,?,?,?,?,?)";
            $this->db->conectar();
            $resul = $this->db->ejecutarSQLActualizacion($sql, $args);
            $this->db->desconectar();
        }
        return $resul;
    }

    /**
     * Funcion que comprueba si ya existe el inventario en
     * la base de datos
     *
     * @param mixed $claveInstalacion: Clave de la instalacion 
     * @param mixed $codigoArticulo: Codigo del articulo
     * @return boolean Devuelve true si el articulo existe o false en caso contrario
     */
    public function existeInventario($claveInstalacion, $codigoArticulo)
    {
        $existe = "";
        $this->db->conectar();
        $sql = "SELECT count(*) FROM inventario WHERE clave_instalacion='$claveInstalacion' AND codigo_articulo='$codigoArticulo'";
        $resul = $this->db->ejecutarSQL($sql);
        $existe = $resul->fetchColumn();
        $this->db->desconectar();
        return $existe > 0;
    }

    /**
     * Funcion que devuelve los registros existentes de las
     * aulas recibidas 
     *
     * @param array $aulas: Array con las aulas a consultar
     * @return array Array con los registros
     */
    public function consultarInventario($aulas)
    {
        $this->db->conectar();
        $sql = "SELECT clave_instalacion, codigo_articulo, articulo, cantidad, fecha_compra, observaciones 
                FROM inventario WHERE clave_instalacion in ($aulas)";
        $resul = $this->db->ejecutarSQL($sql)->fetchAll(PDO::FETCH_ASSOC);
        $this->db->desconectar();
        return $resul;
    }
}
