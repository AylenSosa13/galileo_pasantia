<!DOCTYPE html>
<html>
<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <link rel="stylesheet" href="pdf.css">
  <link rel="shortcut icon" href="logoG.png">
</head>
<body>
  <div>
      <a href="paginaprincipal.php" class="button">Volver</a>
  </div>
  <div class="texto">
    <h1>Registro de Productos Galileo</h1>
  </div>
  <center>
    <table border="2">
      <thead>
        <tr>
          <th>Nombre del producto</th>
          <th>Descripcion</th>
          <th>Fecha de la compra </th>
          <th>Cantidad</th>
          <th>Precio peso ARG</th>
          <th>Precio dolar</th>
          <th>IVA</th>
          <th>Fecha de actualizacion de precios</th>
          <th>Proveedor</th>
          
        </tr>
      </thead>
      <tbody>
        <?php
          $conexion = new mysqli("localhost", "root", "", "galileo");
          $query ="SELECT * FROM datos";
          $resultado = $conexion->query($query);
          while($row = $resultado->fetch_assoc()){
        ?>
          <tr>
            <td> <?php echo $row['nombre_del_producto']; ?></td>
            <td> <?php echo $row['descripcion']; ?></td>
            <td> <?php echo $row['fecha_de_la_compra']; ?></td>
            <td> <?php echo $row['cantidad']; ?></td>
            <td> <?php echo $row['precio_peso_ARG']; ?></td>
            <td> <?php echo $row['precio_dolar']; ?></td>
            <td> <?php echo $row['IVA']; ?></td>
            <td> <?php echo $row['fecha_actualizacion_precio']; ?></td>
            <td> <?php echo $row['proveedor']; ?></td>
          </tr>

        <?php
            }
        ?>

      </tbody>
    </table>
    <div class="button-container">
      <button id="btnCrearPdf" class="button">Crear PDF de la Tabla</button>
    </div>
  </center>
  
  
  <script>
  document.addEventListener("DOMContentLoaded", () => {
  const $boton = document.querySelector("#btnCrearPdf");
  $boton.addEventListener("click", () => {
    const $tablaParaConvertir = document.querySelector("table");

    // Duplicar la tabla para mantenerla en el documento original
    const $tablaCopia = $tablaParaConvertir.cloneNode(true);

    // Crear un contenedor div para centrar la tabla
    const $contenedor = document.createElement("div");
    $contenedor.style.display = "flex";
    $contenedor.style.justifyContent = "center";
    $contenedor.style.alignItems = "center";
    $contenedor.style.height = "100%"; // Opcional: Ajusta la altura del contenedor

    // Agregar la tabla duplicada al contenedor
    $contenedor.appendChild($tablaCopia);

    html2pdf()
      .set({
        margin: 10,
        filename: 'tabla.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: "mm", format: "a4", orientation: 'landscape' }
      })
      .from($contenedor) // Ahora convierte el contenedor, que contiene la tabla centrada
      .save()
      .catch(err => console.log(err));
    });
  });

 
  </script>
  <div class="background-image"></div>
</body>
</html>

