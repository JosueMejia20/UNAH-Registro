<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recursos</title>
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
        <h1 class="main-title">Recursos de Asignatura</h1>

            <table class="requests-table">
                <thead>
                    <tr>
                        <th>Nombre de Clase</th>
                        <th>Lista de Estudiantes</th>
                        <th>Video de Introduccion</th>
                        <th>PDF de Introduccion</th>
                    </tr>
                </thead>
                    <tbody id="tabla-clases">
                    <!-- Clases dinámicas -->
                    </tbody>
            </table>
    </div>
    


    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
    <script type="module" src="../../assets/js/Docentes/docente.js"></script>
</body>
</html>