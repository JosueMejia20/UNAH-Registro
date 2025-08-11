<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
  header("Location: login_estudiantes.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Solicitudes - UNAH</title>
  <link rel="icon" href="https://lepidopterahonduras.wordpress.com/wp-content/uploads/2015/04/cropped-escudo-unah-22.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/../../assets/css/principal_components.css">
  <link rel="stylesheet" href="/../../assets/css/estudiante_style.css">
</head>

<body>
  <unah-navbar></unah-navbar>

  <div class="container-completo">
    <unah-sidebar menu-items='[
      {"label": "Perfil", "href": "perfil.php"},
      {"label": "Matrícula", "href": "matricula.php"},
      {"label": "Chat", "href": "chat.php"},
      {"label": "Gestión de Solicitudes", "href": "solicitudes.php"},
      {"label": "Perfil de Docentes", "href": "perfil_docentes.php"},
      {"label": "Certificado Académico", "href": "certificado.php"},
      {"label": "Evaluacion Docente", "href": "evaluaciones.php"},
      {"label": "Ver clases", "href": "ver_clases.php"}
    ]'></unah-sidebar>

    <main class="main-content p-4">
      <div class="header animate__animated animate__fadeIn">
        <h2><i class="fas fa-file-alt me-2" style="color: var(--unah-blue);"></i> Gestión de Solicitudes</h2>
        <p class="mb-0">Realiza y da seguimiento a tus solicitudes académicas</p>
      </div>

      <div class="row">
        <div class="col-md-8">
          <div class="card animate__animated animate__fadeInUp">
            <div class="card-header">
              <h5 class="mb-0"><i class="fas fa-list me-2"></i>Solicitudes Recientes</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th># Solicitud</th>
                      <th>Tipo</th>
                      <th>Fecha</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody id="tablaBodySolicitudes">
                    <!-- Se cargan dinamicamente en mainSolicitudesEstudiantes.js -->
                  </tbody>
                </table>
              </div>

              <nav id="paginacion-solicitudes" aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Anterior</a>
                  </li>
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">Siguiente</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card animate__animated animate__fadeInUp animate__delay-1s">
            <div class="card-header">
              <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Nueva Solicitud</h5>
            </div>
            <div class="card-body">
              <div class="d-grid gap-2">
                <button id="cambioCarreraBtn" class="btn btn-unah mb-2" type="button">
                  <i class="fas fa-exchange-alt me-2"></i>Cambio de Carrera
                </button>
                <button id="cambioCentroBtn" class="btn btn-unah mb-2" type="button">
                  <i class="fas fa-ban me-2"></i>Cambio de Centro Regional
                </button>
                <button id="pagoReposicionBtn" class="btn btn-unah mb-2" type="button">
                  <i class="fas fa-redo me-2"></i>Pago de Reposicion
                </button>
                <button id="cancelacionExcepcionalBtn" class="btn btn-unah mb-2" type="button">
                  <i class="fas fa-calendar-times me-2"></i>Cancelación Excepcional de Asignatura
                </button>


              </div>
            </div>
          </div>

          <div class="card animate__animated animate__fadeInUp animate__delay-2s mt-3">
            <div class="card-header">
              <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información Importante</h5>
            </div>
            <div class="card-body">
              <div class="alert alert-warning">
                <h6><i class="fas fa-exclamation-triangle me-2"></i>Plazos de solicitud</h6>
                <p class="mb-0">Las solicitudes de cambio de carrera solo se reciben hasta el 30 de abril.</p>
              </div>

              <div class="alert alert-info">
                <h6><i class="fas fa-clock me-2"></i>Tiempos de respuesta</h6>
                <ul class="mb-0">
                  <li>Cambio de carrera: 15 días hábiles</li>
                  <li>Cancelaciones: 5 días hábiles</li>
                  <li>Reposiciones: 7 días hábiles</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Modales para las solicitudes -->
      <!-- Modales para cambio de carrera -->
      <div class="modal fade" id="modalCambioDeCarrera" tabindex="-1" aria-labelledby="editarPerfilLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
              <h5 class="modal-title" id="cambioCarreraLabel">Cambio de Carrera</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              <form id="formCambioCarrera" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label for="carreraNueva" class="form-label">Carrera Nueva a Inscribir</label>
                    <select class="form-select" id="carreraNueva" name="carreraNueva" required>
                      <!-- Las opciones serán agregadas dinámicamente -->
                    </select>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="justificacionCambioCarrera" class="form-label">Justificación</label>
                    <textarea class="form-control" id="justificacionCambioCarrera" name="justificacionCambioCarrera" rows="4" placeholder="Escribe una justificación..." required></textarea>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="archivoPDF" class="form-label">Adjuntar archivo PDF</label>
                    <input type="file" class="form-control" id="archivoPDF" name="archivoPDF" accept="application/pdf" required>
                  </div>
                </div>
                <div class="text-end">
                  <button type="submit" class="btn btn-success">Enviar Solicitud</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Modales para Cambio de Centro Regional -->
      <div class="modal fade" id="modalCambioCentro" tabindex="-1" aria-labelledby="editarPerfilLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
              <h5 class="modal-title" id="cambioCentroLabel">Cambio de Centro Regional</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              <form id="formCambioCentro" enctype="multipart/form-data">
                <div class="row">

                  <div class="col-md-12 mb-3">
                    <label for="centroNuevo" class="form-label">Centro Nuevo a Inscribir</label>
                    <select class="form-select" id="centroNuevo" name="centroNuevo" required>
                      <!-- Las opciones serán agregadas dinámicamente -->
                    </select>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label for="justificacionCambioCentro" class="form-label">Justificación</label>
                    <textarea class="form-control" id="justificacionCambioCentro" name="justificacionCambioCentro" rows="4" placeholder="Escribe una justificación..." required></textarea>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label for="archivoPDF" class="form-label">Adjuntar archivo PDF</label>
                    <input type="file" class="form-control" id="archivoPDF" name="archivoPDF" accept="application/pdf" required>
                  </div>
                </div>
                <div class="text-end">
                  <button type="submit" class="btn btn-success">Enviar Solicitud</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal para Pago de Reposicion -->

      <div class="modal fade" id="modalPagoRepo" tabindex="-1" aria-labelledby="editarPerfilLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
              <h5 class="modal-title" id="pagoRepoLabel">Pago de Reposicion</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              <form id="formPagoRepo" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label for="observacionPagoRepo" class="form-label">Observación</label>
                    <textarea class="form-control" id="observacionPagoRepo" name="observacionPagoRepo" rows="4" placeholder="Escribe tu observación aquí..." required></textarea>
                  </div>
                </div>
                <div class="text-end">
                  <button type="submit" class="btn btn-success">Enviar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Modales para Cancelacion Excepcional -->

      <div class="modal fade" id="modalCancelacionExcep" tabindex="-1" aria-labelledby="editarPerfilLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
              <h5 class="modal-title" id="cambioCarreraLabel">Cancelacion Excepcional de Asignaturas</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              <form id="formCancelacionExcep" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label for="justificacionCancelacion" class="form-label">Justificación del porque quiere cancelar la seccion</label>
                    <textarea class="form-control" id="justificacionCancelacion" name="justificacionCancelacion" rows="4" required></textarea>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label for="selectSeccionesCancelar" class="form-label">Seleccione la seccion para cancelar</label>
                    <select class="form-select" id="selectSeccionesCancelar" name="seccionId" required>
                      <!-- Opciones dinamicas -->
                    </select>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label for="archivoPDF" class="form-label">Adjuntar archivo PDF</label>
                    <input type="file" class="form-control" id="archivoPDF" name="archivoPDF" accept="application/pdf" required>
                  </div>
                </div>

                <div class="text-end">
                  <button type="submit" class="btn btn-success">Enviar Solicitud</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>


    </main>
  </div>

  <!-- Overlay de carga -->
  <div id="overlayCarga">
    <div class="spinner-border" role="status">
      <span class="visually-hidden">Cargando...</span>
    </div>
  </div>

  <unah-modal></unah-modal>

  <script>
    const usuarioId = <?php echo json_encode($_SESSION['usuario_id']); ?>;
    console.log("ID del usuario desde sesion PHP:", usuarioId);
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!--<script type="module" src="../../assets/js/mainEstudiantes.js"></script>-->
  <script type="module" src="../../assets/js/mainSolicitudesEstudiantes.js"></script>
</body>

</html>