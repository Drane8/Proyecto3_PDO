<?php
//carga de clases 
function miautoCargador($clase) {

    $paths = array( "controladores", "helper");

    // Buscamos en cada ruta los archivos
    foreach ($paths as $path) {
        if (file_exists("$path/$clase.php"))
            require_once( "$path/$clase.php" );
    }
}

spl_autoload_register('miautocargador');







