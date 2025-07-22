<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas</title>
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
        <h1 class="main-title">Notas de Asignaturas</h1>

            <table class="requests-table">
                <thead>
                    <tr>
                        <th>Codigo de Clase</th>
                        <th>Nombre de Clase</th>
                        <th>Seccion</th>
                        <th>Subir Notas</th>
                        <th>Visualizar Notas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>IS111</td>
                        <td>Programacion 2</td>
                        <td>0900</td>
                        <td>   
                            <a href="subir_notas.php">
                                <button class="action-btn">Subir Notas</button> 
                            </a>                
                        </td>
                        <td>
                            <a href="ver_notas.php">
                                <button class="action-btn">Ver Notas</button> 
                            </a> 
                        </td>
                    </tr>
                    <tr>
                        <td>IS222</td>
                        <td>Bases de Datos</td>
                        <td>1000</td>
                        <td>
                            <a href="subir_notas.php">
                                <button class="action-btn">Subir Notas</button> 
                            </a>   
                        </td>
                        <td>
                            <a href="ver_notas.php">
                                <button class="action-btn">Ver Notas</button> 
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>IS333</td>
                        <td>Lenguajes de Programacion</td>
                        <td>1100</td>
                        <td>
                            <a href="subir_notas.php">
                                <button class="action-btn">Subir Notas</button> 
                            </a>    
                        </td>
                        <td>
                            <a href="ver_notas.php">
                                <button class="action-btn">Ver Notas</button> 
                            </a> 
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>


    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>