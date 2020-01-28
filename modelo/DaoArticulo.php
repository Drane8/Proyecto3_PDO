<?php

class DaoArticulo
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function consultarArticulos()
    {
        $articulos = array();
        $this->db->conectar();
        $sql = "SELECT codigo,articulo FROM articulos";
        $resul = $this->db->ejecutarSQL($sql);
        foreach ($resul as $valor) {
            $articulo = new Articulo($valor['codigo'], $valor['articulo']);
            $articulos[] = $articulo;
        }
        $this->db->desconectar();
        return $articulos;
    }
}
