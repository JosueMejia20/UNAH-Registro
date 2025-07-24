<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual UNAH - Docentes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/../../assets/css/principal_components.css">
    <link rel="stylesheet" href="../assets/css/biblioteca_style.css">
</head>

<body class="bg-blue-gray">
    <pantalla-de-carga></pantalla-de-carga>

    <nav class="navbar navbar-expand-lg navbar-dark bg-unah-blue">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-book me-2"></i>Biblioteca Virtual UNAH
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>Prof. Carlos Méndez
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Mi perfil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Configuración</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <!-- Barra de título y botones -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-unah-blue">
                <i class="bi bi-book me-2"></i>Recursos Académicos
            </h1>
            <button class="btn btn-unah-blue" id="subirRecursoModalBtn">
                <i class="bi bi-plus me-2"></i>Agregar Recurso
            </button>
        </div>


        <div class="tab-content bg-white border border-top-0 rounded-bottom p-3" id="myTabContent">
            <!-- Pestaña Todos los recursos -->
            <div class="tab-pane fade show active" id="todos" role="tabpanel">

                <!-- Filtros y búsqueda -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label for="filtroCurso" class="form-label">Filtrar por curso</label>
                                <select class="form-select" id="filtroCurso">
                                    <option value="">Todos los cursos</option>
                                    <option value="1">Matemáticas Avanzadas</option>
                                    <option value="2">Literatura Contemporánea</option>
                                    <option value="3">Programación Web</option>
                                    <option value="4">Historia Universal</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label for="filtroCategoria" class="form-label">Filtrar por categoría</label>
                                <select class="form-select" id="filtroCategoria">
                                    <option value="">Todas las categorías</option>
                                    <option value="libro">Libros</option>
                                    <option value="articulo">Artículos</option>
                                    <option value="guia">Guías de estudio</option>
                                    <option value="tesis">Tesis</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="busquedaRecursos" class="form-label">Buscar recursos</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Título, autor o palabras clave..." id="busquedaRecursos">
                                    <button class="btn btn-outline-secondary" type="button" id="btnBuscar">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cuadrícula de recursos -->
                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4" id="gridRecursos">
                    <!-- Ejemplo de recurso 1 -->
                    <div id="colRecurso" class="col">
                        <div class="card h-100 shadow-sm recurso-card" data-cursos="1, 3" data-busqueda="introducción a la programación john doe programación, algoritmos, python" data-categoria="libro">
                            <div class="portada-container" onclick="verRecurso(1)">
                                <img src="https://m.media-amazon.com/images/I/61K5jyMB5VL._AC_UF1000,1000_QL80_.jpg" alt="Portada de Introducción a la Programación" class="img-fluid portada-img">

                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Introducción a la Programación</h5>
                                <p class="card-text small text-muted">John Doe, María Pérez, Carlos López</p>
                                <p class="small text-muted"><i class="bi bi-calendar me-1"></i>2022</p>

                                <p class="card-text small text-truncate">Este libro ofrece una introducción completa a los fundamentos de la programación, desde conceptos básicos hasta estructuras de datos simples. Ideal para estudiantes de primer año.</p>

                                <div class="border-top pt-2 mt-2">
                                    <div class="mb-2">
                                        <span class="badge badge-tag me-1">programación</span>
                                        <span class="badge badge-tag me-1">algoritmos</span>
                                        <span class="badge badge-tag me-1">Python</span>
                                    </div>
                                    <button class="btn btn-outline-unah-blue btn-sm w-100 ver-recurso" data-id="1">
                                        <i class="bi bi-eye me-1"></i> Ver documento
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ejemplo de recurso 2 (recurso del docente actual) -->
                    <div class="col">
                        <div class="card h-100 shadow-sm recurso-card" data-cursos="2, 4" data-busqueda="historia del arte jane smith arte, renacimiento, cultura" data-categoria="articulo" data-propietario="true">
                            <div class="portada-container" onclick="verRecurso(2)">
                                <div class="portada-placeholder w-100 h-100 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-book text-primary opacity-50" style="font-size: 3rem;"></i>
                                </div>

                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Historia del Arte Moderno: Del Renacimiento al Siglo XXI</h5>
                                <p class="card-text small text-muted">Prof. Carlos Méndez, Robert Johnson</p>
                                <p class="small text-muted"><i class="bi bi-calendar me-1"></i>2023</p>

                                <p class="card-text small text-truncate">Análisis comparativo de los movimientos artísticos desde el Renacimiento hasta el arte contemporáneo, con énfasis en la evolución de las técnicas y su contexto histórico.</p>

                                <div class="border-top pt-2 mt-2">
                                    <div class="mb-2">
                                        <span class="badge badge-tag me-1">arte</span>
                                        <span class="badge badge-tag me-1">renacimiento</span>
                                        <span class="badge badge-tag me-1">cultura</span>
                                    </div>
                                    <button class="btn btn-outline-unah-blue btn-sm w-100 ver-recurso" data-id="2">
                                        <i class="bi bi-eye me-1"></i> Ver documento
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ejemplo de recurso 3 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm recurso-card" data-cursos="1, 2" data-busqueda="álgebra lineal equipo matemáticas matemáticas, álgebra, ecuaciones" data-categoria="libro">
                            <div class="portada-container" onclick="verRecurso(3)">
                                <img src="https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1348255220i/675201.jpg" alt="Portada de Álgebra Lineal" class="img-fluid portada-img">

                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Álgebra Lineal: Teoría y Práctica</h5>
                                <p class="card-text small text-muted">Equipo Matemáticas, Dr. Luis González</p>
                                <p class="small text-muted"><i class="bi bi-calendar me-1"></i>2021</p>

                                <p class="card-text small text-truncate">Manual completo de álgebra lineal con enfoque teórico-práctico, incluye ejercicios resueltos y aplicaciones en diversas áreas de la ingeniería.</p>

                                <div class="border-top pt-2 mt-2">
                                    <div class="mb-2">
                                        <span class="badge badge-tag me-1">matemáticas</span>
                                        <span class="badge badge-tag me-1">álgebra</span>
                                        <span class="badge badge-tag me-1">ecuaciones</span>
                                    </div>
                                    <button class="btn btn-outline-unah-blue btn-sm w-100 ver-recurso" data-id="3">
                                        <i class="bi bi-eye me-1"></i> Ver documento
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ejemplo de recurso 4 (recurso del docente actual) -->
                    <div class="col">
                        <div class="card h-100 shadow-sm recurso-card" data-cursos="3, 4" data-busqueda="diseño web ana gómez web, diseño, frontend" data-categoria="guia" data-propietario="true">
                            <div class="portada-container" onclick="verRecurso(4)">
                                <img src="https://m.media-amazon.com/images/I/71Vj4WsW1mL._AC_UF1000,1000_QL80_.jpg" alt="Portada de Diseño Web Moderno" class="img-fluid portada-img">

                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Diseño Web Moderno: Principios y Técnicas</h5>
                                <p class="card-text small text-muted">Prof. Carlos Méndez, Sofía Ramírez</p>
                                <p class="small text-muted"><i class="bi bi-calendar me-1"></i>2023</p>

                                <p class="card-text small text-truncate">Guía práctica actualizada con las últimas técnicas de diseño web responsive, accesibilidad y mejores prácticas de UI/UX para el desarrollo frontend moderno.</p>

                                <div class="border-top pt-2 mt-2">
                                    <div class="mb-2">
                                        <span class="badge badge-tag me-1">web</span>
                                        <span class="badge badge-tag me-1">diseño</span>
                                        <span class="badge badge-tag me-1">frontend</span>
                                    </div>
                                    <button class="btn btn-outline-unah-blue btn-sm w-100 ver-recurso" data-id="4">
                                        <i class="bi bi-eye me-1"></i> Ver documento
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mensaje cuando no hay resultados -->
                <div id="noResultados" class="text-center py-5 bg-white rounded d-none">
                    <i class="bi bi-book text-unah-blue" style="font-size: 3rem;"></i>
                    <h4>No se encontraron recursos</h4>
                    <p class="text-muted">Intenta con otros términos de búsqueda o ajusta los filtros</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para visualizar PDF -->
    <div class="modal fade" id="visorPdfModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-unah-blue text-white">
                    <h5 class="modal-title" id="visorPdfModalTitle">Título del Recurso</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ratio ratio-16x9">
                        <iframe id="pdfViewer" src="" style="border: none;" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="modal-footer bg-blue-gray">
                    <small class="text-muted me-auto" id="pdfMetadata">Autores: </small>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para subir recurso -->
    <div class="modal fade" id="subirRecursoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-unah-blue text-white">
                    <h5 class="modal-title">Agregar nuevo recurso</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formSubirRecurso">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="titulo" class="form-label">Título*</label>
                                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                                </div>
                                <div class="mb-3">
                                    <label for="autores" class="form-label">Autor(es)*</label>
                                    <input type="text" class="form-control" id="autores" name="autores" value="Prof. Carlos Méndez" required>
                                    <small class="text-muted">Separar múltiples autores con comas</small>
                                </div>
                                <div class="mb-3">
                                    <label for="anio" class="form-label">Año de publicación*</label>
                                    <input type="number" class="form-control" id="anio" name="anio" min="1900" max="2099" required>
                                </div>
                                <div class="mb-3">
                                    <label for="categoria" class="form-label">Tipo de recurso*</label>
                                    <select class="form-select" id="categoria" name="categoria" required>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción*</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="tags" class="form-label">Palabras clave</label>
                                    <input type="text" class="form-control" id="tags" name="tags" placeholder="Ej: programación, algoritmos, web">
                                    <small class="text-muted">Separar con comas</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cursos" class="form-label">Cursos relacionados</label>
                                    <select class="form-select" id="cursos" name="cursos" multiple>
                                        <option value="1">Matemáticas Avanzadas</option>
                                        <option value="2">Literatura Contemporánea</option>
                                        <option value="3">Programación Web</option>
                                        <option value="4">Historia Universal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="portada" class="form-label">Portada (opcional)</label>
                                    <input type="file" class="form-control" id="portada" name="portada" accept="image/*">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="archivo_pdf" class="form-label">Archivo del recurso*</label>
                            <input type="file" class="form-control" id="archivo_pdf" name="archivo_pdf" accept=".pdf,.doc,.docx,.ppt,.pptx" required>
                            <small class="text-muted">Formatos aceptados: PDF, Word, PowerPoint</small>
                        </div>
                    </div>
                    <div class="modal-footer bg-blue-gray">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-unah-blue">Subir Recurso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para editar recurso -->
    <div class="modal fade" id="editarRecursoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-unah-blue text-white">
                    <h5 class="modal-title">Editar recurso</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEditarRecurso">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_titulo" class="form-label">Título*</label>
                                    <input type="text" class="form-control" id="edit_titulo" name="edit_titulo" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_autores" class="form-label">Autor(es)*</label>
                                    <input type="text" class="form-control" id="edit_autores" name="edit_autores" required>
                                    <small class="text-muted">Separar múltiples autores con comas</small>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_anio" class="form-label">Año de publicación*</label>
                                    <input type="number" class="form-control" id="edit_anio" name="edit_anio" min="1900" max="2099" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_categoria" class="form-label">Tipo de recurso*</label>
                                    <select class="form-select" id="edit_categoria" name="edit_categoria" required>
                                        <option value="libro">Libro</option>
                                        <option value="articulo">Artículo</option>
                                        <option value="guia">Guía de estudio</option>
                                        <option value="tesis">Tesis</option>
                                        <option value="otros">Otro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_descripcion" class="form-label">Descripción*</label>
                                    <textarea class="form-control" id="edit_descripcion" name="edit_descripcion" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_tags" class="form-label">Palabras clave</label>
                                    <input type="text" class="form-control" id="edit_tags" name="edit_tags">
                                    <small class="text-muted">Separar con comas</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_cursos" class="form-label">Cursos relacionados</label>
                                    <select class="form-select" id="edit_cursos" name="edit_cursos" multiple>
                                        <option value="1">Matemáticas Avanzadas</option>
                                        <option value="2">Literatura Contemporánea</option>
                                        <option value="3">Programación Web</option>
                                        <option value="4">Historia Universal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="cursos" class="form-label">Cursos relacionados</label>
                                        <select class="form-select" id="cursos" name="cursos" multiple>
                                            <option value="1">Matemáticas Avanzadas</option>
                                            <option value="2">Literatura Contemporánea</option>
                                            <option value="3">Programación Web</option>
                                            <option value="4">Historia Universal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="portada" class="form-label">Portada (opcional)</label>
                                        <input type="file" class="form-control" id="portada" name="portada" accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="archivo_pdf" class="form-label">Archivo del recurso*</label>
                                <input type="file" class="form-control" id="archivo_pdf" name="archivo_pdf" accept=".pdf,.doc,.docx,.ppt,.pptx" required>
                                <small class="text-muted">Formatos aceptados: PDF, Word, PowerPoint</small>
                            </div>
                        </div>
                        <div class="modal-footer bg-blue-gray">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-unah-blue">Subir Recurso</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para editar recurso -->
    <div class="modal fade" id="editarRecursoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-unah-blue text-white">
                    <h5 class="modal-title">Editar recurso</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEditarRecurso">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_titulo" class="form-label">Título*</label>
                                    <input type="text" class="form-control" id="edit_titulo" name="edit_titulo" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_autores" class="form-label">Autor(es)*</label>
                                    <input type="text" class="form-control" id="edit_autores" name="edit_autores" required>
                                    <small class="text-muted">Separar múltiples autores con comas</small>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_anio" class="form-label">Año de publicación*</label>
                                    <input type="number" class="form-control" id="edit_anio" name="edit_anio" min="1900" max="2099" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_categoria" class="form-label">Tipo de recurso*</label>
                                    <select class="form-select" id="edit_categoria" name="edit_categoria" required>
                                        <option value="libro">Libro</option>
                                        <option value="articulo">Artículo</option>
                                        <option value="guia">Guía de estudio</option>
                                        <option value="tesis">Tesis</option>
                                        <option value="otros">Otro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_descripcion" class="form-label">Descripción*</label>
                                    <textarea class="form-control" id="edit_descripcion" name="edit_descripcion" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_tags" class="form-label">Palabras clave</label>
                                    <input type="text" class="form-control" id="edit_tags" name="edit_tags">
                                    <small class="text-muted">Separar con comas</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_cursos" class="form-label">Cursos relacionados</label>
                                    <select class="form-select" id="edit_cursos" name="edit_cursos" multiple>
                                        <option value="1">Matemáticas Avanzadas</option>
                                        <option value="2">Literatura Contemporánea</option>
                                        <option value="3">Programación Web</option>
                                        <option value="4">Historia Universal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_portada" class="form-label">Cambiar portada (opcional)</label>
                                    <input type="file" class="form-control" id="edit_portada" name="edit_portada" accept="image/*">
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="edit_portada" class="form-label">Cambiar portada (opcional)</label>
                                        <input type="file" class="form-control" id="edit_portada" name="edit_portada" accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="edit_archivo" class="form-label">Cambiar archivo (opcional)</label>
                                <input type="file" class="form-control" id="edit_archivo" name="edit_archivo" accept=".pdf,.doc,.docx,.ppt,.pptx">
                                <small class="text-muted">Dejar en blanco para mantener el archivo actual</small>
                            </div>

                            <input type="hidden" id="recurso_id" name="recurso_id">
                        </div>
                        <div class="modal-footer bg-blue-gray">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-unah-blue">Guardar cambios</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación para eliminar -->
    <div class="modal fade" id="confirmarEliminarModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirmar eliminación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro que deseas eliminar este recurso? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmarEliminarBtn">Eliminar</button>

                    <div class="mb-3">
                        <label for="edit_archivo" class="form-label">Cambiar archivo (opcional)</label>
                        <input type="file" class="form-control" id="edit_archivo" name="edit_archivo" accept=".pdf,.doc,.docx,.ppt,.pptx">
                        <small class="text-muted">Dejar en blanco para mantener el archivo actual</small>
                    </div>

                    <input type="hidden" id="recurso_id" name="recurso_id">
                </div>
                <div class="modal-footer bg-blue-gray">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-unah-blue">Guardar cambios</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación para eliminar -->
    <div class="modal fade" id="confirmarEliminarModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirmar eliminación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro que deseas eliminar este recurso? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmarEliminarBtn">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <unah-footer></unah-footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../../assets/js/Biblioteca/biblioteca_script.js"></script>
    <script type="module" src="../../assets/js/main.js"></script>


</body>

</html>