<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat - UNAH</title>
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
      {"label": "Evaluacion Docente", "href": "evaluaciones.php"}
    ]'></unah-sidebar>

    <main class="main-content p-4">
      <div class="header animate__animated animate__fadeIn">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h2><i class="fas fa-comments me-2" style="color: var(--unah-blue);"></i> Chat</h2>
            <p class="mb-0">Comunícate con tus amigos</p>
          </div>
          <div>
            <button id="agregarAmigoBtn" class="btn btn-primary">
              <i class="fas fa-user-plus me-1"></i> Agregar amigo
            </button>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Columna izquierda: Contactos y Solicitudes -->
        <div class="col-md-4">
          <!-- Contactos -->
          <div class="card animate__animated animate__fadeInUp">
            <div class="card-header">
              <h5 class="mb-0"><i class="fas fa-users me-2"></i>Contactos</h5>
            </div>
            <div class="card-body p-0">
              <div id="listaContactos" class="list-group list-group-flush">
                <!--
                <a href="#" class="list-group-item list-group-item-action active">
                  <div class="d-flex align-items-center">
                    <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="...">
                    <div>
                      <h6 class="mb-0">Departamento Académico</h6>
                      <small>En línea</small>
                    </div>
                    <span class="badge bg-white text-dark ms-auto">3</span>
                  </div>
                </a>
    -->
              </div>
            </div>
            <div class="card-footer">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar contacto...">
                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>

          <!-- Mis Solicitudes -->
          <div class="card mt-3 animate__animated animate__fadeInUp">
            <div class="card-header">
              <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Mis Solicitudes</h5>
            </div>
            <div class="card-body p-0">
              <ul class="list-group list-group-flush" id="listaSolicitudes">
                <!--Se cargan las solicitudes dinamicamente-->
              </ul>
            </div>
          </div>

        </div>

        <!-- Columna derecha: Conversación -->
        <div class="col-md-8">
          <div class="card animate__animated animate__fadeInUp animate__delay-1s">
            <div class="card-header d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center">
                <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="...">
                <div>
                  <h5 id="headerMensaje" class="mb-0">Ventana de Chat</h5>
                  <small class="text-success"></small>
                </div>
              </div>
            </div>
            <div id="contenedorChat" class="card-body chat-container" style="height: 400px; overflow-y: auto; background-color: #f8f9fa;">
              <!-- Mensajes -->

            </div>
            <div class="card-footer">
              <div class="input-group">
                <input id="inputMensaje" type="text" class="form-control" placeholder="Escribe un mensaje...">
                <button id="enviarMensajeBtn" class="btn btn-unah" type="button"><i class="fas fa-paper-plane">Enviar</i></button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal para mandar una solicitud -->

      <div class="modal fade" id="modalAgregarAmigo" tabindex="-1" aria-labelledby="editarPerfilLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
              <h5 class="modal-title" id="agregarAmigoLabel">Agregar a un amigo estudiante como contacto</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              <form id="formAgregarAmigo" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="estudiante" class="form-label">Correo institucional de tu nuevo contacto</label>
                    <input type="text" class="form-control" id="estudianteAmigoId" name="correo_receptor" required>
                  </div>
                </div>
                <div class="text-end">
                  <button type="submit" class="btn btn-success">Enviar Solicitud de Contacto</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script type="module" src="../../assets/js/mainChat.js"></script>
</body>

</html>