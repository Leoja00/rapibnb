<?php require_once 'config.php'?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rapi Bnb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">   
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="estilo/navbar.css">
    
    <link rel="icon" href="img/logo.png">
</head>
<style>

  @import url('https://fonts.cdnfonts.com/css/getvoip-grotesque');                
    .navbar {
        position: relative;
        z-index: 2;
    }
    .rapibnb {
   color: #031926;
   font-size: 24px; 
   font-family: 'GetVoIP Grotesque', sans-serif;
   margin-left: 10%;
}
    .container.mt-3 {
        position: relative;
        z-index: 1;
    }
</style>


<body>
<nav class="navbar navbar-expand-lg bg-navbar-top navbar-edit">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img class="logo" src="img/logo.png" alt="brand">
            <span class="rapibnb">RapiBnB</span>
        </a>
        <!-- BOTÓN HAMBURGUESA -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon icon-burger">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-list icon-burger" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
            </span>
        </button>

        <?php

if (isset($_SESSION["usuario"])) {
    $query = "SELECT rol FROM usuarios WHERE id = {$_SESSION['usuario']}";
    $result = mysqli_query($conexion, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $rolUsuario = $row['rol'];

        if ($rolUsuario == 1) {//ADMINISTRADORES
            echo '<div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto justify-content-center text-center">
                        <li class="nav-item">
                            <a class="nav-link" href="crearAlquiler.php">Crear oferta de alquiler</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="panelAdmin.php">Panel de Administrador</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="uil uil-user-square"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="perfil.php">Mi Perfil</a>
                                <a class="dropdown-item" href="editarPerfil.php">Editar Perfil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="cerrarLogin.php">Cerrar Sesión</a>
                            </div>
                        </li>
                    </ul>
                </div>';
        } else {//REGULARES
            echo '<div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto justify-content-center text-center">
                        <li class="nav-item">
                            <a class="nav-link" href="crearAlquiler.php">Crear oferta de alquiler</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="uil uil-user-square"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="perfil.php">Mi Perfil</a>
                                <a class="dropdown-item" href="editarPerfil.php">Editar Perfil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="cerrarLogin.php">Cerrar Sesión</a>
                            </div>
                        </li>
                    </ul>
                </div>';
        }
    }
} else {
    echo '<div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto justify-content-center text-center">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Iniciar sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Registrarse</a>
                </li>
            </ul>
        </div>';
}
?>
</nav>

    <script src="js/scroll.js"></script>
  <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
  
</html>