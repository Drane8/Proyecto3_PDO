<?php
include "cabecera.php";
echo "<script>
  document.getElementById('nav_insertar').classList.add('active');
</script>";

//ERRORES
if (Input::siEnviado("post")) {
    $errores = $validador->getErrores();
    if (!empty($errores)) {
        echo "<div class='errores'>";
        foreach ($errores as $campo => $mensajeError) {
            echo "$mensajeError<br/>";
            unset($_POST[$campo]);
        }
        echo "</div>";
    }
}
if (isset($errorInserccion)) {
    echo "<div class='errores'>Ya existe una entrada con esas claves en la base de datos </div>";
}

//ENTRADAS
?>
<form id="form" action="index.php" method="post">
    <div class="datos">
        <select id="aula" name="aula" required>
            <option value="" class="oculto">--SELECCIONE AULA--</option>
            <?php
            foreach ($instalaciones as $instalacion) {
                $clave = $instalacion->getClave();
                echo "<option value='$clave'";
                echo Utilidades::verificarLista(Input::get("aula"), $clave);
                echo "> $clave</option>";
            }
            ?>
        </select>
        <select id="articulo" name="articulo" required>
            <option value="" class="oculto">--SELECCIONE ARTICULO--</option>
            <?php
            foreach ($articulos as  $articulo) {
                $codigo = $articulo->getCodigo();
                $nombre = $articulo->getArticulo();
                echo "<option value='$codigo|$nombre'";
                echo Utilidades::verificarLista(Input::get("articulo"), "$codigo|$nombre");
                echo "> $nombre</option>";
            }
            ?>
        </select>
        <label for="cantidadArticulos">Cantidad de articulos: </label><br />
        <div class="range">
            <div class="range-slider">
                <span id="rs-bullet" class="rs-label">1</span>
                <input type="range" min="1" value="<?php echo Input::get('cantidadArticulos') ?>" id="cantidadArticulos" name="cantidadArticulos" class="rs-range">

            </div>

            <div class="box-minmax">
                <span>1</span><span>100</span>
            </div>
        </div>
        <!-- <input type="range" min="1" value="<?php echo Input::get('cantidadArticulos') ?>" id="cantidadArticulos" name="cantidadArticulos" oninput="valorRango.value = this.value">
        <output id="valorRango"><?php echo Input::get('cantidadArticulos') ?></output>$_COOKIE--><br />
        <label for="fecha">Fecha compra: </label><br/>
        <input type="date" id="fecha" name="fecha" value="<?php echo Input::get('fecha') ?>" /><br />
        <label for="observaciones">Observaciones:</label><br />
        <textarea id="observaciones" name="observaciones" rows="6" cols="40" maxlength="250"><?php echo Input::get('observaciones') ?></textarea><br />
        <div id="botones">
            <input type="submit" name="insertar" value="<?php echo $fase ?>" /><input type="reset" value="Limpiar" />
        </div>
    </div>
</form>

<?php
//SALIDAS
if (isset($resultado)) {
    echo "<div class='resultado' />";
    echo $resultado;
    echo "</div>";
}
include "pie.php";
?>