<?php 
require_once 'config.php'?>
<!doctype html>
<html lang="es">
<link rel="stylesheet" href="estilo/buscador.css">
<head>
</head>
<body>
<br><br><br><br>
<div id='search-box'>
<form action='procesarBuscador.php' id='search-form' method='get' target='_top'>
<input id='search-text' name='buscaralquiler' placeholder='Buscar alquileres...' type='text'/>
<button id='search-button' type='submit'><span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg></span></button>
</form>
</div>
</body>
</html>