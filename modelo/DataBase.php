<?php

class Database implements IDatabase
{
    private $conexion;

    public function conectar()
    {
        try {
            $this->conexion = new PDO("mysql:host=" . DB_SERVER . ";dbname=" .
                DB_NAME, DB_USER, DB_PASS);
            // Se puede configurar el objeto 
            $this->conexion->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $this->conexion->exec("set names utf8mb4");
            return ($this->conexion);
        } catch (PDOException $e) {
            echo " <p>Error: " . $e->getMessage() . "</p>\n";
            exit();
        }
    }

    public function desconectar()
    {
        $this->conexion = null;
    }

    public function ejecutarSQL($sql)
    {
        //El metodo query supone una vulnerabilidad
        $resul = $this->conexion->query($sql);
        if (!$resul) {
            $resul = "Error en la consulta";
        }

        return $resul;
    }

    public function ejecutarSQLActualizacion($sql, $args)
    {
        $resul = $this->conexion->prepare($sql);
        $resul->execute($args);
        $mensaje = "Accion ejecutada correctamente";
        if (!$resul) {
            $mensaje = "Hubo un problema al realizar la accion";
        }

        return $mensaje;
    }
}
