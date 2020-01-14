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
            echo "<p>$mensajeError</p>\n";
            unset($_POST[$campo]);
        }
        echo "</div>";
    }
}

//ENTRADAS
?>
<form id="form" action="index.php" method="post">
    <div id="datos">
        <select id="aula" name="aula" required>
            <option value="" class="oculto">--SELECCIONE AULA--</option>
            <?php
            foreach ($aulas as $aula) {
                if (Input::get('aula') == $aula['clave_instalacion']) {
                    echo "<option value='" . $aula['clave_instalacion'] . "' selected>" . $aula['clave_instalacion'] . "</option>";
                } else {
                    echo "<option value='" . $aula['clave_instalacion'] . "'>" . $aula['clave_instalacion'] . "</option>";
                }
            }
            ?>
        </select>
        <select id="articulo" name="articulo" required>
            <option value="" class="oculto">--SELECCIONE ARTICULO--</option>
            <?php
            foreach ($articulos as $articulo) {
                if (Input::get('articulo') == $articulo['codigo'] . "|" . $articulo['articulo']) {
                    echo "<option value='" . $articulo['codigo'] . "|" . $articulo['articulo'] . "' selected>" . $articulo['articulo'] . "</option>";
                } else {
                    echo "<option value='" . $articulo['codigo'] . "|" . $articulo['articulo'] . "'>" . $articulo['articulo'] . "</option>";
                }
            }
            ?>
        </select>
        <label for="cantidadArticulos">Cantidad de articulos: </label><br />
        <input type="range" min="1" value="<?php echo Input::get('cantidadArticulos') ?>" id="cantidadArticulos" name="cantidadArticulos" oninput="valorRango.value = this.value">
        <output id="valorRango"><?php echo Input::get('cantidadArticulos') ?></output><br />
        <label for="fecha">Fecha compra: </label>
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
    echo "<div class='texto' />";
    echo $resultado;
    echo "</div>";
}
include "pie.php";
?>