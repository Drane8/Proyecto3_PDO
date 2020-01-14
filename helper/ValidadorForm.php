<?php

/**
 * Esta clase se encarga de validar los datos
 */
class ValidadorForm
{
	private $errores;
	private $reglasValidacion;
	private $valido;

	/**
	 * Constructor de la clase ValidadorForm
	 */
	public function construct()
	{
		$this->errores = array();
		$this->reglasValidacion = null;
		$this->valido = false;
	}

	/**
	 * Funcion que recibe datos y reglas y hace uso de ambos
	 * para validar los datos. Y actualiza el estado de validez
	 *
	 * @param array $fuentes: Los datos a validar
	 * @param array $reglasValidacion: Las reglas a seguir para las validaciones
	 * 
	 */
	public function validar(array $fuentes, array $reglasValidacion)
	{
		foreach ($reglasValidacion as $campo => $reglas) {
			if (isset($fuentes[$campo])) {
				if (isset($reglas["min"]) && $fuentes[$campo] < $reglas["min"]) {
					$this->addError($campo, "error, $campo tiene que ser mayor o igual que " . $reglas['min']);
				}
				if (isset($reglas["max"]) && $fuentes[$campo] > $reglas["max"]) {
					$this->addError($campo, "error, $campo tiene que ser menor o igual que " . $reglas['max']);
				}
				if (isset($reglas["fechaMax"]) && (strtotime($fuentes[$campo]) - strtotime($reglas["fechaMax"])) > 0) {
					$this->addError($campo, "error, la fecha tiene que ser igual o anterior al dia actual");
				}
				if (isset($reglas['maxCaracteres']) && strlen($fuentes[$campo]) >= $reglas['maxCaracteres']) {
					$this->addError($campo, "error, $campo no puede exceder los " . $reglas['maxCaracteres'] . "caracteres");
				}
				if (isset($reglas["required"]) && !empty($fuentes[$campo]) != $reglas["required"]) {
					$this->addError($campo, "error, $campo requerido");
				}
			}
		}
		$this->valido = empty($this->errores);
	}

	/**
	 * Añade un error al array de errores
	 *
	 * @param string $nombreCampo: Campo en el que se ha producido el error
	 * @param string $error: Mensaje de error producido
	 */
	public function addError(string $nombreCampo, string $error)
	{
		$this->errores[$nombreCampo] = $error;
	}

	/**
	 * Comprueba si los datos son validos
	 *
	 * @return boolean Devuelve true si los datos son validos, false si no lo son
	 */
	public function esValido()
	{
		return $this->valido;
	}

	/**
	 * Devuelve el array con los errores
	 *
	 * @return array Array que contiene los errores
	 */
	public function getErrores()
	{
		return $this->errores;
	}


	/**
	 * Funcion que devuelve el mensaje de error de un campo especifico
	 * en caso de que exista error
	 *
	 * @param mixed $campo: El campo del que queremos el mensaje de error
	 * @return string Devuelve el mensaje de error en caso de existir
	 */
	public function getMensajeError($campo)
	{
		if (isset($this->errores[$campo])) {
			return $this->errores[$campo];
		}
		return "";
	}
}
