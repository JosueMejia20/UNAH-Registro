<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado</title>
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
      {"label": "Periodo", "href": "periodo.php"},
      {"label": "Docentes", "href": "docentes.php"},
      {"label": "Historial", "href": "historial.php"},
      {"label": "Notas", "href": "notas.php"},
      {"label": "Estadistica", "href": "estadistica.php"},
      {"label": "Listado", "href": "listado.php"},
      {"label": "Clave", "href": "clave.php"}
    ]'></unah-sidebar>

    <div class="container_principal">
        <h1 class="main-title">Listado</h1>

            <table class="requests-table">
                <thead>
                    <tr>
                        <th>Numero de Cuenta</th>
                        <th>Nombre del Estudiante</th>
                        <th>Carrera</th>
                        <th>correo</th>
                        <th>Periodo</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>111</td>
                        <td>Isac Lainez</td>
                        <td>Ingenieria en Sistemas</td>
                        <td>isaclainez@unah.hn</td>
                        <td>II Periodo</td>
                        <td>Matriculado</td>
                    </tr>
                    <tr>
                        <td>222</td>
                        <td>Fernando Lopez</td>
                        <td>Ingenieria en Sistemas</td>
                        <td>ferlopez@unah.hn</td>
                        <td>II Periodo</td>
                        <td>Matriculado</td>
                    </tr>
                    <tr>
                        <td>333</td>
                        <td>Nohely Sierra</td>
                        <td>Ingenieria en Sistemas</td>
                        <td>nohelys@unah.hn</td>   
                        <td>II Periodo</td>
                        <td>Matriculado</td>     
                    </tr>
                </tbody>
            </table>

    </div>


    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>