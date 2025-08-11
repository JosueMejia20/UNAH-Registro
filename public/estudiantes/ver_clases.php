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
                <h2><i class="fas fa-chalkboard-teacher me-2" style="color: var(--unah-blue);"></i> Ver recursos de la clase</h2>
                <p class="mb-0">Consulta la introduccion subida por tu docente en tus clases</p>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card animate__animated animate__fadeInUp">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-search me-2"></i>Buscar clases</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-3">Tus secciones matriculadas</h6>
                            <div id="docenteSeccionMatriculada" class="list-group">
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex align-items-center">

                                        <div>
                                            <h6 class="mb-0">Juan Carlos Martínez</h6>
                                            <small>Matemáticas</small>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-chalkboard-teacher me-2"></i>Introducción de Clase</h5>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center mb-4">
                                <div class="col-md-12 text-center">
                                    <!-- Nombre de la clase -->
                                    <h3 id="tituloNombreClase" class="text-primary mb-2"></h3>

                                    <!-- Seccion -->
                                    <p class="text-muted mb-1"><strong>Sección:</strong> <span id="seccionClase"></span></p>

                                    <!-- Departamento -->
                                    <p class="text-muted mb-2" id="pDepartamentoClase">
                                        <i class="fas fa-building me-2"></i>
                                    </p>

                                    <!-- Docente -->
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <i class="fas fa-user-tie me-2 text-muted"></i>
                                                <span id="nombreDocente" class="me-3"></span>
                                            </div>
                                            <p id="pCorreoInstitucionalDocente" class="text-muted mt-1">
                                                <i class="fas fa-envelope me-2"></i>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <!-- Video de YouTube -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h6 class="mb-3">
                                        <i class="fas fa-play-circle me-2 text-danger"></i>Video de Introducción
                                    </h6>
                                    <div class="ratio ratio-16x9">
                                        <iframe
                                            id="videoIntroduccion"
                                            src=""
                                            title="Video de Introducción a la Clase"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>
                            </div>

                            <!-- Boton para descargar PDF -->
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h6 class="mb-3">
                                        <i class="fas fa-file-pdf me-2 text-danger"></i>Material de Apoyo
                                    </h6>
                                    <button
                                        id="btnDescargarPDF"
                                        class="btn btn-outline-danger btn-lg"
                                        onclick="descargarPDF()">
                                        <i class="fas fa-download me-2"></i>Descargar (PDF)
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../../assets/js/Estudiantes/mainVerClases.js"></script>
</body>

</html>