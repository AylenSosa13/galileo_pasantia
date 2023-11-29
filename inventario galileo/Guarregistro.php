<!DOCTYPE html>
<head>
    <title> Index de Imagenes </title>
    <link rel="stylesheet" href="./css/estilogu.css">
    
</head>

<body>
    <div class="background-image"></div>
    <div class="button-container">
      <a href="index.php" class="button">Volver</a>
    </div>
    <div id="message-text-container">
        <p id="message-text"> Registro completado </p>
    </div>

    <?php
    $conexion = new mysqli("localhost", "root", "", "galileo");

    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        
        $query = "INSERT INTO usuario (username, password) VALUES ('$username', '$password')";

        if ($conexion->query($query) === TRUE) {
        
            echo "";
        } else {
            
            echo "Error al guardar los datos: " . $conexion->error;
        }
    }

    $conexion->close();
    ?>
</body>
</html>