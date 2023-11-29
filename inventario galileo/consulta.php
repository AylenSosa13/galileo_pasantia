<!DOCTYPE html>
<html>
<head>
    <title>Registro de llamadas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="stile.css">
<body>
    <div class="background-image"></div>
    <h1>Registro de llamadas</h1>

    <!-- Menú desplegable para filtrar -->
    <label for="filtro">Filtrar por Categoría: </label> 
    <select id="filtro" onchange="filtrarDatos()">
        <option value="todos">Todos</option>
        <option value="id_llamada">id</option>
        <option value="duracion">duracion</option>
        <option value="tipo">tipo</option>
        <option value="atendido">atendido</option>
        <option value="fecha_hora">fecha y hora</option>
        <option value="area">area</option>
        <option value="origen">origen</option>
        <option value="lugar">lugar</option>
    </select>
    <input type="text" class="btn" id="filtroInput" placeholder="Ingrese el valor de filtrado">

    <!-- Tabla de datos -->
    <center style="padding-top: 40px;">

    <table id="dataTable" border>
      <thead>
        <tr>
          <th>Id</th>
          <th>Genero</th>
          <th>Duracion </th>
          <th>Tipo</th>
          <th>Atendido</th>
          <th>Fecha y Hora</th>
          <th>Area</th>
          <th>Origen</th>
          <th>Lugar</th>
          
        </tr>
      </thead>
      <tbody>
        <?php
          $conexion = new mysqli("localhost", "root", "", "olimpiadas");
          $query ="SELECT * FROM llamadas";
          $resultado = $conexion->query($query);
          while($row = $resultado->fetch_assoc()){
        ?>
          <tr>
            <td> <?php echo $row['id_llamada']; ?></td>
            <td> <?php echo $row['genero']; ?></td>
            <td> <?php echo $row['duracion']; ?></td>
            <td> <?php echo $row['tipo']; ?></td>
            <td> <?php echo $row['atendido']; ?></td>
            <td> <?php echo $row['fecha_hora']; ?></td>
            <td> <?php echo $row['area']; ?></td>
            <td> <?php echo $row['origen']; ?></td>
            <td> <?php echo $row['lugar']; ?></td>
          </tr>

        <?php
            }
        ?>

    </tbody>
      
    </table>
  </center> 

    <!-- Gráfico de pie más pequeño -->
    <!-- Gráfico de pie más pequeño -->
    <canvas id="grafico" style="max-width: 200px; max-height: 500px;padding-top:10px "></canvas>



  
    

    <script>
        //filtro
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

              if (filtro === "id_llamada") {
                  text = cells[0].textContent || cells[0].innerText;
              } else if (filtro === "genero") {
                  text = cells[1].textContent || cells[1].innerText;
              } else if (filtro === "duracion") {
                  text = cells[2].textContent || cells[2].innerText;
              } else if (filtro === "tipo") {
                  text = cells[3].textContent || cells[3].innerText;
              } else if (filtro === "atendido") {
                  text = cells[4].textContent || cells[4].innerText;
              } else if (filtro === "fecha_hora") {
                  text = cells[5].textContent || cells[5].innerText;
              } else if (filtro === "area") {
                  text = cells[6].textContent || cells[6].innerText;
              } else if (filtro === "origen") {
                  text = cells[7].textContent || cells[7].innerText;
              } else if (filtro === "lugar") {
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

        // Función para filtrar los datos
        function filtrarDatos() {
            var select = document.getElementById('filtro');
            var categoriaSeleccionada = select.value;

            var table = document.querySelector('table');
            var rows = table.getElementsByTagName('tr');

            var data = {}; // Inicializar datos del gráfico

            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var cell = row.getElementsByTagName('td')[2];
                
                if (cell) {
                    var categoriaActual = cell.textContent || cell.innerText;
                    
                    if (categoriaSeleccionada === 'todos' || categoriaActual === categoriaSeleccionada) {
                        // Actualizar datos del gráfico
                        if (data[categoriaActual]) {
                            data[categoriaActual]++;
                        } else {
                            data[categoriaActual] = 1;
                        }
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            }

            // Actualizar datos del gráfico
            actualizarGrafico(data);
        }

        // Función para actualizar el gráfico de pie
        function actualizarGrafico(data) {
            var labels = Object.keys(data);
            var valores = Object.values(data);

            var ctx = document.getElementById('grafico').getContext('2d');
            var grafico = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: valores,
                        backgroundColor: ['blue', 'red', 'green', 'yellow', 'purple', 'orange', 'pink', 'brown', 'gray'],
                    }]
                },
            });
        }

        // Llamar a la función inicialmente
        filtrarDatos();
        
    </script>
</body>
</html>



