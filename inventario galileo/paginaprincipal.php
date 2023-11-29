<!DOCTYPE html>
<html>
<head><!----------------------------------------------encabezado------------------------------------------------------------------->
  <title>Administración</title>
  <link rel="stylesheet" type="text/css" href="stylesadmin.css"><!---link a la pagina de css-->
  <script src="html2pdf.bundle.min.js"></script><!--link para hacer el pdf-->
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav><!--------------------------------------------navar----------------------------------------------------------------------->
    <div class="navbar" style="background-image: url(logoG.png)">
        <div class="navbar-left">
        <div class="hospital-icon"></div><!--logo de galileo-->
            <div class="hospital-name">Inventario Galileo - Administracion</div>
        </div>
        <button style="background-color: rgb(31, 182, 132);position: relative;padding: 5px;margin: 10px;font-size: 16px;cursor: pointer;border: none;background-color: rgba(44, 109, 42, 0.842);color: #ffffff;text-decoration: none;transition: background-color 0.3s, color 0.3s;" onclick="logout()">Logout</button>
        <script>
          function logout() {
            // Actualizar la URL actual y eliminar el historial
            window.history.pushState({}, '', 'index.php');

            // Redirigir al usuario a la página de logout
            window.location.replace("index.php");
        }
        </script>
    </nav><!----------------------------------------------------------------------------------------------------------------------->
  <label style="margin-left:10px"for="filtro">Filtrar por:</label><!--------------------Lista desplegable de opciones de filtrado-------------------------->
  <select id="filtro">
    <option value="todos">Todo</option>
    <option value="nombre_del_producto">Nombre del producto</option>
    <option value="descripcion">Descripcion</option>
    <option value="fecha_de_la_compra">Fecha de la compra</option>
    <option value="cantidad">Cantidad</option>
    <option value="precio_peso_ARG">Precio Peso ARG</option>
    <option value="precio_dolar">Precio Dolar</option>
    <option value="IVA">IVA</option>
    <option value="fecha_actualizacion_precio">Fecha Actualizacion Precio</option>
    <option value="proveedor">Proveedor</option>
  </select><!---------------------------------------------------------------------------------------------------------------------->
  <input type="text" class="btn" id="filtroInput" placeholder="Ingrese el valor de filtrado"><!-- Cuadro de entrada para filtrar -->
  <a href="hacerpdf.php" class="boton">Crear PDF</a><!--------------------------------------Crear PDF------------------------------>
  <div class="dolar" style="display: inline-flex;margin-left: 250px;"><!---------------------Dolres-------------------------------->
</div><!--------------------------------------------------------------------------------------------------------------------------->
  <center><!-----------------------------------------------------tabla de la pagina principal-------------------------------------->
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
          <th colspan="3">Operaciones</th><!-- boton de eliminar -->
        </tr>
      </thead>
      <tbody><!-----------------------------------------------conexion a la ase de datos para la extraccion de datos---------------->
        <?php
          $conexion = new mysqli("localhost", "root", "", "galileo");
          $query ="SELECT * FROM datos";
          $resultado = $conexion->query($query);
          while($row = $resultado->fetch_assoc()){
        ?><!----------------------------------------------------------------------------------------------------------------------->
          <tr id="formEliminar" action="elim.php" method="POST">
            <td> <?php echo $row['nombre_del_producto']; ?></td>
            <td> <?php echo $row['descripcion']; ?></td>
            <td> <?php echo $row['fecha_de_la_compra']; ?></td>
            <td> <?php echo $row['cantidad']; ?></td>
            <td>$ <?php echo $row['precio_peso_ARG']; ?></td>
            <td>$ <?php echo $row['precio_dolar']; ?> USD</td>
            <td> <?php echo $row['IVA']; ?>%</td>
            <td> <?php echo $row['fecha_actualizacion_precio']; ?></td>
            <td> <?php echo $row['proveedor']; ?></td>
            <th><a style=" position: relative;padding: 10px 15px;margin: 10px;font-size: 16px;cursor: pointer;border: none;background-color:red;color: #ffffff;text-decoration: none; transition: background-color 0.3s, color 0.3s;" href="elim.php?id=<?php echo $row['id']; ?>">Eliminar</th><!--boton de eliminar-->
            <th><a style=" position: relative;padding: 10px 15px;margin: 10px;font-size: 16px;cursor: pointer;border: none;background-color: rgba(14, 54, 100, 0.651);;color: #ffffff;text-decoration: none; transition: background-color 0.3s, color 0.3s;" href="modificar.php?id=<?php echo $row ['id'];?> ">Modificar</a></th><!-- boton de modificar productos -->
            <th><input type="checkbox" name="eliminar[]" value="<?php echo $row['id']; ?>"></th>
          </tr>
        <?php
            }
        ?>
      </tbody>
      <div style="justify-content: space-between;" class="button-container">
        <!-----------------------------------------------------------------boton de eliminar seleccionados------------------------------->
        <form action="elim.php" method="post">
          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
          <a href="nuevo.html" class="button">Nuevo Producto</a><!-- boton de nuevo producto -->
          <button type="submit" style="position: relative;padding: 10px 15px;margin: 10px;font-size: 16px;cursor: pointer;border: none;background-color:red;color: #ffffff;text-decoration: none;">Eliminar múltiples</button>
        </form>
        <div style="background-color:#0a5f2373;height: 60px;">
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

              <form action="" method="post" style="background-color:#0a5f2373">
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
                  <button type="submit" style="position: relative;padding: 10px 15px;margin: 10px;font-size: 16px;cursor: pointer;border: none;background-color:rgba(44, 109, 42, 0.842);color: #ffffff;text-decoration: none; transition: background-color 0.3s, color 0.3s;">Calcular</button>
              </form>

              <?php
              // Mostrar el resultado si se enviaron los datos del formulario
              if ($precioDolar > 0) {
                  echo "<p>Precio total incluyendo IVA: $ " . number_format($precioTotal, 2) . "</p>";
              }
              ?>
            </div>
      </div> 
    </table>
  </center> 
  <div class="background-image"></div>
  <script>//-------------------------------------------------filtrado de los valores-----------------------------------------------------
      const filtroSelect = document.getElementById("filtro");
      const filtroInput = document.getElementById("filtroInput");
      filtroSelect.addEventListener("change", filtrarTabla);
      filtroInput.addEventListener("input", filtrarTabla);
      function filtrarTabla() {
          const filtro = filtroSelect.value;
          const valor = filtroInput.value.toLowerCase();
          const table = document.getElementById("dataTable");
          const rows = table.getElementsByTagName("tr");
          for (let i = 1; i < rows.length; i++) {
              const row = rows[i];
              const cells = row.getElementsByTagName("td");
              let text = '';
              if (filtro === "nombre_del_producto") {
                  text = cells[0].textContent || cells[0].innerText;
              } else if (filtro === "descripcion") {
                  text = cells[1].textContent || cells[1].innerText;
              } else if (filtro === "fecha_de_la_compra") {
                  text = cells[2].textContent || cells[2].innerText;
              } else if (filtro === "cantidad") {
                  text = cells[3].textContent || cells[3].innerText;
              } else if (filtro === "precio_peso_ARG") {
                  text = cells[4].textContent || cells[4].innerText;
              } else if (filtro === "precio_dolar") {
                  text = cells[5].textContent || cells[5].innerText;
              } else if (filtro === "IVA") {
                  text = cells[6].textContent || cells[6].innerText;
              } else if (filtro === "fecha_actializacion_precio") {
                  text = cells[7].textContent || cells[7].innerText;
              } else if (filtro === "proveedor") {
                  text = cells[8].textContent || cells[8].innerText;
              } else {
                  text = Array.from(cells).map(cell => cell.textContent || cell.innerText).join("");
              }
              if (filtro === "todos" || text.toLowerCase().includes(valor)) {
                  row.style.display = "";
              } else {
                  row.style.display = "none";
              }
          }
      }
    </script><!---------------------------------------------------------------------------------------------------------------------------------->
  <!--<script src="scriptadmin.js"></script>-->
</html>