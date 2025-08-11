<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carga Academica</title>
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
            <p class="titulo">Carga Academica</p>
            <p class="nombre">Rafael Raudales</p>
          </div>
        </div>


            <table class="requests-table">
                <thead>
                    <tr>
                        <th>Codigo de Clase</th>
                        <th>Nombre de Clase</th>
                        <th>Numero de Empleado</th>
                        <th>Docente</th>
                        <th>Estudiantes Matriculados</th>
                        <th>Cupos Habilitados</th>
                        <th>Edificio</th>
                        <th>Aula</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>IS111</td>
                        <td>Programacion 2</td>
                        <td>111</td>
                        <td>Mirna Raudales</td>
                        <td>25 Estudiantes</td>
                        <td>28 Estudiantes</td>
                        <td>B2</td>
                        <td>210 Lab 2</td>
                    </tr>
                    <tr>
                        <td>IS222</td>
                        <td>Bases de Datos</td>
                        <td>222</td>
                        <td>Fernando Quijano</td>
                        <td>27 Estudiantes</td>
                        <td>28 Estudiantes</td>
                        <td>B2</td>
                        <td>209 Lab 1</td>
                    </tr>
                    <tr>
                        <td>IS333</td>
                        <td>Lenguajes de Programacion</td>
                        <td>333</td>
                        <td>Ramon Ortiz</td>
                        <td>22 Estudiantes</td>
                        <td>28 Estudiantes</td>
                        <td>B2</td>
                        <td>410 Lab 3</td>
                    </tr>
                </tbody>
            </table>
    </div>


    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>