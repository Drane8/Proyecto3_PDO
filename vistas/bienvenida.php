<?php
include "cabecera.php";
echo "<script>
  document.getElementById('nav_inicio').classList.add('active');
</script>";

?>
<form id="form" action="index.php" method="post">
    <div id="inicio">
        <input type="submit" name="form_insertar" value="Insertar" />
        <br />
        <input type="submit" name="form_consultar" value="Consultar" />
    </div>
</form>
<?php
include "pie.php";
?>