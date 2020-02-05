<?php

class DaoArticulo
{

    private $db;

    /**
     * Constructor de la clase DaoArticulo
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Funcion que devuelve todos los codigos y articulos
     * de la tabla articulos
     *
     * @return array Array con los registros
     */
    public function consultarArticulos()
    {
        $this->db->conectar();
        $sql = "SELECT codigo,articulo FROM articulos";
        $resul = $this->db->ejecutarSQL($sql)->fetchAll(PDO::FETCH_ASSOC);
        $this->db->desconectar();
        return $resul;
    }
}
