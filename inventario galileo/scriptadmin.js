document.getElementById('searchInput').addEventListener('input', function() {
    var searchText = this.value.toLowerCase();
    var table = document.getElementById('dataTable');
    var rows = table.getElementsByTagName('tr');
  
    for (var i = 1; i < rows.length; i++) {
      var row = rows[i];
      var firstName = row.getElementsByTagName('td')[0].textContent.toLowerCase();
      var lastName = row.getElementsByTagName('td')[1].textContent.toLowerCase();
  
      if (firstName.includes(searchText) || lastName.includes(searchText)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    }
  });


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

        if (filtro === "nombre") {
            text = cells[0].textContent || cells[0].innerText;
        } else if (filtro === "apellido") {
            text = cells[1].textContent || cells[1].innerText;
        } else if (filtro === "edad") {
            text = cells[2].textContent || cells[2].innerText;
        } else {
            text = cells[0].textContent + cells[1].textContent + cells[2].textContent || 
                    cells[0].innerText + cells[1].innerText + cells[2].innerText;
        }

        if (filtro === "todos" || text.toLowerCase().includes(valor)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    }
}