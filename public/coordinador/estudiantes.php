<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>
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
        <h1 class="main-title">Estudiantes</h1>

            <table class="requests-table">
                <thead>
                    <tr>
                        <th>Numero de Cuenta</th>
                        <th>Nombre del Estudiante</th>
                        <th>Carrera</th>
                        <th>Correo</th>
                        <th>Historial Academico</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>111</td>
                        <td>Isac Lainez</td>
                        <td>Ingenieria en Sistemas</td>
                        <td>isaclainez@unah.hn</td>
                        <td>
                            <a href="historial.php">
                                <button class="action-btn">Ver Historial</button> 
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>222</td>
                        <td>Fernando Lopez</td>
                        <td>Ingenieria en Sistemas</td>
                        <td>ferlopez@unah.hn</td>
                        <td>
                            <a href="historial.php">
                                <button class="action-btn">Ver Historial</button> 
                            </a>                      
                        </td>
                    </tr>
                    <tr>
                        <td>333</td>
                        <td>Nohely Sierra</td>
                        <td>Ingenieria en Sistemas</td>
                        <td>nohelys@unah.hn</td>
                        <td>
                            <a href="historial.php">
                                <button class="action-btn">Ver Historial</button> 
                            </a> 
                        </td>                   
                    </tr>
                </tbody>
            </table>
    </div>


    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>