<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docentes</title>
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

        <div class="perfil-card">
          <div class="imagen-perfil">
            <img src="ruta-de-la-imagen.jpg" alt="Foto de perfil">
          </div>
          <div class="info-perfil">
            <p class="titulo">Lista de Docentes</p>
            <p class="nombre">Mario Geron</p>
          </div>
        </div>


            <table class="requests-table">
                <thead>
                    <tr>
                        <th>Codigo de Docente</th>
                        <th>Nombre del Docente</th>
                        <th>Departamento</th>
                        <th>Carrera</th>
                        <th>Lista de Asignaturas</th>
                        <th>Evaluacion del Docente</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>111</td>
                        <td>Mirna Raudales</td>
                        <td>Ingenieria</td>
                        <td>Ingenieria en Sistemas</td>
                        <td>
                            <a href="lista_asignatura.php">
                                <button class="action-btn">Ver Lista</button> 
                            </a>  
                        </td>
                        <td>
                            <button class="action-btn">Ver Evaluacion</button>  
                        </td>
                    </tr>
                    <tr>
                        <td>222</td>
                        <td>Fernando Quijano</td>
                        <td>Ingenieria</td>
                        <td>Ingenieria en Sistemas</td>
                        <td>
                            <a href="lista_asignatura.php">
                                <button class="action-btn">Ver Lista</button> 
                            </a>                          
                        </td>
                        <td>
                            <button class="action-btn">Ver Evaluacion</button> 
                        </td>                    
                    </tr>
                    <tr>
                        <td>333</td>
                        <td>Ramon Ortiz</td>
                        <td>Ingenieria</td>
                        <td>Ingenieria en Sistemas</td>
                        <td>
                            <a href="lista_asignatura.php">
                                <button class="action-btn">Ver Lista</button> 
                            </a>                     
                        </td>
                        <td>
                            <button class="action-btn">Ver Evaluacion</button>
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>


    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>