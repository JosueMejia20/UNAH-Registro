<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Coordinador</title>
  <link rel="icon" href="https://lepidopterahonduras.wordpress.com/wp-content/uploads/2015/04/cropped-escudo-unah-22.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/../../assets/css/principal_components.css">
  <link rel="stylesheet" href="/../../assets/css/docente_style.css">
</head>
<body>
  <unah-navbar></unah-navbar>    

    <unah-sidebar menu-items='[
      {"label": "Perfil", "href": "perfil_coordinador.php"},
      {"label": "Carga Academica", "href": "carga.php"},
      {"label": "Estudiantes", "href": "estudiantes.php"},
      {"label": "Solicitudes Cambio de Carrera", "href": "sol_cam_car.php"},
      {"label": "Solicitudes Cancelaciones Excepcionales", "href": "sol_can_exc.php"},
      {"label": "Solicitudes Cambio de Centro", "href": "sol_cam_cen.php"}
    ]'></unah-sidebar>

    <div class="container_principal">
        <h1 class="main-title">Perfil de Coordinador</h1>

        <div class="perfil-container">
            <img src="foto.jpg" alt="Foto de perfil" class="perfil-img">
            <h2>Ing. Leoner Ordoñes</h2>

            <div class="perfil-info">
              <h3>Información del perfil</h3>
              <p><span class="label">ID de coordinador:</span> 10234</p>
              <p><span class="label">Correo:</span> leo.ord@unah.hn</p>
              <p><span class="label">Cargo:</span> Coordinador</p>
              <p><span class="label">Centro universitario:</span> Ciudad Universitaria</p>
            </div>
          </div>

    </div>


    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>