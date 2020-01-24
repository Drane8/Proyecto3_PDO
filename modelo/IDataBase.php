<?php

interface IDatabase{
    function conectar();
    function desconectar();
    function ejecutarSQL($sql);
    function ejecutarSQLActualizacion($sql,$args);
}