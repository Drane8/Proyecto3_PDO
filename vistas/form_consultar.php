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
if(isset($errorInserccion)){
    echo "<div class='errores'>El aula no tiene entradas existentes</div>";   
}

//ENTRADAS
?>
<form id="form" action="index.php" method="post">
  <div class="datos">
    <div class="container">
      <div class="selectionator">
        <span class="search">
          <span class="shadow"></span>
          <span class="overlay"></span>
          SELECCIONE AULA
        </span>
        <div class="menu">
          <ul class="optgroup">
            <?php
            foreach ($instalaciones as $instalacion) {
              $clave = $instalacion->getClave();
              echo "<li><input type='checkbox' name='aulas[]' value='$clave' id='$clave'";
              //COMPROBAR
              echo Utilidades::verificarCheckbox(Input::get("aulas"), $clave);
              echo "/> <label for='$clave'>$clave</label></li>";
            }
            echo "<li><input type='checkbox' name='aulas[]' value='' id='vacio' checked/></li>"
            ?>
          </ul>
        </div>
      </div>
    </div>
      <div id="botones">
        <input type="submit" name="consultar" value="<?php echo $fase ?>" /><input type="reset" value="Limpiar" />
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