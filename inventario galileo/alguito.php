<!DOCTYPE html>
<html>
<head>
  <title>Administración</title>
  <link rel="stylesheet" type="text/css" href="stylesadmin.css">
  <script src="html2pdf.bundle.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <script>
    function confirmarBorrado(id) {
      var confirmacion = confirm("¿Estás seguro que quieres borrar este dato?");
      if (confirmacion) {
        // Si el usuario presiona "Aceptar", se borra el dato
        window.location.href = "elim.php?id=" + id;
      }
    }
  </script>
</head>
<body>
  <!-- Resto del código... -->
  <table id="dataTable">
    <thead>
      <tr>
        <th>Nombre del producto</th>
        <th>Descripcion</th>
        <th>Fecha de la compra</th>
        <th>Cantidad</th>
        <th>Precio peso ARG</th>
        <th>Precio Dolar</th>
        <th>IVA</th>
        <th>fecha actualizacion del precio</th>
        <th>proveedor</th>
        <th colspan="2">Operaciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // ... Tu código PHP para recuperar datos de la base de datos ...

      while ($row = $resultado->fetch_assoc()) {
      ?>
        <tr>
          <!-- ... Tu código PHP para mostrar datos en la tabla ... -->
          <th><a href="#" onclick="confirmarBorrado(<?php echo $row['id']; ?>)">Eliminar</a></th>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
  <!-- Resto del código... -->
</body>
</html>
