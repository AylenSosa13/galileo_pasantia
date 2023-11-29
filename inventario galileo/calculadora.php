<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IVA</title>
</head>
<body>
    <h1>Calculadora de IVA</h1>

    <?php
    // Function to calculate total price including VAT
    function calcularIVA($precioDolar, $tipoCambio, $porcentajeIVA) {
        // Calcular el precio total en pesos argentinos
        $precioPesos = $precioDolar * $tipoCambio;

        // Aplicar el IVA al precio en pesos
        $ivaMultiplier = 1 + ($porcentajeIVA / 100);
        $precioTotal = $precioPesos * $ivaMultiplier;

        return $precioTotal;
    }

    // Variables
    $precioDolar = isset($_POST['precio_dolar']) ? floatval($_POST['precio_dolar']) : 0;
    $tipoCambio = isset($_POST['tipo_cambio']) ? floatval($_POST['tipo_cambio']) : 1;
    $porcentajeIVA = isset($_POST['iva']) ? floatval($_POST['iva']) : 0;

    // Calcular el precio total incluyendo IVA
    $precioTotal = calcularIVA($precioDolar, $tipoCambio, $porcentajeIVA);
    ?>

    <form action="" method="post">
        <label for="precio_dolar">Precio en dólares:</label>
        <input type="number" step="0.01" name="precio_dolar" required>

        <label for="tipo_cambio">Tipo de cambio:</label>
        <input type="number" step="0.01" name="tipo_cambio" value="1" required>

        <label for="iva">Seleccione el IVA:</label>
        <select name="iva">
            <option value="0">0%</option>
            <option value="10.5">10.5%</option>
            <option value="21">21%</option>
            <!-- Add more options as needed -->
        </select>

        <button type="submit">Calcular</button>
    </form>

    <?php
    // Mostrar el resultado si se enviaron los datos del formulario
    if ($precioDolar > 0) {
        echo "<p>Precio en dólares: $ {$precioDolar}</p>";
        echo "<p>Tipo de cambio: $ {$tipoCambio}</p>";
        echo "<p>IVA ({$porcentajeIVA}%): $ " . number_format(($precioTotal - $precioDolar * $tipoCambio), 2) . "</p>";
        echo "<p>Precio total incluyendo IVA: $ " . number_format($precioTotal, 2) . "</p>";
    }
    ?>
</body>
</html>
