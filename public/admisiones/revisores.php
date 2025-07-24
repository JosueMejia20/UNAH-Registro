<?php
    session_start();

    if (!isset($_SESSION['usuario_id'])) {
        header("Location: login_revisores.php");
        exit();
    }
?>

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Revisión - Admisiones UNAH</title>
    <link rel="icon" href="https://lepidopterahonduras.wordpress.com/wp-content/uploads/2015/04/cropped-escudo-unah-22.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/../../assets/css/principal_components.css">
  <link rel="stylesheet" href="/../../assets/css/revisores_style.css">
</head>
<body>
    <unah-navbar></unah-navbar>

    <div class="revisor">

      <div class="container mb-5">
          <!-- Contador de solicitudes -->
          <div class="d-flex justify-content-between align-items-center mb-4">
              <h4 class="mb-0">Revisión de Solicitudes</h4>
              <div class="solicitud-counter">
                <div class="requests-count">Solicitudes pendientes: <span id="pendingCount">0</span></div>

              </div>
          </div>
  
          <!-- Tarjeta de solicitud -->
          <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                  <span id="numeroSolicitud"><i class="bi bi-file-earmark-text"></i></span>
                  <span class="status-badge status-pendiente">Pendiente de revisión</span>
              </div>
              <div class="card-body" id="card-body">
                  <!-- Datos del solicitante -->
                  <div class="solicitud-info">
                      <h5 class="section-title"><i class="bi bi-person"></i> Datos del Solicitante</h5>
                      
                      <!-- Datos Personales -->
                      <h6 class="mb-3"><i class="bi bi-person-vcard"></i> Datos Personales</h6>
                      
                      <div class="field-container">
                          <div class="field-content">
                              <span class="info-label">Nombre completo:</span>
                              <p id="nombrePostulante"></p>
                          </div>
                          <div class="field-validation">
                              <div class="checkbox-group">
                                  <input type="checkbox" id="nombre-correcto" name="nombre-validation" value="correcto">
                                  <label for="nombre-correcto">Correcto</label>
                              </div>
                              <div class="checkbox-group">
                                  <input type="checkbox" id="nombre-incorrecto" name="nombre-validation" value="incorrecto">
                                  <label for="nombre-incorrecto">Incorrecto</label>
                              </div>
                          </div>
                      </div>
                      
                      <div class="field-container">
                          <div class="field-content">
                              <span class="info-label">Identificación:</span>
                              <p id="identidadPostulante"></p>
                          </div>
                          <div class="field-validation">
                              <div class="checkbox-group">
                                  <input type="checkbox" id="identificacion-correcto" name="identificacion-validation" value="correcto">
                                  <label for="identificacion-correcto">Correcto</label>
                              </div>
                              <div class="checkbox-group">
                                  <input type="checkbox" id="identificacion-incorrecto" name="identificacion-validation" value="incorrecto">
                                  <label for="identificacion-incorrecto">Incorrecto</label>
                              </div>
                          </div>
                      </div>
                      
                      <div class="field-container">
                          <div class="field-content">
                              <span class="info-label">Fecha de nacimiento:</span>
                              <p id="fechaNacimientoPostulante"></p>
                          </div>
                          <div class="field-validation">
                              <div class="checkbox-group">
                                  <input type="checkbox" id="fecha-correcto" name="fecha-validation" value="correcto">
                                  <label for="fecha-correcto">Correcto</label>
                              </div>
                              <div class="checkbox-group">
                                  <input type="checkbox" id="fecha-incorrecto" name="fecha-validation" value="incorrecto">
                                  <label for="fecha-incorrecto">Incorrecto</label>
                              </div>
                          </div>
                      </div>
                      
                      <div class="field-container">
                          <div class="field-content">
                              <span class="info-label">Género:</span>
                              <p id="generoPostulante">Masculino</p>
                          </div>
                          <div class="field-validation">
                              <div class="checkbox-group">
                                  <input type="checkbox" id="genero-correcto" name="genero-validation" value="correcto">
                                  <label for="genero-correcto">Correcto</label>
                              </div>
                              <div class="checkbox-group">
                                  <input type="checkbox" id="genero-incorrecto" name="genero-validation" value="incorrecto">
                                  <label for="genero-incorrecto">Incorrecto</label>
                              </div>
                          </div>
                      </div>
                      
                      <div class="field-container">
                          <div class="field-content">
                              <span class="info-label">Estado civil:</span>
                              <p id="estadoCivilPostulante"></p>
                          </div>
                          <div class="field-validation">
                              <div class="checkbox-group">
                                  <input type="checkbox" id="estado-civil-correcto" name="estado-civil-validation" value="correcto">
                                  <label for="estado-civil-correcto">Correcto</label>
                              </div>
                              <div class="checkbox-group">
                                  <input type="checkbox" id="estado-civil-incorrecto" name="estado-civil-validation" value="incorrecto">
                                  <label for="estado-civil-incorrecto">Incorrecto</label>
                              </div>
                          </div>
                      </div>
                      
                      <!-- Información de Contacto -->
                      <h6 class="mb-3 mt-4"><i class="bi bi-geo-alt"></i> Información de Contacto</h6>
                      
                      <div class="field-container">
                          <div class="field-content">
                              <span class="info-label">Dirección:</span>
                              <p id="direccionPostulante"></p>
                          </div>
                          <div class="field-validation">
                              <div class="checkbox-group">
                                  <input type="checkbox" id="direccion-correcto" name="direccion-validation" value="correcto">
                                  <label for="direccion-correcto">Correcto</label>
                              </div>
                              <div class="checkbox-group">
                                  <input type="checkbox" id="direccion-incorrecto" name="direccion-validation" value="incorrecto">
                                  <label for="direccion-incorrecto">Incorrecto</label>
                              </div>
                          </div>
                      </div>
                      
                      <div class="field-container">
                          <div class="field-content">
                              <span class="info-label">Teléfono:</span>
                              <p id="telefonoPostulante"></p>
                          </div>
                          <div class="field-validation">
                              <div class="checkbox-group">
                                  <input type="checkbox" id="telefono-correcto" name="telefono-validation" value="correcto">
                                  <label for="telefono-correcto">Correcto</label>
                              </div>
                              <div class="checkbox-group">
                                  <input type="checkbox" id="telefono-incorrecto" name="telefono-validation" value="incorrecto">
                                  <label for="telefono-incorrecto">Incorrecto</label>
                              </div>
                          </div>
                      </div>
                      
                      <div class="field-container">
                          <div class="field-content">
                              <span class="info-label">Correo electrónico:</span>
                              <p id="correoPostulante"></p>
                          </div>
                          <div class="field-validation">
                              <div class="checkbox-group">
                                  <input type="checkbox" id="email-correcto" name="email-validation" value="correcto">
                                  <label for="email-correcto">Correcto</label>
                              </div>
                              <div class="checkbox-group">
                                  <input type="checkbox" id="email-incorrecto" name="email-validation" value="incorrecto">
                                  <label for="email-incorrecto">Incorrecto</label>
                              </div>
                          </div>
                      </div>
                      
                      <!-- Información Académica -->
                      <h6 class="mb-3 mt-4"><i class="bi bi-book"></i> Información Académica</h6>
                      
                      <div class="field-container">
                          <div class="field-content">
                              <span class="info-label">Instituto de Educación Media:</span>
                              <p id="institutoPostulante"></p>
                          </div>
                          <div class="field-validation">
                              <div class="checkbox-group">
                                  <input type="checkbox" id="instituto-correcto" name="instituto-validation" value="correcto">
                                  <label for="instituto-correcto">Correcto</label>
                              </div>
                              <div class="checkbox-group">
                                  <input type="checkbox" id="instituto-incorrecto" name="instituto-validation" value="incorrecto">
                                  <label for="instituto-incorrecto">Incorrecto</label>
                              </div>
                          </div>
                      </div>
                      
                      <div class="field-container">
                          <div class="field-content">
                              <span class="info-label">Año de graduación:</span>
                              <p id="anioGraduacionPostulante"></p>
                          </div>
                          <div class="field-validation">
                              <div class="checkbox-group">
                                  <input type="checkbox" id="graduacion-correcto" name="graduacion-validation" value="correcto">
                                  <label for="graduacion-correcto">Correcto</label>
                              </div>
                              <div class="checkbox-group">
                                  <input type="checkbox" id="graduacion-incorrecto" name="graduacion-validation" value="incorrecto">
                                  <label for="graduacion-incorrecto">Incorrecto</label>
                              </div>
                          </div>
                      </div>
                      
                      <div class="field-container">
                          <div class="field-content">
                              <span class="info-label">Centro Regional:</span>
                              <p id="centroRegionalPostulante"></p>
                          </div>
                          <div class="field-validation">
                              <div class="checkbox-group">
                                  <input type="checkbox" id="centro-correcto" name="centro-validation" value="correcto">
                                  <label for="centro-correcto">Correcto</label>
                              </div>
                              <div class="checkbox-group">
                                  <input type="checkbox" id="centro-incorrecto" name="centro-validation" value="incorrecto">
                                  <label for="centro-incorrecto">Incorrecto</label>
                              </div>
                          </div>
                      </div>
                      
                      <div class="field-container">
                          <div class="field-content">
                              <span class="info-label">Carrera (1ra opción):</span>
                              <p id="carreraPrimariaPostulante"></p>
                          </div>
                          <div class="field-validation">
                              <div class="checkbox-group">
                                  <input type="checkbox" id="carrera1-correcto" name="carrera1-validation" value="correcto">
                                  <label for="carrera1-correcto">Correcto</label>
                              </div>
                              <div class="checkbox-group">
                                  <input type="checkbox" id="carrera1-incorrecto" name="carrera1-validation" value="incorrecto">
                                  <label for="carrera1-incorrecto">Incorrecto</label>
                              </div>
                          </div>
                      </div>
                      
                      <div class="field-container">
                          <div class="field-content">
                              <span class="info-label">Carrera (2da opción):</span>
                              <p id="carreraSecundariaPostulante"></p>
                          </div>
                          <div class="field-validation">
                              <div class="checkbox-group">
                                  <input type="checkbox" id="carrera2-correcto" name="carrera2-validation" value="correcto">
                                  <label for="carrera2-correcto">Correcto</label>
                              </div>
                              <div class="checkbox-group">
                                  <input type="checkbox" id="carrera2-incorrecto" name="carrera2-validation" value="incorrecto">
                                  <label for="carrera2-incorrecto">Incorrecto</label>
                              </div>
                          </div>
                      </div>
                      
                      <!-- Comentarios generales -->
                      <div class="comentarios-box">
                          <label for="comentarios-generales" class="form-label info-label">Comentarios generales:</label>
                          <textarea class="comentario-input" id="comentarios-generales" placeholder="Escriba aquí sus observaciones generales sobre la solicitud..."></textarea>
                      </div>
                  </div>
  
                  <!-- Documento principal -->
                  <div class="document-section">
                      <h5 class="section-title"><i class="bi bi-file-earmark-pdf"></i> Documento Adjunto</h5>
                      <div class="document-info">
                          <div class="document-title">
                              <i class="bi bi-filetype-pdf"></i> Título de Educación Media.pdf
                              <span class="badge bg-secondary ms-2">5.2 MB</span>
                          </div>
                          <div class="document-actions">
                              <button class="btn btn-sm btn-outline-primary">
                                  <i class="bi bi-download"></i> Descargar
                              </button>
                              <button class="btn btn-sm btn-outline-secondary">
                                  <i class="bi bi-printer"></i> Imprimir
                              </button>
                          </div>
                      </div>
                      <div class="document-viewer" style="max-width: 80%; margin: 0 auto; text-align: center; overflow: auto; border:1px solid #ccc;">
                          <img id="documentImage" src="" style="max-width: 100%; text-align: center; height: auto; display: block;">
                      </div>
                      
                      <!-- Área de comentarios sobre el documento -->
                      <div class="comentarios-box">
                          <label for="comentarios-documento" class="form-label info-label">Comentarios sobre el documento:</label>
                          <textarea class="comentario-input" id="comentarios-documento" placeholder="Escriba aquí sus observaciones específicas sobre el documento..."></textarea>
                      </div>
                  </div>
  
                  <!-- Botones de acción -->
                  <div class="actions-footer">
                      <div class="d-flex gap-3">
                          <button type="button" class="btn btn-reject" id="rejectBtn">
                              <i class="bi bi-x-circle"></i> Rechazar Solicitud
                          </button>
                          <button type="button" class="btn btn-accept" id="acceptBtn">
                              <i class="bi bi-check-circle"></i> Aprobar Solicitud
                          </button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>

    <unah-footer></unah-footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../../assets/js/mainRevisores.js"></script>
    <script type="module" src="../../assets/js/main.js"></script>

    <script>
        const id = localStorage.getItem('idRevisor');
        if (!id) {
            alert("Debes iniciar sesión");
            window.location.href = "../login.php";
        }
    </script>
</body>
</html>