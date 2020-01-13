<?php

/**
 * Esta clase se encarga de validar los datos
 */
class ValidadorForm
{
	private $errores;
	private $reglasValidacion;
	private $valido;

	public function construct()
	{
		$this->errores = array();
		$this->reglasValidacion = null;
		$this->valido = false;
	}

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
				if (isset($reglas["fechaMax"]) && date_diff($fuentes[$campo], $reglas["fechaMax"]) < 0) {
					$this->addError($campo, "error, la fecha de $campo tiene que ser igual o anterior al dia actual");
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

	public function addError(string $nombreCampo, string $error)
	{
		$this->errores[$nombreCampo] = $error;
	}

	public function esValido()
	{
		return $this->valido;
	}

	public function getErrores()
	{
		return $this->errores;
	}


	public function getMensajeError($campo)
	{
		if (isset($this->errores[$campo])) {
			return $this->errores[$campo];
		}
		return "";
	}
}
