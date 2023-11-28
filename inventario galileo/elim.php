<!DOCTYPE html>
<html>
<head>
  <title>Administración</title>
  <link rel="stylesheet" type="text/css" href="stylesadmin.css">
  <script src="html2pdf.bundle.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="modificarpro.css"><!--link a la pagina de css-->
</head>
<body style="background-image: url(gris.jpg);"><!--imagen de fondo-->
    <div>
        <a href="paginaprincipal.php"><button class="button">Volver</button></a><!--boton volver a la pagina principal-->
    </div>
    <div class="background-image"></div>

<?php
if (isset($_POST['eliminar'])) {
 $conexion = new mysqli("localhost", "root", "", "galileo");
 if ($conexion->connect_error) {
    die("La conexion falló: " . $conexion->connect_error);
 }
 foreach ($_POST['eliminar'] as $id) {
    $sql = "DELETE FROM datos WHERE id='$id'";
    if ($conexion->query($sql) === TRUE) {
      echo "Record eliminado correctamente";
    } else {
      echo "Error eliminando el registro: " . $conexion->error;
    }
 }
 $conexion->close();
}
?>

<div class="background-image"></div>
    <div>
        <a href="paginaprincipal.php"><button class="button">Volver</button></a>
    </div>
    <div id="message-text-container">
        <p id="message-text"> SE ELIMINARON LOS DATOS CORRECTAMENTE </p>
    </div>
<?php //conexon a la base de datos para eliminar el dato elegido
$conexion = new mysqli("localhost", "root", "", "galileo");
$id = $_REQUEST['id']; 
$query = "DELETE FROM datos WHERE id = '$id'";
$resultado = $conexion->query($query);
?>
</body>
</html>

