<?php
//carga de clases 
function miautoCargador($clase) {

    $paths = array( "controladores", "helper","modelo");

    // Buscamos en cada ruta los archivos
    foreach ($paths as $path) {
        if (file_exists("$path/$clase.php"))
            require_once( "$path/$clase.php" );
    }
}

spl_autoload_register('miautocargador');

define("DB_SERVER","localhost");
define("DB_NAME","inventario_daid_p3");
define("DB_USER","alumno");
define("DB_PASS","alumno");







