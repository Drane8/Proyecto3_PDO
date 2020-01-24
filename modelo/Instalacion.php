<?php

class Instalacion
{
    private $clave;
    private $instalacion;

    public function __construct($clave,$instalacion) {
        $this->clave = $clave;
        $this->instalacion = $instalacion;
    }

    /**
     * Devuelve el valor de clave
     *
     * @return  mixed Valor de clave
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Devuelve el valor de instalacion
     *
     * @return  mixed Valor de instalacion
     */
    public function getInstalacion()
    {
        return $this->instalacion;
    }

    /**
     * Cambia el valor de clave
     *
     * @param  clave : Nuevo valor
     */
    public function setClave($clave)
    {
        $this->clave = $clave;
    }

    /**
     * Cambia el valor de instalacion
     *
     * @param  instalacion : Nuevo valor
     */
    public function setInstalacion($instalacion)
    {
        $this->instalacion = $instalacion;
    }
}
