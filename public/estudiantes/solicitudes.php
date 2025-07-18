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
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablaBodySolicitudes">
                                            <tr>
                                                <td>#12345</td>
                                                <td>Cambio de carrera</td>
                                                <td>15/03/2023</td>
                                                <td><span class="badge bg-warning">En revisión</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-print"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#12346</td>
                                                <td>Reposición de matrícula</td>
                                                <td>10/03/2023</td>
                                                <td><span class="badge bg-info">Documentación pendiente</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-print"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#12347</td>
                                                <td>Cancelación de asignatura</td>
                                                <td>05/03/2023</td>
                                                <td><span class="badge bg-success">Aprobada</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-print"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <nav aria-label="Page navigation">
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
                                    <button id="cancelacionMatriculaBtn" class="btn btn-unah mb-2" type="button">
                                        <i class="fas fa-ban me-2"></i>Cancelación de Matrícula
                                    </button>
                                    <button id="pagoReposicionBtn" class="btn btn-unah mb-2" type="button">
                                        <i class="fas fa-redo me-2"></i>Pago de Reposicion
                                    </button>
                                    <button id="cancelacionExcepcionalBtn" class="btn btn-unah mb-2" type="button">
                                        <i class="fas fa-calendar-times me-2"></i>Cancelación de Asignatura
                                    </button>
                                    <button id="subirDocumentosBtn" class="btn btn-unah mb-2" type="button">
                                        <i class="fas fa-file-upload me-2"></i>Subir Documentos
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
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>
