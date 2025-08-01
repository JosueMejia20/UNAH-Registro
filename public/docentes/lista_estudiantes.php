<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudiantes</title>
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

        <div class="perfil-card">
          <div class="imagen-perfil">
            <img src="ruta-de-la-imagen.jpg" alt="Foto de perfil">
          </div>
          <div class="info-perfil">
            <p class="titulo">Lista de Estudiantes</p>
            <p class="nombre">Ricardo Figueroa</p>
          </div>
        </div>
        

            <table class="requests-table">
                <thead>
                    <tr>
                        <th>Numero de Cuenta</th>
                        <th>Nombre del Estudiante</th>
                        <th>Carrera</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>111</td>
                        <td>Isac Lainez</td>
                        <td>Ingenieria en Sistemas</td>
                        <td>isaclainez@unah.hn</td>
                    </tr>
                    <tr>
                        <td>222</td>
                        <td>Fernando Lopez</td>
                        <td>Ingenieria en Sistemas</td>
                        <td>ferlopez@unah.hn</td>
                    </tr>
                    <tr>
                        <td>333</td>
                        <td>Nohely Sierra</td>
                        <td>Ingenieria en Sistemas</td>
                        <td>nohelys@unah.hn</td>                 
                    </tr>
                </tbody>
            </table>

            <a href="asignatura.php">
                <button class="action-btn" style="margin-top: 10px;">Retroceder</button> 
            </a>            
    </div>


    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>