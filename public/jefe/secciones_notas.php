<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secciones Notas</title>
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
            <p class="titulo">Secciones</p>
            <p class="nombre">Mario Geron</p>
          </div>
        </div>

<!-- 
        <button class="action-btn">Agregar Seccion</button>                    
        <button class="action-btn">Eliminar Seccion</button>                        
        <button class="action-btn">Modificar Seccion</button>                        
        <br> -->

            <table class="requests-table">
                <thead>
                    <tr>
                        <th>Codigo de Clase</th>
                        <th>Nombre de Clase</th>
                        <th>Docente</th>
                        <th>Seccion</th>
                        <th>Subir Notas</th>
                        <th>Visualizar Notas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>IS111</td>
                        <td>Programacion 2</td>
                        <td>Mirna Raudales</td>
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
                        <td>IS111</td>
                        <td>Programacion 2</td>
                        <td>Fernando Quijano</td>
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
                        <td>IS111</td>
                        <td>Programacion 2</td>
                        <td>Ramon Ortiz</td>
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
            <a href="notas.php">
                <button class="action-btn" style="margin-top: 10px;">Retroceder</button> 
            </a> 





    </div>

    


    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>