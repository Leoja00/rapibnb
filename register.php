<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrarse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">   
    <link href="https://fonts.cdnfonts.com/css/getvoip-grotesque" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Darker+Grotesque:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo/navbar.css">
    <link rel="stylesheet" href="estilo/signin.css">
    
    <link rel="icon" href="img/logo.png">
</head>
<body>

<div class="wrapper">
    <h2>Registrarse</h2>
    <form action="procesarRegistro.php" method="POST" enctype="multipart/form-data">
        
        <div class="input-field">
            <input type="text" name="nombre" required>
            <label>Ingrese nombre</label>
        </div>
        <div class="input-field">
            <input type="text" name="apellido" required>
            <label>Ingrese apellido</label>
        </div>
        <div class="input-field">
            <input type="number" name="dni" required>
            <label>Ingrese dni</label>
        </div>
        
        <div class="input-field">
            <input type="number" name="telefono" required>
            <label>Ingrese telefono</label>
        </div>
        <div class="input-field">
            <input type="text" name="correo" required>
            <label>Ingrese correo</label>
        </div>
        <div class="input-field">
            <input type="password" name="contrasenia" required>
            <label>Ingrese contraseña</label>
        </div>
        <div class="input-field">
            <input type="password" name="confirmar_contrasenia"required >
            <label>Confirme contraseña</label>
        </div>
        <div class="input-field">
            <input type="text" name="intereses" required>
            <label>Ingrese intereses</label>
        </div>
        <div class="input-field">
            <input type="text" name="biografia" required>
            <label>Ingrese biografia</label>
        </div>
        
        <div class="input-field file-input">
            <div class="file-title">Ingrese foto de perfil</div>
            <input type="file" name="foto" accept="image/*"required >
        </div>

        
        <div class="register">
            <p>¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
        </div>
        <div class="register">
        <p>¿Queres volver al inicio? <a href="index.php">Inicio</a></p>
      </div>
        <button type="submit">Continuar</button>
        
    </form>
</div>




</body>
</html>