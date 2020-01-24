<?php

class Articulo  
{
    private $codigo;
    private $articulo;

    public function __construct($codigo,$articulo) {
        $this->codigo = $codigo;
        $this->articulo = $articulo;
    }

    /**
     * Devuelve el valor de codigo
     *
     * @return  mixed Valor de codigo
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Devuelve el valor de articulo
     *
     * @return  mixed Valor de articulo
     */
    public function getArticulo()
    {
        return $this->articulo;
    }

    /**
     * Cambia el valor de codigo
     *
     * @param  codigo : Nuevo valor
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * Cambia el valor de articulo
     *
     * @param  articulo : Nuevo valor
     */
    public function setArticulo($articulo)
    {
        $this->articulo = $articulo;
    }
}
