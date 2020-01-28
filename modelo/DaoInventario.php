<?php

class DaoInventario
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

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
        if ($existe == 0) {
            $sql = "INSERT INTO inventario(clave_instalacion, codigo_articulo, articulo, cantidad, fecha_compra, observaciones) VALUES (?,?,?,?,?,?)";
            $this->db->conectar();
            $resul = $this->db->ejecutarSQLActualizacion($sql, $args);
            $this->db->desconectar();
        }
        return $resul;
    }

    public function existeInventario($claveInstalacion, $codigoArticulo)
    {
        $existe = "";
        $this->db->conectar();
        $sql = "SELECT count(*) FROM inventario WHERE clave_instalacion='$claveInstalacion' AND codigo_articulo='$codigoArticulo'";
        $resul = $this->db->ejecutarSQL($sql);

        $existe = $resul->fetchColumn();
        $this->db->desconectar();
        return $existe;
    }

    public function consultarInventario($aulas)
    {
        $this->db->conectar();
        $sql = "SELECT clave_instalacion, codigo_articulo, articulo, cantidad, fecha_compra, observaciones 
                FROM inventario WHERE clave_instalacion in ($aulas)";
        $resul = $this->db->ejecutarSQL($sql);
        $this->db->desconectar();
        return $resul;
    }
}
