<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Docente</title>
  <link rel="icon" href="https://lepidopterahonduras.wordpress.com/wp-content/uploads/2015/04/cropped-escudo-unah-22.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/../../assets/css/principal_components.css">
  <link rel="stylesheet" href="/../../assets/css/docente_style.css">
</head>
<body>
  <unah-navbar></unah-navbar>    

    <unah-sidebar menu-items='[
      {"label": "Perfil", "href": "perfil_docente.php"},
      {"label": "Asignaturas", "href": "asignatura.php"},
      {"label": "Recursos", "href": "recursos.php"},
      {"label": "Notas", "href": "notas.php"}
    ]'></unah-sidebar>

    <div class="container_principal">
        <h1 class="main-title">Perfil de Docente</h1>

          <div class="perfil-container">
            <img src="foto.jpg" alt="Foto de perfil" class="perfil-img">
            <h2>Ing. Roberto Figueroa</h2>

            <div class="perfil-info">
              <h3>Información del perfil</h3>
              <p><span class="label">ID de docente:</span> 10234</p>
              <p><span class="label">Correo:</span> roberto.fig@unah.hn</p>
              <p><span class="label">Cargo:</span> Docente</p>
              <p><span class="label">Centro universitario:</span> Ciudad Universitaria</p>
            </div>
          </div>

    </div>


    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>