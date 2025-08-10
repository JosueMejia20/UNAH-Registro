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
  <title>Perfil Docente</title>
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
    ]'
    sidebar-title="Portal Docente UNAH"
    user-name="Docente"></unah-sidebar>

  <div class="container_principal">

    <div class="perfil-card ">
      <div class="row align-items-center">
        <div class="col-md-2 imagen-perfil">
          <img id="foto-perfil-docente" src="ruta-de-la-imagen.jpg" alt="Foto de perfil">
        </div>
        <div class="col-md-6">
          <p class="titulo">Bienvenido Docente</p>
          <p id="nombre-docente" class="nombre"></p>
        </div>
        <div class="col-md-4 text-end">
          <button class="btn btn-yellow me-2" id="btn-subir-foto">Actualizar Foto de Perfil</button>
        </div>
      </div>
    </div>
    <div class="contenedor_info">
      <div class="izquierda">
        <div class="perfil-info">
          <div class="izquierda-header">
              <h4>Información Personal</h4>
          </div>
          <p id="numero-empleado"></p>
          <p id="correo-institucional"></p>
          <p id="cargos"></p>
          <p id="centro-regional"></p>
        </div>
      </div>


      <div class="derecha">
        <div class="perfil-info">
          <div class="derecha-header">
              <h4>Información Academica</h4>
          </div>
          <p id="facultad"></p>
          <p id="departamento"></p>
        </div>
      </div>
    </div>

  </div>

  <!-- MODAL DE EDICIÓN -->
  <div class="modal fade" id="modalSubirFoto" tabindex="-1" aria-labelledby="subirFotoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-warning text-dark">
          <h5 class="modal-title" id="subirFotoLabel">Subir Foto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <form id="formSubirFoto" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="foto_perfil" class="form-label">Foto de Perfil</label>
                <input type="file" class="form-control" id="foto_perfil" name="foto_perfil" accept="image/*">
              </div>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-success">Guardar Cambios</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script>
    const usuarioId = <?php echo json_encode($_SESSION['usuario_id']); ?>;
    console.log("ID del usuario desde sesion PHP:", usuarioId);
  </script>
  <script type="module" src="../../assets/js/Docentes/mainPerfilDocente.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>