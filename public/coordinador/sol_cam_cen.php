<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes Cambio de Centro</title>
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
    ]'
    sidebar-title="Portal Coordinador UNAH"
    user-name="Coordinador"></unah-sidebar>

    <div class="container_principal">

        <div class="perfil-card">
          <div class="imagen-perfil">
            <img src="ruta-de-la-imagen.jpg" alt="Foto de perfil">
          </div>
          <div class="info-perfil">
            <p class="titulo">Solicitudes Cambio de Centro</p>
            <p class="nombre">Rafael Raudales</p>
          </div>
        </div>

            <table class="requests-table">
                <thead>
                    <tr>
                        <th>Codigo de Solicitud</th>
                        <th>Nombre de Estudiante</th>
                        <th>Centro Actual</th>
                        <th>Documento de Solicitud</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>CC111</td>
                        <td>Camilo Zepeda</td>
                        <td>UNAH Ciudad Universitaria</td>
                        <td>
                            <button class="action-btn">Ver Documento</button>                        
                        </td>
                        <td>
                            <button class="action-btn">Aprobar</button> 
                            <button class="action-btn">Rechazar</button>                        
                        </td>
                    </tr>
                    
                </tbody>
            </table>
    </div>


    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>