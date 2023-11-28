<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $valor_dolar = $_POST['valor_dolar'];

  // Obtener todos los precios en pesos argentinos
  $conexion = new mysqli("localhost", "root", "", "galileo");
  $query = "SELECT precio_peso_ARG FROM datos";
  $resultado = $conexion->query($query);
  $precios_peso_ARG = [];
  while ($row = $resultado->fetch_assoc()) {
    $precios_peso_ARG[] = $row['precio_peso_ARG'];
  }

  // Calcular la diferencia para cada precio en pesos argentinos
  $precios_actualizados = [];
  foreach ($precios_peso_ARG as $precio) {
    $diferencia = $precio * ($valor_dolar - 1);
    $nuevo_precio_peso_ARG = $precio + $diferencia;
    $precios_actualizados[] = $nuevo_precio_peso_ARG;
  }

  // Actualizar todos los precios en la base de datos
  foreach ($precios_actualizados as $indice => $nuevo_precio) {
    $query = "UPDATE datos SET precio_peso_ARG = $nuevo_precio WHERE id = $indice +1";
    $conexion->query($query);
  }

  // Redirigir a la página principal
  header('Location: paginaprincipal.php');
  exit();
}
?>