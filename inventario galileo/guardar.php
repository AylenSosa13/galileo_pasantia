<?php
if (isset($_POST["guardarBtn"])) {
    $conexion = new mysqli("localhost", "root", "", "galileo");
   
    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    $nombre_del_producto = isset($_POST["nombre_del_producto"]) ? $_POST["nombre_del_producto"] : "";
    $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : "";
    $fecha_de_la_compra = isset($_POST["fecha_de_la_compra"]) ? $_POST["fecha_de_la_compra"] : "";
    $cantidad = isset($_POST["cantidad"]) ? $_POST["cantidad"] : "";
    $precio_peso_ARG = isset($_POST["precio_peso_ARG"]) ? $_POST["precio_peso_ARG"] : "";
    $precio_dolar = isset($_POST["precio_dolar"]) ? $_POST["precio_dolar"] : "";
    $IVA = isset($_POST["IVA"]) ? $_POST["IVA"] : "";
    $fecha_actualizacion_precio = isset($_POST["fecha_actualizacion_precio"]) ? $_POST["fecha_actualizacion_precio"] : "";
    $proveedor = isset($_POST["proveedor"]) ? $_POST["proveedor"] : "";
    $id = $_POST["fila_id"];
   // echo "-------";$id;

    //$query = "INSERT INTO datos VALUES(NULL,'$nombre_del_producto', '$descripcion','$fecha_de_la_compra','$cantidad', '$precio_peso_ARG','$precio_dolar','$IVA','$fecha_actualizacion_precio','$proveedor')";
    $query = "UPDATE datos 
    SET nombre_del_producto = '$nombre_del_producto', 
        descripcion = '$descripcion', 
        fecha_de_la_compra = '$fecha_de_la_compra', 
        cantidad = $cantidad, 
        precio_peso_ARG = $precio_peso_ARG, 
        precio_dolar = $precio_dolar, 
        IVA = $IVA, 
        fecha_actualizacion_precio = '$fecha_actualizacion_precio', 
        proveedor = '$proveedor'
    WHERE id = $id";
   // $resultado = $conexion->query($query);

    // Ejecutar la consulta
    $resultado = $conexion->query($query);

    // Verificar si la consulta fue exitosa
    if ($resultado === TRUE) {
        echo ".";
    } else {
        echo "Error en la actualización: " . $conexion->error;
    }
    // Cerrar la conexión
    $conexion->close();
}
?>
<head>
<link rel="stylesheet" href="guardar.css">
</head>
<body style="background-image: url(gris.jpg)">
<div class="background-image"></div>
    <div>
        <a href="paginaprincipal.php"><button class="button">Volver</button></a>
    </div>
    <div id="message-text-container">
        <p id="message-text"> SE MODIFICARON LOS DATOS CORRECTAMENTE </p>
    </div>
</body>
