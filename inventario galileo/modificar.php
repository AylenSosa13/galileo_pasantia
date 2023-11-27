<!DOCTYPE html>
<html>
<head><!--encabezado-->
  <title>Administración</title>
  <link rel="stylesheet" type="text/css" href="stylesadmin.css"><!--link a la pagina de css-->
  <script src="html2pdf.bundle.min.js"></script><!--link para hacer el pdf-->
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav><!--navar-->
    <div class="navbar">
        <div class="navbar-left">
        <div class="hospital-icon"></div><!--logo de galileo-->
            <div class="hospital-name">Inventario Galileo - Modificar productos</div>
        </div>
    <div class="button-container">
      <a href="paginaprincipal.php" class="button">Volver</a>
    </div>
    </nav>
    <br>
    <br>
    <br>
</div>
<center><!-- tabla de la pagina principal -->
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
            <th colspan="1">Operaciones</th><!-- boton de eliminar -->
          </tr>
        </thead>
        <!-- conexion a la base de datos para la extraccion de datos-->
        <?php
        $conexion = new mysqli("localhost", "root", "", "galileo");
        $id = $_GET["id"];
        $query = "SELECT * FROM datos WHERE ID = $id ";
        $resultado = $conexion->query($query);
        while($row = $resultado->fetch_assoc()){
          ?><!----------------------------------------------------------------------------------------------------------------------->
            <form action="guardar.php" method="POST">
              <tr>
                <td><input type="text" required name="nombre_del_producto" value="<?php echo $row['nombre_del_producto']; ?>" /></td>
                <td><input type="text" required name="descripcion" value="<?php echo $row['descripcion']; ?>" /></td>
                <td><input type="date" required name="fecha_de_la_compra" value="<?php echo $row['fecha_de_la_compra']; ?>" /></td>
                <td><input type="text" required name="cantidad" value="<?php echo $row['cantidad']; ?>" /></td>
                <td><input type="text" required name="precio_peso_ARG" value="<?php echo $row['precio_peso_ARG']; ?>" /></td>
                <td><input type="text" required name="precio_dolar" value="<?php echo $row['precio_dolar']; ?>" /></td>
                <td><input type="text" required name="IVA" value="<?php echo $row['IVA']; ?>" /></td>
                <td><input type="date" required name="fecha_actualizacion_precio" value="<?php echo $row['fecha_actualizacion_precio']; ?>" /></td>
                <td><input type="text" required name="proveedor" value="<?php echo $row['proveedor']; ?>" /></td>
                <input type="hidden" name="fila_id" value="<?php echo $row['id']; ?>">
                <td><input type="submit" class="button" name="guardarBtn" value="Guardar"></td>
              </tr>
            </form>
          <?php
              }
          ?>
    </table>
</center>
<div class="background-image"></div>

  <script src="scriptadmin.js"></script>
</html>
