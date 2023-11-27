<!DOCTYPE html>
<html>
<head><!--encabezado-->
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="login.css"><!--link para la pagina de css-->
  <link rel="icon" href="logoG.png" type="image/png"><!--link paa el logo de la pestaña-->
</head>
<body style="background-image: url(img/image.jpg);"><!--imagen de fondo-->
  <div class="login-container">
    <h2>Inventario Galileo</h2>
    <form action="guarusuario.php" method="POST"  enctype="multipart/form-data" class="form" > <!--formulario para ingresar el usuario y contraseña-->
        <label for="username">Usuario</label>
        <input type="text" id="username" name="username" placeholder="Campo obligatorio" required ><br><br>
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Campo obligatorio" required><br><br>
        <input class="btn" type="submit" name="register" value="Enviar" >
    </form>
  </div>
</body>
</html>