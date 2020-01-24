<?php

class DaoInstalacion{

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function consultarInstalaciones(){
        $instalaciones = array();

        return $instalaciones;
    }

}