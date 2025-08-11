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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
      {"label": "Evaluacion Docente", "href": "evaluaciones.php"},
      {"label": "Ver clases", "href": "ver_clases.php"}
    ]'></unah-sidebar>

    <main class="main-content p-4">
      <div class="header">
        <h2>Evaluación Docente</h2>
        <p class="mb-0">Completa las evaluaciones para ver tus calificaciones</p>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="mb-0">Evaluaciones Pendientes</h5>
            </div>
            <div class="card-body">
              <div class="alert alert-unah mb-4">
                <p class="mb-0">Debes completar todas las evaluaciones docentes para poder visualizar tus calificaciones finales.</p>
              </div>

              <div id="listaClases" class="list-group">
                <!--
                <div class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Matemática II</h5>
                    <small class="text-warning">Pendiente</small>
                  </div>
                  <p class="mb-1">Prof. Juan Carlos Martínez</p>
                  <small>Período: I PAC 2023</small>
                  <button class="btn btn-sm btn-unah mt-2 btn-evaluar"

                    onclick="abrirModalEvaluacion(' ', ' ')">Realizar Evaluación</button>
                </div>
    -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <!-- MODAL DE EVALUACIÓN -->
  <div class="modal fade" id="modalEvaluacion" tabindex="-1" aria-labelledby="modalEvaluacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="form-evaluacion">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEvaluacionLabel">Evaluación Docente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <p><strong>Asignatura:</strong> <span id="eval-asignatura"></span><br>
              <strong>Docente:</strong> <span id="eval-docente"></span>
            </p>

            <p class="text-muted">Selecciona una opción para cada pregunta (1: Muy en desacuerdo - 5: Muy de acuerdo).</p>

            <!-- Preguntas de Evaluación -->
            <div class="mb-3">
              <label>1. El docente demuestra estar actualizado y tener dominio de la disciplina que imparte</label>
              <div>
                <input type="radio" name="preg1" value="1"> 1
                <input type="radio" name="preg1" value="2"> 2
                <input type="radio" name="preg1" value="3"> 3
                <input type="radio" name="preg1" value="4"> 4
                <input type="radio" name="preg1" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>2. El contenido de la asignatura se desarrolla con adecuada profundidad para el nivel de educación universitaria</label>
              <div>
                <input type="radio" name="preg2" value="1"> 1
                <input type="radio" name="preg2" value="2"> 2
                <input type="radio" name="preg2" value="3"> 3
                <input type="radio" name="preg2" value="4"> 4
                <input type="radio" name="preg2" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>3. El docente indica las fuentes de consulta accesibles para el desarrollo de esta asignatura, tales como: libros, artículos de revistas científicas, investigaciones, blogs u otros</label>
              <div>
                <input type="radio" name="preg3" value="1"> 1
                <input type="radio" name="preg3" value="2"> 2
                <input type="radio" name="preg3" value="3"> 3
                <input type="radio" name="preg3" value="4"> 4
                <input type="radio" name="preg3" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>4. El docente vincula los contenidos de la asignatura con la realidad nacional y la responsabilidad ciudadana</label>
              <div>
                <input type="radio" name="preg4" value="1"> 1
                <input type="radio" name="preg4" value="2"> 2
                <input type="radio" name="preg4" value="3"> 3
                <input type="radio" name="preg4" value="4"> 4
                <input type="radio" name="preg4" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>5. El docente promueve en el desarrollo de la asignatura, la incorporación del estudiante en proyectos de investigación y vinculación universidad sociedad</label>
              <div>
                <input type="radio" name="preg5" value="1"> 1
                <input type="radio" name="preg5" value="2"> 2
                <input type="radio" name="preg5" value="3"> 3
                <input type="radio" name="preg5" value="4"> 4
                <input type="radio" name="preg5" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>6. El docente produce sus propios materiales de enseñanza (resúmenes, guías, ensayos, artículos publicados u otros) para facilitar el aprendizaje de los estudiantes y se tiene acceso a los mismos a través de la librería o biblioteca</label>
              <div>
                <input type="radio" name="preg6" value="1"> 1
                <input type="radio" name="preg6" value="2"> 2
                <input type="radio" name="preg6" value="3"> 3
                <input type="radio" name="preg6" value="4"> 4
                <input type="radio" name="preg6" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>7. El docente es autor de libros, ensayos, investigaciones u otras publicaciones sobre el campo del conocimiento y la disciplina que imparte</label>
              <div>
                <input type="radio" name="preg7" value="1"> 1
                <input type="radio" name="preg7" value="2"> 2
                <input type="radio" name="preg7" value="3"> 3
                <input type="radio" name="preg7" value="4"> 4
                <input type="radio" name="preg7" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>8. Al iniciar el periodo académico el docente le proporcionó en formato físico o digital el programa de la asignatura, conteniendo los objetivos de aprendizaje, temas, calendarización de clases y exámenes, formas y criterios de evaluación y otros</label>
              <div>
                <input type="radio" name="preg8" value="1"> 1
                <input type="radio" name="preg8" value="2"> 2
                <input type="radio" name="preg8" value="3"> 3
                <input type="radio" name="preg8" value="4"> 4
                <input type="radio" name="preg8" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>9. El docente evidencia la planificación adecuada de sus clases, secuencia lógica y dosificación de contenidos</label>
              <div>
                <input type="radio" name="preg9" value="1"> 1
                <input type="radio" name="preg9" value="2"> 2
                <input type="radio" name="preg9" value="3"> 3
                <input type="radio" name="preg9" value="4"> 4
                <input type="radio" name="preg9" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>10. El docente muestra dominio de técnicas pedagógicas para el proceso enseñanza aprendizaje a nivel universitario</label>
              <div>
                <input type="radio" name="preg10" value="1"> 1
                <input type="radio" name="preg10" value="2"> 2
                <input type="radio" name="preg10" value="3"> 3
                <input type="radio" name="preg10" value="4"> 4
                <input type="radio" name="preg10" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>11. En el desarrollo de la clase, el docente usa técnicas educativas que facilitan su aprendizaje de acuerdo a la modalidad de la enseñanza y los contenidos de la asignatura</label>
              <div>
                <input type="radio" name="preg11" value="1"> 1
                <input type="radio" name="preg11" value="2"> 2
                <input type="radio" name="preg11" value="3"> 3
                <input type="radio" name="preg11" value="4"> 4
                <input type="radio" name="preg11" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>12. Las actividades practicadas en esta asignatura están de acuerdo con los objetivos propuestos para la clase y con los contenidos desarrollados por el docente</label>
              <div>
                <input type="radio" name="preg12" value="1"> 1
                <input type="radio" name="preg12" value="2"> 2
                <input type="radio" name="preg12" value="3"> 3
                <input type="radio" name="preg12" value="4"> 4
                <input type="radio" name="preg12" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>13. El docente logra facilitar el aprendizaje de los contenidos de esta asignatura</label>
              <div>
                <input type="radio" name="preg13" value="1"> 1
                <input type="radio" name="preg13" value="2"> 2
                <input type="radio" name="preg13" value="3"> 3
                <input type="radio" name="preg13" value="4"> 4
                <input type="radio" name="preg13" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>14. La presentación del docente es pulcra y adecuada para un catedrático universitario</label>
              <div>
                <input type="radio" name="preg14" value="1"> 1
                <input type="radio" name="preg14" value="2"> 2
                <input type="radio" name="preg14" value="3"> 3
                <input type="radio" name="preg14" value="4"> 4
                <input type="radio" name="preg14" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>15. El docente asiste a la clase con puntualidad y según lo programado</label>
              <div>
                <input type="radio" name="preg15" value="1"> 1
                <input type="radio" name="preg15" value="2"> 2
                <input type="radio" name="preg15" value="3"> 3
                <input type="radio" name="preg15" value="4"> 4
                <input type="radio" name="preg15" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>16. El docente indicó el horario y el espacio físico para atender las consultas de los estudiantes</label>
              <div>
                <input type="radio" name="preg16" value="1"> 1
                <input type="radio" name="preg16" value="2"> 2
                <input type="radio" name="preg16" value="3"> 3
                <input type="radio" name="preg16" value="4"> 4
                <input type="radio" name="preg16" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>17. El docente está disponible y muestra buena disposición para atender a los estudiantes en las horas de consulta</label>
              <div>
                <input type="radio" name="preg17" value="1"> 1
                <input type="radio" name="preg17" value="2"> 2
                <input type="radio" name="preg17" value="3"> 3
                <input type="radio" name="preg17" value="4"> 4
                <input type="radio" name="preg17" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>18. El docente se esfuerza por facilitar el aprendizaje de los estudiantes con necesidades especiales</label>
              <div>
                <input type="radio" name="preg18" value="1"> 1
                <input type="radio" name="preg18" value="2"> 2
                <input type="radio" name="preg18" value="3"> 3
                <input type="radio" name="preg18" value="4"> 4
                <input type="radio" name="preg18" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>19. El docente trata en forma respetuosa y cordial a los estudiantes en todo momento</label>
              <div>
                <input type="radio" name="preg19" value="1"> 1
                <input type="radio" name="preg19" value="2"> 2
                <input type="radio" name="preg19" value="3"> 3
                <input type="radio" name="preg19" value="4"> 4
                <input type="radio" name="preg19" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>20. El docente tiene lenguaje y actuaciones propias de un profesor universitario</label>
              <div>
                <input type="radio" name="preg20" value="1"> 1
                <input type="radio" name="preg20" value="2"> 2
                <input type="radio" name="preg20" value="3"> 3
                <input type="radio" name="preg20" value="4"> 4
                <input type="radio" name="preg20" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>21. El docente promueve y practica los valores éticos y morales dentro y fuera de los espacios de aprendizaje</label>
              <div>
                <input type="radio" name="preg21" value="1"> 1
                <input type="radio" name="preg21" value="2"> 2
                <input type="radio" name="preg21" value="3"> 3
                <input type="radio" name="preg21" value="4"> 4
                <input type="radio" name="preg21" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>22. El docente se muestra identificado con los valores y principios institucionales</label>
              <div>
                <input type="radio" name="preg22" value="1"> 1
                <input type="radio" name="preg22" value="2"> 2
                <input type="radio" name="preg22" value="3"> 3
                <input type="radio" name="preg22" value="4"> 4
                <input type="radio" name="preg22" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>23. La asignación de calificaciones por el docente es justa, equitativa y transparente</label>
              <div>
                <input type="radio" name="preg23" value="1"> 1
                <input type="radio" name="preg23" value="2"> 2
                <input type="radio" name="preg23" value="3"> 3
                <input type="radio" name="preg23" value="4"> 4
                <input type="radio" name="preg23" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>24. Los resultados de las pruebas o exámenes y trabajos le son entregados oportunamente en un término máximo de 2 semanas y las calificaciones se registran en el sistema en el tiempo establecido</label>
              <div>
                <input type="radio" name="preg24" value="1"> 1
                <input type="radio" name="preg24" value="2"> 2
                <input type="radio" name="preg24" value="3"> 3
                <input type="radio" name="preg24" value="4"> 4
                <input type="radio" name="preg24" value="5"> 5
              </div>
            </div>

            <div class="mb-3">
              <label>25. El docente se adapta a las condiciones de trabajo, para desarrollar de la mejor forma los contenidos de la asignatura</label>
              <div>
                <input type="radio" name="preg25" value="1"> 1
                <input type="radio" name="preg25" value="2"> 2
                <input type="radio" name="preg25" value="3"> 3
                <input type="radio" name="preg25" value="4"> 4
                <input type="radio" name="preg25" value="5"> 5
              </div>
            </div>

            <!-- Observaciones y Evidencia -->
            <div class="mb-3">
              <label>Observaciones (opcional)</label>
              <textarea class="form-control" name="observaciones" rows="3" placeholder="Comentarios adicionales..."></textarea>
            </div>

            <div class="mb-3">
              <label for="archivo_pdf" class="form-label">Subir PDF de Evidencia (Opcional)</label>
              <input type="file" class="form-control" id="archivo_pdf" name="archivo_pdf" accept=".pdf">
              <small class="text-muted">Formatos aceptados: PDF</small>
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

  <!-- Overlay de carga -->
  <div id="overlayCarga">
    <div class="spinner-border" role="status">
      <span class="visually-hidden">Cargando...</span>
    </div>
  </div>

  <unah-modal></unah-modal>

  <!-- SCRIPTS -->
  <script>
    const usuarioId = <?php echo json_encode($_SESSION['usuario_id']); ?>;
    console.log("ID del usuario desde sesion PHP:", usuarioId);
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script type="module" src="../../assets/js/Estudiantes/mainEvaluaciones.js"></script>
</body>

</html>