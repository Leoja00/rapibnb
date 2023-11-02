<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">   
    <link href="https://fonts.cdnfonts.com/css/getvoip-grotesque" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Darker+Grotesque:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo/navbar.css">
    <link rel="stylesheet" href="estilo/login.css">
    
    <link rel="icon" href="img/logo.png">
</head>
<body>

<div class="wrapper">
    <form action="procesarLogin.php" method="POST">
      <h2>Iniciar sesión</h2>
      <?php
        if (isset($_GET["error"])) {
            $error = $_GET["error"];
            if ($error == 1) {
                echo '<div class="alert alert-danger">Contraseña incorrecta</div>';
            } elseif ($error == 2) {
                echo '<div class="alert alert-danger">Usuario no encontrado</div>';
            }
        }
      ?>
      <div class="input-field">
        <input type="text" name="correo" required>
        <label>Ingrese correo</label>
      </div>
      <div class="input-field">
        <input type="password" name="contrasenia" required>
        <label>Ingrese contraseña</label>
      </div>
      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember">
          <p>Recordarme</p>
        </label>
        <a href="#">Olvidé contraseña</a>
      </div>
      <button type="submit">Continuar</button>
      <div class="register">
        <p>¿No tienes cuenta? <a href="register.php">Regístrate</a></p>
      </div>
      <div class="register">
        <p>¿Queres volver al inicio? <a href="index.php">Inicio</a></p>
      </div>
    </form>
</div>

  
</body>
</html>