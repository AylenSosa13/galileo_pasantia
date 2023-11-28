<?php
$conexion = new mysqli("localhost", "root", "", "galileo");


if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM usuario WHERE username = '$username' AND password = '$password'";
$resultado = $conexion->query($query);


if ($resultado->num_rows === 1) {
  
    header("Location: paginaprincipal.php");
    exit;
} else {

    echo "Usuario o contraseña incorrectos. Inténtalo de nuevo.";
}


$conexion->close();
?>
