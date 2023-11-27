<!DOCTYPE html>
<html>
<head>
    <title>Tabla con Checkpoints</title>
</head>
<body>
    <?php
        // Conectarse a la base de datos
        $conexion = new mysqli("localhost", "root", "", "nombre_base_datos");

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error en la conexión: " . $conexion->connect_error);
        }

        // Obtener los datos de la base de datos
        $sql = "SELECT * FROM tabla";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            echo "<form action='eliminar.php' method='post'>";
            echo "<table>";
            echo "<tr>";
            echo "<th>Valor 1</th>";
            echo "<th>Valor 2</th>";
            echo "<th>Valor 3</th>";
            echo "<th>Eliminar</th>";
            echo "</tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['valor1'] . "</td>";
                echo "<td>" . $row['valor2'] . "</td>";
                echo "<td>" . $row['valor3'] . "</td>";
                echo "<td><input type='checkbox' name='eliminar[]' value='" . $row['id'] . "'></td>";
                echo "</tr>";
            }

            echo "</table>";
            echo "<input type='submit' value='Eliminar'>";
            echo "</form>";
        } else {
            echo "No se encontraron registros.";
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();
    ?>
</body>
</html>