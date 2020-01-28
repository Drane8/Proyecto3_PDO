<?php
include "cabecera.php";
echo "<script>
  document.getElementById('nav_consultar').classList.add('active');
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
    <select id="aulaC" name="aulas[]" required multiple>
      <?php
      foreach ($instalaciones as $instalacion) {
        $clave = $instalacion->getClave();
        echo "<option value='$clave' ";
        //COMPROBAR
        echo Utilidades::verificarListaMultiple(Input::get("aulas"), $clave);
        echo "> $clave</option>";
      }
      ?>
      <div id="botones">
        <input type="submit" name="consultar" value="<?php echo $fase ?>" /><input type="reset" value="Limpiar" />
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