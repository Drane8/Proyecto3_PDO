<?php

class DaoInventario{
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function insertarInventario($inventario)
    {
        
    }

    public function existeInventario($claveInstalacion, $codigoArticulo)
    {
        # code...
    }
}