<?php
    session_start();

    if (!isset($_SESSION['usuario_id'])) {
        header("Location: login_biblioteca.php");
        exit();
    }
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual UNAH - Docentes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/principal_components.css">
    <link rel="stylesheet" href="/assets/css/biblioteca_style.css">
</head>

<body class="bg-blue-gray">
    <!-- Pantalla de carga -->
    <pantalla-de-carga></pantalla-de-carga>

    <!-- Barra de navegación -->
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
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-unah-blue">
                <i class="bi bi-book me-2"></i>Recursos Académicos
            </h1>
            <button class="btn btn-unah-blue" id="subirRecursoModalBtn">
                <i class="bi bi-plus me-2"></i>Agregar Recurso
            </button>
        </div>

        <div class="bg-white border rounded p-3">
            <!-- Filtros -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="filtroCurso" class="form-label">Filtrar por curso</label>
                            <select class="form-select" id="filtroCurso">
                                <option value="">Todos los cursos</option>
                                <option value="1">Matemáticas Avanzadas</option>
                                <option value="2">Literatura Contemporánea</option>
                                <option value="3">Programación Web</option>
                                <option value="4">Historia Universal</option>
                            </select>
                        </div>
                        <div class="col-md-4">
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

            <!-- Grid de recursos -->
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4" id="gridRecursos">
                <!-- Los recursos se cargarán aquí dinámicamente -->
            </div>

            <!-- Mensaje sin resultados -->
            <div id="noResultados" class="text-center py-5 bg-white rounded d-none">
                <i class="bi bi-book text-unah-blue" style="font-size: 3rem;"></i>
                <h4>No se encontraron recursos</h4>
                <p class="text-muted">Intenta con otros términos de búsqueda o ajusta los filtros</p>
            </div>
        </div>
    </main>

    <!-- Modal para visualizar PDF -->
    <div class="modal fade" id="visorPdfModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-unah-blue text-white">
                    <h5 class="modal-title" id="visorPdfModalTitle">Título del Recurso</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
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
    <div class="modal fade" id="subirRecursoModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-unah-blue text-white">
                    <h5 class="modal-title">Agregar nuevo recurso</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="formSubirRecurso">
                    <div class="modal-body">
                        <div class="row g-3">
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
                                        <option value="">Seleccione un tipo</option>
                                        <option value="libro">Libro</option>
                                        <option value="articulo">Artículo</option>
                                        <option value="guia">Guía de estudio</option>
                                        <option value="tesis">Tesis</option>
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

                        <div class="row g-3">
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
    <div class="modal fade" id="editarRecursoModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-unah-blue text-white">
                    <h5 class="modal-title">Editar recurso</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="formEditarRecurso">
                    <div class="modal-body">
                        <div class="row g-3">
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

                        <div class="row g-3">
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
    <div class="modal fade" id="confirmarEliminarModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirmar eliminación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro que deseas eliminar este recurso? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmarEliminarBtn">Eliminar</button>
                    <input type="hidden" id="recurso_id_eliminar">
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <unah-footer></unah-footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="/assets/js/mainBiblioteca.js"></script>
    <script type="module" src="/assets/js/main.js"></script>
</body>
</html>