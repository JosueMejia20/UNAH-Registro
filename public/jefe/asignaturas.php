<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignaturas</title>
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
        <h1 class="main-title">Asignaturas</h1>

        <button class="action-btn">Agregar Asignatura</button>                    
        <button class="action-btn">Eliminar Asignatura</button>                        
        <button class="action-btn">Modificar Asignatura</button>                        
        <br>

            <table class="requests-table">
                <thead>
                    <tr>
                        <th>Codigo de Clase</th>
                        <th>Nombre de Clase</th>
                        <th>Docente</th>
                        <th>Carrera</th>
                        <th>Seccion</th>
                        <th>Lista de Estudiantes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>IS111</td>
                        <td>Programacion 2</td>
                        <td>Mirna Raudales</td>
                        <td>Ingenieria en Sistemas</td>
                        <td>0900</td>
                        <td>
                            <a href="lista_estudiantes.php">
                                <button class="action-btn">Ver Lista</button> 
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>IS222</td>
                        <td>Bases de Datos</td>
                        <td>Fernando Quijano</td>
                        <td>Ingenieria en Sistemas</td>
                        <td>1000</td>
                        <td>
                            <a href="lista_estudiantes.php">
                                <button class="action-btn">Ver Lista</button> 
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>IS333</td>
                        <td>Lenguajes de Programacion</td>
                        <td>Ramon Ortiz</td>
                        <td>Ingenieria en Sistemas</td>
                        <td>1100</td>
                        <td>
                            <a href="lista_estudiantes.php">
                                <button class="action-btn">Ver Lista</button> 
                            </a>                       
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>


    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>