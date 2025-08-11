<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Jefe</title>
  <link rel="icon" href="https://lepidopterahonduras.wordpress.com/wp-content/uploads/2015/04/cropped-escudo-unah-22.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/../../assets/css/principal_components.css">
  <link rel="stylesheet" href="/../../assets/css/docente_style.css">
</head>
<body>
  <unah-navbar></unah-navbar>    

    <unah-sidebar menu-items='[
      {"label": "Perfil", "href": "perfil_jefe.php"},
      {"label": "Asignaturas", "href": "asignaturas.php"},
      {"label": "Docentes", "href": "docentes.php"},
      {"label": "Historial", "href": "historial.php"},
      {"label": "Notas", "href": "notas.php"},
      {"label": "Estadistica", "href": "estadistica.php"},
      {"label": "Listado", "href": "listado.php"}
    ]'
    sidebar-title="Portal Jefe UNAH"
    user-name="Jefe"></unah-sidebar>

    <div class="container_principal">

        <div class="perfil-card">
          <div class="imagen-perfil">
            <img src="ruta-de-la-imagen.jpg" alt="Foto de perfil">
          </div>
          <div class="info-perfil">
            <p class="titulo">Bienvenido Jefe</p>
            <p class="nombre">Mario Geron</p>
          </div>
        </div>

        <div class="contenedor_info">
        <div class="contenedor_info">
          <div class="izquierda">
            <div class="perfil-info">
              <div class="izquierda-header">
                <h4>Información Personal</h4>
              </div>
              <p><span class="label">ID de docente:</span> 10234</p>
              <p><span class="label">Correo:</span> mar.ger@unah.hn</p>
              <p><span class="label">Cargo:</span> Jefe</p>
              <p><span class="label">Centro universitario:</span> Ciudad Universitaria</p>
            </div>
          </div>


          <div class="derecha">
            <div class="perfil-info">
              <div class="derecha-header">
                <h4>Información Personal</h4>
              </div>
              <p><span class="label">Facultad:</span> Ingenieria</p>
              <p><span class="label">Nivel Academico:</span> Ingeniero en Sistemas</p>
              <p><span class="label">Años de experiencia:</span> 5 Años</p>
              <p><span class="label">Fecha de ingreso:</span> 20/05/2023</p>
            </div>
          </div>
        </div>

 


    </div>


    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>