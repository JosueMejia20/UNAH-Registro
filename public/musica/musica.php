<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musica</title>
  <link rel="icon" href="https://lepidopterahonduras.wordpress.com/wp-content/uploads/2015/04/cropped-escudo-unah-22.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/../../assets/css/principal_components.css">
  <link rel="stylesheet" href="/../../assets/css/musica_style.css">
</head>
<body>
  <unah-navbar></unah-navbar>    

    <unah-sidebar menu-items='[
      {"label": "Musica", "href": "musica.php"}
    ]'></unah-sidebar>

    <div class="container_principal">
        <h1 class="main-title">Recursos de Musica</h1>

            <main>
                
                <div id="menuPrincipal" class="menu">
                <h2 class="main-title">Seleccione una opcion</h2>
                <button onclick="mostrar('subir')">Subir Recurso</button>
                <button onclick="mostrar('biblioteca')">Ver Biblioteca de Recursos</button>
                </div>

                
                <div id="seccionSubir" class="seccion">
                <h2 class="main-title">Subir Recursos</h2>
                <form id="formulario">
                    <label>Autor(es): <input type="text" id="autor" required></label>
                    <label>Título: <input type="text" id="titulo" required></label>
                    <label>Tags (separados por comas): <input type="text" id="tags"></label>
                    <label>Tipo de recurso:
                    <select id="tipo" required>
                        <option value="pdf">Documento (PDF)</option>
                        <option value="mp3">Audio (MP3)</option>
                        <option value="wav">Audio (WAV)</option>
                        <option value="partitura">Tablatura/Partitura (MSCZ, MSCX, XML, MXL)</option>
                    </select>
                    </label>
                    <label>Archivo: <input type="file" id="archivo" accept=".pdf,.mp3,.wav,.msc,.mscz,.xml,.mxl" required></label>
                    <button type="submit">Subir recurso</button>
                </form>
                <button class="volver" onclick="volverAlMenu()">← Volver al menú</button>
                </div>

                
                <div id="seccionBiblioteca" class="seccion">
                <h2 class="main-title">Recursos</h2>
                <table id="tablaRecursos">
                    <thead>
                    <tr>
                        <th>Autor</th>
                        <th>Título</th>
                        <th>Tags</th>
                        <th>Tipo</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
                <div class="viewer" id="visor"></div>
                <button class="volver" onclick="volverAlMenu()">← Volver al menú</button>
                </div>
            </main>



    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
    <script type="module" src="../../assets/js/Musica/musica.js"></script>
</body>
</html>