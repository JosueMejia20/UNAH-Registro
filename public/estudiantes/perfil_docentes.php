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
      {"label": "Evaluacion Docente", "href": "evaluaciones.php"}
    ]'></unah-sidebar>

        <main class="main-content p-4">
            <div class="header animate__animated animate__fadeIn">
                <h2><i class="fas fa-chalkboard-teacher me-2" style="color: var(--unah-blue);"></i> Perfil de Docentes</h2>
                <p class="mb-0">Consulta información sobre tus profesores</p>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card animate__animated animate__fadeInUp">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-search me-2"></i>Buscar Docente</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-3">Docentes de tus secciones matriculadas</h6>
                            <div id="docenteSeccionMatriculada" class="list-group">
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="...">
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
                        <div class="card-header ">
                            <h5 class="mb-0"><i class="fas fa-user-tie me-2"></i>Perfil del Docente</h5>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center mb-4">
                                <div class="col-md-9 text-center">
                                    <h3 id="tituloNombreDocente"></h3>
                                    <p class="text-muted mb-2" id="pDepartamentoDocente"></p>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <p id="pCorreoInstitucionalDocente" ><i class="fas fa-envelope me-2 text-muted"></i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <hr>

                            <h5 class="mb-3"><i class="fas fa-book me-2"></i>Asignaturas que imparte</h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Asignatura</th>
                                            <th>Seccion</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaAsignaturasDocente">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../../assets/js/Estudiantes/mainPerfilDocente.js"></script>
</body>

</html>