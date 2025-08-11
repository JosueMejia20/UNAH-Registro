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
  <title>Matrícula - UNAH</title>
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
      <div class="header">
    <h2>Matrícula y Cancelación de Secciones</h2>
    <p class="mb-0">Realiza tu matrícula académica y gestiona tus secciones</p>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="matriculaTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="matricula-tab" data-bs-toggle="tab" data-bs-target="#matricula" type="button" role="tab" aria-controls="matricula" aria-selected="true">Matrícula</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cancelacion-tab" data-bs-toggle="tab" data-bs-target="#cancelacion" type="button" role="tab" aria-controls="cancelacion" aria-selected="false">Cancelación</button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="matriculaTabsContent">
                    <!-- Contenido MATRÍCULA -->
                    <div class="tab-pane fade show active" id="matricula" role="tabpanel" aria-labelledby="matricula-tab">
                        <div class="row">
                            <!-- Clasificación -->
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">Departamento de Asignatura</label>
                                <select id="departamentosClases" class="form-select" size="15">
                                    <option selected disabled>Selecciona un Departamento</option>
                                </select>
                            </div>

                            <!-- Asignatura -->
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">Asignatura</label>
                                <select id="clasesDepartamentos" class="form-select" size="15">
                                    <option selected disabled>Selecciona una asignatura</option>
                                </select>
                            </div>

                            <!-- Horarios -->
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">Horarios Disponibles</label>
                                <select id="horarios" class="form-select" size="15">
                                    <option selected disabled>Selecciona un horario</option>
                                </select>
                            </div>
                        </div>

                        <!-- Botón Matricular -->
                        <div class="text-center">
                            <button class="btn btn-unah px-5 py-2">Matricular</button>
                        </div>

                        <!-- Horario Generado -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="mb-0">Horario Generado</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th>Hora</th>
                                                <th>Lunes</th>
                                                <th>Martes</th>
                                                <th>Miércoles</th>
                                                <th>Jueves</th>
                                                <th>Viernes</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBodyHorarioGenerado">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /Horario Generado -->

                    </div>

                    <!-- Contenido CANCELACIÓN -->
                    <div class="tab-pane fade" id="cancelacion" role="tabpanel" aria-labelledby="cancelacion-tab">
                        <div class="alert alert-unah mb-4">
                            <h5>Período de Cancelación</h5>
                            <p class="mb-0">Puedes cancelar asignaturas durante el período de matrícula sin penalización.</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 40px;"></th>
                                        <th>Código</th>
                                        <th>Asignatura</th>
                                        <th>Sección</th>
                                        <th>Horario</th>
                                        <th>Docente</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaCancelacion">
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAllCancel">
                                <label class="form-check-label" for="selectAllCancel">
                                    Seleccionar todas
                                </label>
                            </div>
                            <button class="btn btn-danger">
                                Cancelar seleccionadas
                            </button>
                        </div>
                    </div>
                </div> <!-- /.tab-content -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col-md-12 -->
</div> <!-- /.row -->
    </main>
  </div>

  <!-- Overlay de carga -->
    <div id="overlayCarga">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
    </div>

    <unah-modal></unah-modal>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>
