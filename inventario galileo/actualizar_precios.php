<?php
// Establecer la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'galileo');
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el valor del dólar ingresado
$valor_dolar = isset($_POST["valor_dolar"]) ? floatval($_POST["valor_dolar"]) : 0;

// Obtener los precios en pesos argentinos de la base de datos
$query = "SELECT id, precio_peso_ARG FROM datos";
$result = $conexion->query($query);

// Verificar que $result sea válido
if ($result) {
    $precios_peso_ARG = [];
    while ($row = $result->fetch_assoc()) {
        $precio = floatval($row['precio_peso_ARG']);
        $id = $row['id'];
        $nuevo_precio = $precio * $valor_dolar;
        // Actualizar el precio en la base de datos
        $query = "UPDATE datos SET precio_peso_ARG = $nuevo_precio WHERE id = $id";
        $conexion->query($query);
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();

// Redirigir a la página principal
header('Location: paginaprincipal.php');
exit();
?>
