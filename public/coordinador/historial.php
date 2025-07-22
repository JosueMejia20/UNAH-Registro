<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
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
        <h1 class="main-title">Historial</h1>

            <table class="requests-table">
                <thead>
                    <tr>
                        <th>Codigo de Clase</th>
                        <th>Nombre de Clase</th>
                        <th>Departamento</th>
                        <th>Carrera</th>
                        <th>Seccion</th>
                        <th>Periodo</th>
                        <th>Nota</th>
                        <th>Observacion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>IS111</td>
                        <td>Programacion 2</td>
                        <td>Ingenieria</td>
                        <td>Ingenieria en Sistemas</td>
                        <td>0900</td>
                        <td>Primer Periodo 2025</td>
                        <td>70</td>
                        <td>Aprobado</td>

                    </tr>
                    <tr>
                        <td>IS222</td>
                        <td>Bases de Datos</td>
                        <td>Ingenieria</td>
                        <td>Ingenieria en Sistemas</td>
                        <td>1000</td>
                        <td>Segundo Periodo 2025</td>
                        <td>40</td>
                        <td>Reprobado</td>
                    </tr>
                    <tr>
                        <td>IS333</td>
                        <td>Lenguajes de Programacion</td>
                        <td>Ingenieria</td>
                        <td>Ingenieria en Sistemas</td>
                        <td>1100</td>
                        <td>Tercer Periodo 2025</td>
                        <td>88</td>
                        <td>Aprovado</td>
                    </tr>
                </tbody>
            </table>

        <a href="estudiantes.php">
            <button class="action-btn" style="margin-top: 10px;">Retroceder</button> 
        </a> 
    </div>


    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>