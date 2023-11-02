<?php 
require_once 'config.php'?>
<!doctype html>
<html lang="es">
<link rel="stylesheet" href="estilo/buscador.css">
<head>
</head>
<body>
<br><br><br>
<div class="container mt-3">
    <div class="row">
         <div class="col-lg-6 offset-lg-3">
            <div class="box">
                    <input type="checkbox" id="check">
                    <div class="search-box">
                        <input type="text" placeholder="Buscar alquileres...">
                        <label for="check" class="icon">
                            <i class="uil uil-search"></i>
                        </label>
                   </div>
            </div>
        </div>
     </div>
</div>
<script src="js/scrollBuscador.js"></script>
</body>
</html>