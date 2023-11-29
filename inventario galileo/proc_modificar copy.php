<html>
<head><!--encabezado-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificado Exitoso</title>
    <link rel="stylesheet" href="modificarpro.css"><!--link a la pagina de css-->
    <link rel="shortcut icon" href="logoG.png"><!--link al logo de la pestaña-->
</head>
    <body>
    <?php //conexion a la base de datos 
        $conexion = new mysqli("localhost", "root", "", "galileo");
        $id = $_REQUEST['id']; 
        $nombre_del_producto = $_POST['nombre_del_producto'];
        $descripcion = $_POST['descripcion'];
        $fecha_de_la_compra = $_POST['fecha_de_la_compra'];
        $cantidad = $_POST['cantidad'];
        $precio_peso_ARG = $_POST['precio_peso_ARG'];
        $precio_dolar = $_POST['precio_dolar'];
        $IVA = $_POST['IVA'];
        $fecha_actualizacion_precio = $_POST['fecha_actualizacion_precio'];
        $proveedor = $_POST['proveedor'];
        $query = "UPDATE datos SET nombre_del_producto='$nombre_del_producto', descripcion='$descripcion', fecha_de_la_compra='$fecha_de_la_compra',cantidad='$cantidad',precio_peso_ARG='$precio_peso_ARG',precio_dolar='$precio_dolar',IVA='$IVA',fecha_actualizacion_precio='$fecha_actualizacion_precio',proveedor='$proveedor' WHERE id = '$id'";
        $resultado = $conexion->query($query);
    ?>
        <div>
            <a href="paginaprincipal.php"><button class="button">Volver</button></a><!--boton para volver a la pagina principal-->
        </div>
        <div class="background-image"></div>

        <div id="message-text-container"> <!--mensaje cuando se modifican los datos-->
            <p id="message-text"> El dato se modifico correctamente</p>
        </div>
    </body>
</html>

