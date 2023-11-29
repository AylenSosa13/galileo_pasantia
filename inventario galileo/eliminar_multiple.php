<!DOCTYPE html>
<html>
<head>
 <title>Administración</title>
 <link rel="stylesheet" type="text/css" href="stylesadmin.css">
 <script src="html2pdf.bundle.min.js"></script>
 <link rel="stylesheet" href="style.css">
</head>
<body style="background-image: url(gris.jpg);"><!--imagen de fondo-->
    <div>
        <a href="paginaprincipal.php"><button class="button">Volver</button></a><!--boton volver a la pagina principal-->
    </div>
    <div class="background-image"></div>
    <?php
// Establece una conexión con la base de datos
$conexion = new mysqli("localhost", "root", "", "galileo");

// Comprueba si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Elimina los registros seleccionados
    if (isset($_POST["eliminar"]) && is_array($_POST["eliminar"])) {
        $idsToDelete = implode(",", $_POST["eliminar"]);
        $query = "DELETE FROM datos WHERE id IN ($idsToDelete)";
        $conexion->query($query);
    }
}
?>

<div id="message-text-container"><!--mensaje cuando se elimina el dato-->
    <p id="message-text"> El dato se elimino correctamente</p>
</div>
</body>
</html>