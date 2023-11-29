function confirmarEliminacion(id) {
    const confirmacion = confirm("¿Desea eliminar el usuario?");
  
    if (confirmacion) {
      // volver a la página que realiza la eliminación
      window.location.href = "eliminar_usuario.php?eliminar=" + id;
    } else {
      // volver a la página principal
      window.location.href = "paginaprincipal.php";
    }
  }