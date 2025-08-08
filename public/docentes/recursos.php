<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
  header("Location: loginDocente.php");
  exit();
}
?>


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

    <div class="perfil-card">
      <div class="imagen-perfil">
        <img src="ruta-de-la-imagen.jpg" alt="Foto de perfil">
      </div>
      <div class="info-perfil">
        <p class="titulo">Recursos</p>
        <p id="nombreDocente" class="nombre">Ricardo Figueroa</p>
      </div>
    </div>


    <table class="requests-table">
      <thead>
        <tr>
          <th>Nombre de Clase</th>
          <th>Video de Introduccion</th>
          <th>PDF de Introduccion</th>
          <th>Subir Recursos</th>
        </tr>
      </thead>
      <tbody id="tabla-clases">
        <!-- Clases dinámicas -->
      </tbody>
    </table>
  </div>



  <script>
    const usuarioId = <?php echo json_encode($_SESSION['usuario_id']); ?>;
    console.log("ID del usuario desde sesion PHP:", usuarioId);
  </script>
  <script type="module" src="../../assets/js/Docentes/mainRecursosIntroduccion.js"></script>
</body>

</html>