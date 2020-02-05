<?php

class DaoInstalacion{

    private $db;

    /**
     * Constructor de la clase DaoInstalacion
     */
    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Funcion que devuelve todos los claves e instalaciones
     * de la tabla instalaciones
     *
     * @return array Array con los registros
     */
    public function consultarInstalaciones(){
        $this->db->conectar();
        $sql = "SELECT clave_instalacion,instalacion FROM instalaciones";
        $resul = $this->db->ejecutarSQL($sql)->fetchAll(PDO::FETCH_ASSOC);
        $this->db->desconectar();
        return $resul;
    }

}