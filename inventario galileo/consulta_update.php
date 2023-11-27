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

     // Construir la consulta SQL
     $query = "UPDATE datos SET
     nombre_del_producto = '$nombre_del_producto',
     descripcion = '$descripcion',
     fecha_de_la_compra = '$fecha_de_la_compra',
     cantidad = '$cantidad',
     precio_peso_ARG = '$precio_peso_ARG',
     precio_dolar = '$precio_dolar',
     IVA = '$IVA',
     fecha_actualizacion_precio = '$fecha_actualizacion_precio',
     proveedor = '$proveedor'
   WHERE id = tu_condicion_para_identificar_el_registro_a_actualizar";

    // Ejecutar la consulta
    $resultado = $conexion->query($query);

    // Verificar si la consulta fue exitosa
    if ($resultado === TRUE) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error en la inserción: " . $conexion->error;
    }
    // Cerrar la conexión
    $conexion->close();
}
?>

<div class="background-image"></div>
<div>
    <a href="paginaprincipal.php"><button class="button">Volver</button></a>
</div>
