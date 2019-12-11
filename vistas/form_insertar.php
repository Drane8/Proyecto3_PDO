<?php
include "cabecera.php";
echo "<script>
  document.getElementById('nav_insertar').classList.add('active');
</script>";
$aulas = array('A04', 'A05', 'A06', 'A13', 'A17', 'C12');
$articulos = array(
    array(
        'codigo' => '110',
        'articulo' => 'ORDENADOR PC'
    ),
    array(
        'codigo' => '120',
        'articulo' => 'ORDENADOR SERVIDOR RED'
    ),
    array(
        'codigo' => '130',
        'articulo' => 'OTROS-ORDENADORES'
    ),
    array(
        'codigo' => '210',
        'articulo' => 'IMPRESORAS LASER'
    ),
    array(
        'codigo' => '211',
        'articulo' => 'IMPRESORAS MATRICIAL'
    ),
    array(
        'codigo' => '212',
        'articulo' => 'IMPRESORAS CHORRO DE TINTA'
    )

);
?>
<form id="form" action="index.php" method="post">
    <div id="datos">
        <select id="aula" name="aula" required>
            <option value="" class="oculto">--SELECCIONE AULA--</option>
            <?php
            foreach ($aulas as $aula) {
                echo "<option value='$aula'>$aula</option>";
            }
            ?>
        </select>
        <select id="articulo" name="articulo" required>
            <option value="" class="oculto">--SELECCIONE ARTICULO--</option>
            <?php
            foreach ($articulos as $articulo) {
                echo "<option value='" . $articulo['codigo'] . "|" . $articulo['articulo'] . "'>" . $articulo['articulo'] . "</option>";
            }
            ?>
        </select>
        <label for="cantidadArticulos">Cantidad de articulos: </label><br />
        <input type="range" min="1" value="1" id="cantidadArticulos" name="cantidadArticulos" oninput="valorRango.value = this.value">
        <output id="valorRango">1</output><br />
        <label for="fecha">Fecha compra: </label>
        <input type="date" id="fecha" name="fecha" /><br />
        <label for="observaciones">Observaciones:</label><br />
        <textarea id="observaciones" name="observaciones" rows="6" cols="40" maxlength="250"></textarea><br />
        <div id="botones">
            <input type="submit" name="insertar" value="Añadir" /><input type="reset" value="Limpiar" />
        </div>
    </div>
</form>
<?php
include "pie.php";
?>