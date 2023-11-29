<?php
// Establecer la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'galileo');
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el valor del dólar ingresado
$valor_dolar = isset($_POST["valor_dolar"]) ? floatval($_POST["valor_dolar"]) : 0;

// Actualizar los precios en pesos argentinos en la base de datos
$query = "UPDATE datos SET precio_peso_ARG = precio_peso_ARG * $valor_dolar";
$conexion->query($query);

// Obtener el precio actual en pesos ARG
$query = "SELECT SUM(precio_peso_ARG) as total FROM datos";
$result = $conexion->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $precio_peso_arg = floatval($row['total']);
} else {
    $precio_peso_arg = 0;
}

// Guardar el precio actual en la sesión
$_SESSION['precio_peso_arg'] = $precio_peso_arg;

// Initialize $nuevo_valor and $valor_anterior with appropriate values
$nuevo_valor = isset($_POST['nuevo_valor']) ? floatval($_POST['nuevo_valor']) : 0;
$valor_anterior = isset($_SESSION['valor_anterior']) ? floatval($_SESSION['valor_anterior']) : 0;

if ($nuevo_valor > $valor_anterior) {
    // Calcular la diferencia y sumarla al precio actual en pesos ARG
    $diferencia = $nuevo_valor - $valor_anterior;
    $_SESSION['precio_peso_arg'] += $diferencia;
} elseif ($nuevo_valor < $valor_anterior) {
    // Calcular la diferencia y restarla al precio actual en pesos ARG
    $diferencia = $valor_anterior - $nuevo_valor;
    $_SESSION['precio_peso_arg'] -= $diferencia;

    // Verificar si se ha ingresado un nuevo valor del dólar
    if (isset($_POST['valor_dolar'])) {
        $nuevo_valor_dolar = floatval($_POST['valor_dolar']);

        // Guardar el nuevo valor del dólar en la sesión
        $_SESSION['valor_dolar_anterior'] = $nuevo_valor_dolar;

        // Multiplicar el valor del dólar por el precio actual en pesos ARG
        $_SESSION['precio_peso_arg'] = $nuevo_valor_dolar * $precio_peso_arg;
    }
}

// Guardar el valor del dólar en la sesión
$_SESSION['valor_dolar'] = $valor_dolar;

// Guardar el nuevo valor en la sesión
$_SESSION['valor_anterior'] = $nuevo_valor;

// Cerrar la conexión a la base de datos
$conexion->close();

// Redirigir a la página principal
header('Location: paginaprincipal.php');
exit();
?>
