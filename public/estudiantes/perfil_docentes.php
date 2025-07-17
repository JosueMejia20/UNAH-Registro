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
                                <div class="mb-3">
                                    <label for="searchTeacher" class="form-label">Nombre del docente</label>
                                    <input type="text" class="form-control" id="searchTeacher" placeholder="Ej: Juan Pérez">
                                </div>
                                <div class="mb-3">
                                    <label for="searchDepartment" class="form-label">Departamento</label>
                                    <select class="form-select" id="searchDepartment">
                                        <option selected>Todos los departamentos</option>
                                        <option>Matemáticas</option>
                                        <option>Física</option>
                                        <option>Inglés</option>
                                        <option>Computación</option>
                                    </select>
                                </div>
                                <button class="btn btn-unah w-100">Buscar</button>
                                
                                <hr>
                                
                                <h6 class="mb-3">Docentes recientes</h6>
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="...">
                                            <div>
                                                <h6 class="mb-0">Juan Carlos Martínez</h6>
                                                <small>Matemáticas</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="...">
                                            <div>
                                                <h6 class="mb-0">Ana Lucia Fernández</h6>
                                                <small>Física</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="...">
                                            <div>
                                                <h6 class="mb-0">María José García</h6>
                                                <small>Inglés</small>
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
                                <h5 class="mb-0"><i class="fas fa-user-tie me-2"></i>Perfil del Docente</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-3 text-center">
                                        <img src="https://via.placeholder.com/120" class="rounded-circle mb-3" alt="...">
                                        <button class="btn btn-sm btn-unah w-100">Enviar mensaje</button>
                                    </div>
                                    <div class="col-md-9">
                                        <h3>Juan Carlos Martínez</h3>
                                        <p class="text-muted mb-2">Profesor de Matemáticas</p>
                                        
                                        <div class="d-flex flex-wrap gap-2 mb-3">
                                            <span class="badge bg-primary">Álgebra</span>
                                            <span class="badge bg-primary">Cálculo</span>
                                            <span class="badge bg-primary">Ecuaciones Diferenciales</span>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><i class="fas fa-envelope me-2 text-muted"></i> jcmartinez@unah.edu.hn</p>
                                                <p><i class="fas fa-phone me-2 text-muted"></i> +504 2234-5678</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><i class="fas fa-building me-2 text-muted"></i> Edificio C1, Oficina 203</p>
                                                <p><i class="fas fa-clock me-2 text-muted"></i> Horario: Lunes a Viernes, 8AM-4PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <h5 class="mb-3"><i class="fas fa-graduation-cap me-2"></i>Formación Académica</h5>
                                <ul class="list-group list-group-flush mb-4">
                                    <li class="list-group-item">
                                        <h6>Doctorado en Matemáticas Aplicadas</h6>
                                        <p class="mb-0 text-muted">Universidad Nacional Autónoma de Honduras, 2015</p>
                                    </li>
                                    <li class="list-group-item">
                                        <h6>Maestría en Educación Matemática</h6>
                                        <p class="mb-0 text-muted">Universidad Pedagógica Nacional, 2010</p>
                                    </li>
                                    <li class="list-group-item">
                                        <h6>Licenciatura en Matemáticas</h6>
                                        <p class="mb-0 text-muted">Universidad Nacional Autónoma de Honduras, 2006</p>
                                    </li>
                                </ul>
                                
                                <h5 class="mb-3"><i class="fas fa-chart-line me-2"></i>Evaluaciones</h5>
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="card teacher-card">
                                            <div class="card-body text-center">
                                                <h6 class="card-title">Claridad</h6>
                                                <div class="mb-2">
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star-half-alt text-warning"></i>
                                                </div>
                                                <p class="mb-0 text-muted">4.5/5.0</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card teacher-card">
                                            <div class="card-body text-center">
                                                <h6 class="card-title">Disponibilidad</h6>
                                                <div class="mb-2">
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                </div>
                                                <p class="mb-0 text-muted">5.0/5.0</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card teacher-card">
                                            <div class="card-body text-center">
                                                <h6 class="card-title">Evaluación General</h6>
                                                <div class="mb-2">
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                </div>
                                                <p class="mb-0 text-muted">4.8/5.0</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <h5 class="mb-3"><i class="fas fa-book me-2"></i>Asignaturas que imparte</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Asignatura</th>
                                                <th>Horario</th>
                                                <th>Aula</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>MAT-201</td>
                                                <td>Matemática II</td>
                                                <td>Lunes y Miércoles, 10:00-11:30</td>
                                                <td>C1-205</td>
                                            </tr>
                                            <tr>
                                                <td>MAT-310</td>
                                                <td>Cálculo III</td>
                                                <td>Martes y Jueves, 8:00-9:30</td>
                                                <td>C2-102</td>
                                            </tr>
                                            <tr>
                                                <td>MAT-415</td>
                                                <td>Ecuaciones Diferenciales</td>
                                                <td>Viernes, 13:00-16:00</td>
                                                <td>C1-301</td>
                                            </tr>
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
  <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>
