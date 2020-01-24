<?php
class Inventario
{
    private $claveInstalacion;
    private $codigoArticulo;
    private $articulo;
    private $cantidad;
    private $fechaCompra;
    private $observaciones;


    public function __construct($claveInstalacion, $codigoArticulo, $articulo, $cantidad, $fechaCompra = null, $observaciones = "")
    {
        $this->claveInstalacion = $claveInstalacion;
        $this->codigoArticulo = $codigoArticulo;
        $this->articulo = $articulo;
        $this->cantidad = $cantidad;
        $this->fechaCompra = $fechaCompra;
        $this->observaciones = $observaciones;
    }

    /**
     * Devuelve el valor de claveInstalacion
     *
     * @return  mixed Valor de claveInstalacion
     */
    public function getClaveInstalacion()
    {
        return $this->claveInstalacion;
    }

    /**
     * Devuelve el valor de codigoArticulo
     *
     * @return  mixed Valor de codigoArticulo
     */
    public function getCodigoArticulo()
    {
        return $this->codigoArticulo;
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
     * Devuelve el valor de cantidad
     *
     * @return  mixed Valor de cantidad
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Devuelve el valor de fechaCompra
     *
     * @return  mixed Valor de fechaCompra
     */
    public function getFechaCompra()
    {
        return $this->fechaCompra;
    }

    /**
     * Devuelve el valor de observaciones
     *
     * @return  mixed Valor de observaciones
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Cambia el valor de claveInstalacion
     *
     * @param  claveInstalacion : Nuevo valor
     */
    public function setClaveInstalacion($claveInstalacion)
    {
        $this->claveInstalacion = $claveInstalacion;
    }
    
    /**
     * Cambia el valor de codigoArticulo
     *
     * @param  codigoArticulo : Nuevo valor
     */
    public function setCodigoArticulo($codigoArticulo)
    {
        $this->codigoArticulo = $codigoArticulo;
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

    /**
     * Cambia el valor de cantidad
     *
     * @param  cantidad : Nuevo valor
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    /**
     * Cambia el valor de fechaCompra
     *
     * @param  fechaCompra : Nuevo valor
     */
    public function setFechaCompra($fechaCompra)
    {
        $this->fechaCompra = $fechaCompra;
    }

    /**
     * Cambia el valor de observaciones
     *
     * @param  observaciones : Nuevo valor
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }
}
