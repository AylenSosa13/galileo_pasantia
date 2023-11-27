
            function confirmarBorrado() {
            var confirmacion = confirm("¿Estás seguro que quieres borrar este dato?");
            if (confirmacion) {
                // Si el usuario presiona "Aceptar", se borra el dato
                window.location.href = "elim.php?id=<?php echo $row['id']; ?>";
            }
            }
     