<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear anuncio</title>
    
    <link href="https://fonts.cdnfonts.com/css/getvoip-grotesque" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Darker+Grotesque:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo/oferta.css">
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">

    <link rel="icon" href="img/logo.png">
</head>
<body>

<div class="wrapper">
    <h2>Crear oferta de alquiler</h2>
    <form action="procesarAnuncio.php" method="POST" enctype="multipart/form-data">
        
        <div class="input-field">
            <input type="text" name="titulo" required>
            <label>Título </label>
        </div>

        <div class="input-field">
        <input type="text" name="descripcion" required>
            <label>Descripción</label>
        </div>

        <div class="input-field">
            <input type="text" name="ubicacion" required>
            <label>Ubicación</label>
        </div>

        <div class="input-field">
            <input type="text" name="etiquetas" required>
            <label>Etiquetas</label>
        </div>

        

        <div class="input-field">
            <input type="number" name="costo_por_dia" min="1000" max="100000" required>
            <label>Costo diario</label>
        </div>

        <div class="input-field">
            <input type="number" name="tiempo_minimo" required>
            <label>Duración mínima (días)</label>
        </div>

        <div class="input-field">
            <input type="number" name="tiempo_maximo" required>
            <label>Duración máxima (días)</label>
        </div>

        <div class="input-field">
            <input type="number" name="cupos" min="1" max="20" required>
            <label>Cupo de personas</label>
        </div>

        <div class="input-field file-input">
            <div class="file-title">Galería de fotos</div>
            <input type="file" name="fotos[]" accept="image/*" multiple required>
        </div>

        <div class="servicios-label-div">
            <label class="servicios-label" for="multiple-checkboxes">Seleccione servicio/s </label>
            <select id="multiple-checkboxes" multiple="multiple" required name="servicios[]">
                <option value="wifi">WiFi</option>
                <option value="desayuno">Desayuno</option>
                <option value="merienda">Merienda</option>
                <option value="limpieza">Limpieza</option>
                <option value="cochera">Cochera</option>
            </select>
        </div>
        
        <div class="register">
            <p>¿Queres volver al inicio? <a href="index.php">Inicio</a></p>
        </div>
        
        <button type="submit">Crear Anuncio</button>
        
    </form>
</div>




<script>
    $(document).ready(function() {
        $('#multiple-checkboxes').multiselect({
            includeSelectAllOption: true,
            nonSelectedText: 'Seleccionar', // Texto para cuando no se ha seleccionado ningún elemento
            allSelectedText: 'Todos Seleccionados', // Texto para cuando todos los elementos están seleccionados
            nSelectedText: ' seleccionados', // Texto para cuando se seleccionan varios elementos
            selectAllText: 'Seleccionar Todo', // Texto para seleccionar todos los elementos
            buttonWidth: '100%', // Ancho del botón
            numberDisplayed: 2, // Número de elementos mostrados en el botón antes de usar la función "nSelectedText"
            maxHeight: 200 // Altura máxima de la lista desplegable
        });
    });
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>
</html>