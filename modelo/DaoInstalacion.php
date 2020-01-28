<?php

class DaoInstalacion{

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function consultarInstalaciones(){
        $instalaciones = array();
        $this->db->conectar();
        $sql = "SELECT clave_instalacion,instalacion FROM instalaciones";
        $resul = $this->db->ejecutarSQL($sql);
        foreach ($resul as $valor) {
            $instalacion = new Instalacion($valor['clave_instalacion'], $valor['instalacion']);
            $instalaciones[] = $instalacion;
        }
        $this->db->desconectar();
        return $instalaciones;
    }

}