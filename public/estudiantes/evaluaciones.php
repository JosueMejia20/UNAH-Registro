<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Chat - UNAH</title>
  <link rel="icon" href="https://lepidopterahonduras.wordpress.com/wp-content/uploads/2015/04/cropped-escudo-unah-22.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/../../assets/css/principal_components.css" />
  <link rel="stylesheet" href="/../../assets/css/estudiante_style.css" />
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
      <div class="header">
        <h2>Evaluación Docente</h2>
        <p class="mb-0">Completa las evaluaciones para ver tus calificaciones</p>
      </div>
      
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h5 class="mb-0">Evaluaciones Pendientes</h5>
            </div>
            <div class="card-body">
              <div class="alert alert-unah mb-4">
                <p class="mb-0">Debes completar todas las evaluaciones docentes para poder visualizar tus calificaciones finales.</p>
              </div>

              <div class="list-group">
                <!-- Matemática II -->
                <div class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Matemática II</h5>
                    <small class="text-warning">Pendiente</small>
                  </div>
                  <p class="mb-1">Prof. Juan Carlos Martínez</p>
                  <small>Período: I PAC 2023</small>
                  <button class="btn btn-sm btn-unah mt-2 btn-evaluar" 
                          data-asignatura="Matemática II" 
                          data-docente="Juan Carlos Martínez">Realizar Evaluación</button>
                </div>

                <!-- Física I -->
                <div class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Física I</h5>
                    <small class="text-warning">Pendiente</small>
                  </div>
                  <p class="mb-1">Prof. Ana Lucia Fernández</p>
                  <small>Período: I PAC 2023</small>
                  <button class="btn btn-sm btn-unah mt-2 btn-evaluar" 
                          data-asignatura="Física I" 
                          data-docente="Ana Lucia Fernández">Realizar Evaluación</button>
                </div>

                <!-- Inglés Técnico -->
                <div class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Inglés Técnico</h5>
                    <small class="text-success">Completada</small>
                  </div>
                  <p class="mb-1">Prof. María José García</p>
                  <small>Período: I PAC 2023</small>
                  <button class="btn btn-sm btn-outline-secondary mt-2">Ver Evaluación</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Progreso -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h5 class="mb-0">Progreso</h5>
            </div>
            <div class="card-body text-center">
              <div class="mb-4">
                <div class="d-flex justify-content-center mb-2">
                  <div class="circular-progress" style="width: 120px; height: 120px; background: conic-gradient(var(--unah-blue) 66%, var(--blue-gray) 0); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <div style="width: 90px; height: 90px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.5rem;">
                      66%
                    </div>
                  </div>
                </div>
                <p class="mb-0">Evaluaciones completadas</p>
              </div>

              <div class="alert alert-info">
                <small>Las evaluaciones son anónimas y confidenciales.</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <!-- MODAL DE EVALUACIÓN -->
  <div class="modal fade" id="modalEvaluacion" tabindex="-1" aria-labelledby="modalEvaluacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <form id="form-evaluacion">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEvaluacionLabel">Evaluación Docente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <p><strong>Asignatura:</strong> <span id="eval-asignatura"></span><br>
               <strong>Docente:</strong> <span id="eval-docente"></span></p>

            <p class="text-muted">Selecciona una opción para cada pregunta (1: Muy en desacuerdo - 5: Muy de acuerdo).</p>

            <!-- Preguntas de Evaluación -->
            <div class="mb-3">
              <label>1. El docente demuestra dominio de la asignatura.</label>
              <div>
                <input type="radio" name="preg1" value="1"> 1
                <input type="radio" name="preg1" value="2"> 2
                <input type="radio" name="preg1" value="3"> 3
                <input type="radio" name="preg1" value="4"> 4
                <input type="radio" name="preg1" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>2. El docente fomenta la participación activa del estudiante.</label>
              <div>
                <input type="radio" name="preg2" value="1"> 1
                <input type="radio" name="preg2" value="2"> 2
                <input type="radio" name="preg2" value="3"> 3
                <input type="radio" name="preg2" value="4"> 4
                <input type="radio" name="preg2" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>3. El docente utiliza recursos didácticos adecuados.</label>
              <div>
                <input type="radio" name="preg3" value="1"> 1
                <input type="radio" name="preg3" value="2"> 2
                <input type="radio" name="preg3" value="3"> 3
                <input type="radio" name="preg3" value="4"> 4
                <input type="radio" name="preg3" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>4. El docente evalúa de manera justa y objetiva.</label>
              <div>
                <input type="radio" name="preg4" value="1"> 1
                <input type="radio" name="preg4" value="2"> 2
                <input type="radio" name="preg4" value="3"> 3
                <input type="radio" name="preg4" value="4"> 4
                <input type="radio" name="preg4" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>5. Observaciones (opcional)</label>
              <textarea class="form-control" name="observaciones" rows="3" placeholder="Comentarios adicionales..."></textarea>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-unah">Enviar Evaluación</button>
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- SCRIPTS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
  <script>
    document.querySelectorAll('.btn-evaluar').forEach(btn => {
      btn.addEventListener('click', () => {
        document.getElementById('eval-asignatura').textContent = btn.dataset.asignatura;
        document.getElementById('eval-docente').textContent = btn.dataset.docente;
        const modal = new bootstrap.Modal(document.getElementById('modalEvaluacion'));
        modal.show();
      });
    });

    document.getElementById("form-evaluacion").addEventListener("submit", function(e) {
      e.preventDefault();
      alert("¡Gracias por completar la evaluación!");
      const modal = bootstrap.Modal.getInstance(document.getElementById('modalEvaluacion'));
      modal.hide();
      this.reset();
    });
  </script>
</body>
</html>
