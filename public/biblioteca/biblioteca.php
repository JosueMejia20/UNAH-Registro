<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual UNAH</title>
    <link rel="icon" href="https://lepidopterahonduras.wordpress.com/wp-content/uploads/2015/04/cropped-escudo-unah-22.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/../../assets/css/principal_components.css">
  <link rel="stylesheet" href="/../../assets/css/biblioteca_style.css">
</head>
<body>

    <pantalla-de-carga></pantalla-de-carga>
    <unah-navbar></unah-navbar>

    <div class="info-biblioteca">

        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <i class="fas fa-book-open me-2"></i>Biblioteca Virtual UNAH
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-user me-1"></i> Mi Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php"><i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    
        <div class="container py-4">
            <!-- Barra de título y botones según rol -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3" style="color: var(--unah-blue);">
                    <i class="fas fa-book me-2"></i>Recursos Académicos
                </h1>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subirRecursoModal">
                    <i class="fas fa-upload me-2"></i>Subir Recurso
                </button>
            </div>
    
            <!-- Filtros y búsqueda -->
            <div class="card mb-4 filtros-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="filtroCurso" class="form-label">Filtrar por curso</label>
                            <select class="form-select" id="filtroCurso">
                                <option value="">Todos los cursos</option>
                                <option value="1">Matemáticas Avanzadas</option>
                                <option value="2">Literatura Contemporánea</option>
                                <option value="3">Programación Web</option>
                                <option value="4">Historia Universal</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="busquedaRecursos" class="form-label">Buscar recursos</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Título, autor o tags..." id="busquedaRecursos">
                                <button class="btn btn-outline-secondary" type="button" id="btnBuscar">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Cuadrícula de recursos -->
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4" id="gridRecursos">
                <!-- Ejemplo de recurso 1 -->
                <div class="col">
                    <div class="card h-100 shadow-sm recurso-card" data-cursos="1, 3" data-busqueda="introducción a la programación john doe programación, algoritmos, python">
                        <div class="portada-container" onclick="verRecurso(1)">
                            <img src="https://m.media-amazon.com/images/I/61K5jyMB5VL._AC_UF1000,1000_QL80_.jpg" alt="Portada de Introducción a la Programación" class="img-fluid portada-img">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Introducción a la Programación</h5>
                            <p class="card-text small card-autores">John Doe, María Pérez, Carlos López</p>
                            
                            <div class="metadata-section">
                                <div class="mb-2">
                                    <span class="badge badge-tag me-1">programación</span>
                                    <span class="badge badge-tag me-1">algoritmos</span>
                                    <span class="badge badge-tag me-1">Python</span>
                                    <span class="badge badge-tag me-1">básico</span>
                                </div>
                                <button class="btn btn-sm btn-outline-primary btn-ver ver-recurso" data-id="1">
                                    <i class="fas fa-eye me-1"></i> Ver documento
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Ejemplo de recurso 2 -->
                <div class="col">
                    <div class="card h-100 shadow-sm recurso-card" data-cursos="2, 4" data-busqueda="historia del arte jane smith arte, renacimiento, cultura">
                        <div class="portada-container" onclick="verRecurso(2)">
                            <div class="portada-placeholder">
                                <i class="fas fa-book-open fa-3x"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Historia del Arte Moderno: Del Renacimiento al Siglo XXI</h5>
                            <p class="card-text small card-autores">Jane Smith, Robert Johnson</p>
                            
                            <div class="metadata-section">
                                <div class="mb-2">
                                    <span class="badge badge-tag me-1">arte</span>
                                    <span class="badge badge-tag me-1">renacimiento</span>
                                    <span class="badge badge-tag me-1">cultura</span>
                                    <span class="badge badge-tag me-1">historia</span>
                                </div>
                                <button class="btn btn-sm btn-outline-primary btn-ver ver-recurso" data-id="2">
                                    <i class="fas fa-eye me-1"></i> Ver documento
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Ejemplo de recurso 3 -->
                <div class="col">
                    <div class="card h-100 shadow-sm recurso-card" data-cursos="1, 2" data-busqueda="álgebra lineal equipo matemáticas matemáticas, álgebra, ecuaciones">
                        <div class="portada-container" onclick="verRecurso(3)">
                            <img src="https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1348255220i/675201.jpg" alt="Portada de Álgebra Lineal" class="img-fluid portada-img">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Álgebra Lineal: Teoría y Práctica</h5>
                            <p class="card-text small card-autores">Equipo Matemáticas, Dr. Luis González</p>
                            
                            <div class="metadata-section">
                                <div class="mb-2">
                                    <span class="badge badge-tag me-1">matemáticas</span>
                                    <span class="badge badge-tag me-1">álgebra</span>
                                    <span class="badge badge-tag me-1">ecuaciones</span>
                                    <span class="badge badge-tag me-1">vectores</span>
                                </div>
                                <button class="btn btn-sm btn-outline-primary btn-ver ver-recurso" data-id="3">
                                    <i class="fas fa-eye me-1"></i> Ver documento
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Ejemplo de recurso 4 -->
                <div class="col">
                    <div class="card h-100 shadow-sm recurso-card" data-cursos="3, 4" data-busqueda="diseño web ana gómez web, diseño, frontend">
                        <div class="portada-container" onclick="verRecurso(4)">
                            <img src="https://m.media-amazon.com/images/I/71Vj4WsW1mL._AC_UF1000,1000_QL80_.jpg" alt="Portada de Diseño Web Moderno" class="img-fluid portada-img">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Diseño Web Moderno: Principios y Técnicas Avanzadas</h5>
                            <p class="card-text small card-autores">Ana Gómez, Pedro Martínez, Sofía Ramírez</p>
                            
                            <div class="metadata-section">
                                <div class="mb-2">
                                    <span class="badge badge-tag me-1">web</span>
                                    <span class="badge badge-tag me-1">diseño</span>
                                    <span class="badge badge-tag me-1">frontend</span>
                                    <span class="badge badge-tag me-1">UI/UX</span>
                                    <span class="badge badge-tag me-1">responsive</span>
                                </div>
                                <button class="btn btn-sm btn-outline-primary btn-ver ver-recurso" data-id="4">
                                    <i class="fas fa-eye me-1"></i> Ver documento
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Mensaje cuando no hay resultados -->
            <div id="noResultados" class="text-center py-5 d-none">
                <i class="fas fa-book-open fa-4x mb-3"></i>
                <h4>No se encontraron recursos</h4>
                <p class="text-muted">Intenta con otros términos de búsqueda o ajusta los filtros</p>
            </div>
        </div>
    
        <!-- Modal para visualizar PDF -->
        <div class="modal fade" id="visorPdfModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="visorPdfModalTitle">Título del Recurso</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="ratio ratio-16x9">
                            <iframe id="pdfViewer" src="" style="border: none;" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <small class="text-muted me-auto" id="pdfMetadata">Autores: </small>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Modal para subir recurso -->
        <div class="modal fade" id="subirRecursoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Subir nuevo recurso</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formSubirRecurso">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título*</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" required>
                            </div>
                            <div class="mb-3">
                                <label for="autores" class="form-label">Autor(es)*</label>
                                <input type="text" class="form-control" id="autores" name="autores" required>
                                <small class="text-muted">Separar múltiples autores con comas</small>
                            </div>
                            <div class="mb-3">
                                <label for="tags" class="form-label">Tags</label>
                                <input type="text" class="form-control" id="tags" name="tags">
                                <small class="text-muted">Palabras clave separadas por comas</small>
                            </div>
                            <div class="mb-3">
                                <label for="cursos" class="form-label">Cursos relacionados</label>
                                <select class="form-select" id="cursos" name="cursos" multiple>
                                    <option value="1">Matemáticas Avanzadas</option>
                                    <option value="2">Literatura Contemporánea</option>
                                    <option value="3">Programación Web</option>
                                    <option value="4">Historia Universal</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="portada" class="form-label">Portada (opcional)</label>
                                <input type="file" class="form-control" id="portada" name="portada" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="archivo_pdf" class="form-label">Archivo PDF*</label>
                                <input type="file" class="form-control" id="archivo_pdf" name="archivo_pdf" accept=".pdf" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Subir Recurso</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <unah-footer></unah-footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../../assets/js/mainAdmisiones.js"></script>
</body>
</html>