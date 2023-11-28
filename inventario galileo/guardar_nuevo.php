<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar</title>
    <link rel="stylesheet" href="guardar.css">
</head>
<body>
    <?php
        $conexion = new mysqli("localhost", "root", "", "galileo");
        $nombre_del_producto = $_POST['nombre_del_producto'];
        $descripcion = $_POST['descripcion'];
        $fecha_de_la_compra = $_POST['fecha_de_la_compra'];
        $cantidad = $_POST['cantidad'];
        $precio_peso_ARG = $_POST['precio_peso_ARG'];
        $precio_dolar = $_POST['precio_dolar'];
        $IVA = $_POST['IVA'];
        $fecha_actualizacion_precio = $_POST['fecha_actualizacion_precio'];
        $proveedor = $_POST['proveedor'];

        $query = "INSERT INTO datos VALUES(NULL,'$nombre_del_producto', '$descripcion','$fecha_de_la_compra','$cantidad', '$precio_peso_ARG','$precio_dolar','$IVA','$fecha_actualizacion_precio','$proveedor')";
        $resultado = $conexion->query($query);
    ?>
    <div class="background-image"></div>
    <div>
        <a href="paginaprincipal.php"><button class="button">Volver</button></a>
    </div>
    <div id="message-text-container">
        <p id="message-text"> SE GUARDO </p>
    </div>
</body>
</html>