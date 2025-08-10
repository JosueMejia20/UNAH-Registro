 <?php
    session_start();

    if (!isset($_SESSION['usuario_id'], $_SESSION['rol'])) {
        header("Location: login_biblioteca.php");
        exit();
    }
    ?>


 <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Musical UNAH</title>
    <link rel="icon" href="https://biologia.unah.edu.hn/dmsdocument/1433-unah-logo-texto">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/principal_components.css">
     <link rel="stylesheet" href="/assets/css/musica_style.css">
</head>
<body>
    <!-- Admin bar (visible solo para jefes/coordinadores) -->
    <div class="admin-bar bg-unah-blue-dark text-white py-2 px-4 d-flex justify-content-end gap-3">
        <button class="btn btn-sm btn-outline-light">
            <i class="bi bi-plus-circle"></i> Añadir recurso
        </button>
    </div>

    <!-- Header -->
    <header class="unah-header text-white py-3 mb-4 shadow">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center animate-fadeIn">
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-music-note-beamed fs-1 text-warning"></i>
                    <h1 class="mb-0 fs-3 fw-bold">Biblioteca Musical UNAH</h1>
                </div>
                <div class="d-flex gap-3 align-items-center">
                    <button class="btn btn-outline-light btn-sm">
                        <i class="bi bi-bell"></i>
                    </button>
                    <div class="user-dropdown">
                        <button class="user-btn btn-sm" id="userMenuButton">
                            <i class="bi bi-person-fill"></i>
                            <span>Carlos Martínez</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="user-menu" id="userMenu">
                            <a href="../../../index.php" class="logout"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <main class="container mb-5">
        <!-- Search bar -->
        <div class="bg-white rounded shadow-sm p-4 mb-4 animate-fadeIn">
            <form class="d-flex gap-2 mb-3">
                <input type="search" class="form-control" placeholder="Buscar por título, autor o tema...">
                <button type="submit" class="btn btn-unah-primary">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </form>
            <div class="d-flex flex-wrap gap-2">
                <span class="filter-tag badge bg-light text-dark active">Todos</span>
                <span class="filter-tag badge bg-light text-dark">Partituras</span>
                <span class="filter-tag badge bg-light text-dark">Documentos</span>
                <span class="filter-tag badge bg-light text-dark">Audios</span>
            </div>
        </div>

        <!-- Resources grid -->
        <div class="row g-4">
            <!-- PDF Resource -->
            <div class="col-md-6 col-lg-4">
                <div class="resource-card card h-100 shadow-sm animate-fadeInUp">
                    <div class="thumbnail-pdf card-img-top d-flex align-items-center justify-content-center" style="height: 160px;">
                        <i class="bi bi-file-earmark-pdf fs-1"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-unah-blue">Teoría Musical Avanzada</h5>
                        <p class="card-text text-muted small">Juan Pérez, María Gómez</p>
                        <div class="d-flex flex-wrap gap-1 mb-3">
                            <span class="badge bg-secondary">teoría</span>
                            <span class="badge bg-secondary">educación</span>
                            <span class="badge bg-secondary">armonía</span>
                        </div>
                        <div class="d-flex justify-content-between pt-2 border-top">
                            <button class="btn btn-sm btn-outline-primary view-pdf">
                                <i class="bi bi-eye"></i> Ver
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-bookmark"></i> Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Audio Resource -->
            <div class="col-md-6 col-lg-4">
                <div class="resource-card card h-100 shadow-sm animate-fadeInUp">
                    <div class="thumbnail-audio card-img-top d-flex align-items-center justify-content-center" style="height: 160px;">
                        <i class="bi bi-music-note-beamed fs-1"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-unah-blue">Concierto para violín No. 1</h5>
                        <p class="card-text text-muted small">Ludwig van Beethoven</p>
                        <div class="d-flex flex-wrap gap-1 mb-3">
                            <span class="badge bg-secondary">clásica</span>
                            <span class="badge bg-secondary">violín</span>
                            <span class="badge bg-secondary">orquesta</span>
                        </div>
                        <div class="d-flex justify-content-between pt-2 border-top">
                            <button class="btn btn-sm btn-outline-primary view-audio">
                                <i class="bi bi-play"></i> Escuchar
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-bookmark"></i> Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Score Resource -->
            <div class="col-md-6 col-lg-4">
                <div class="resource-card card h-100 shadow-sm animate-fadeInUp">
                    <div class="thumbnail-score card-img-top d-flex align-items-center justify-content-center" style="height: 160px;">
                        <i class="bi bi-file-earmark-music fs-1"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-unah-blue">Sonata Claro de Luna</h5>
                        <p class="card-text text-muted small">Ludwig van Beethoven</p>
                        <div class="d-flex flex-wrap gap-1 mb-3">
                            <span class="badge bg-secondary">piano</span>
                            <span class="badge bg-secondary">clásica</span>
                            <span class="badge bg-secondary">partitura</span>
                        </div>
                        <div class="d-flex justify-content-between pt-2 border-top">
                            <button class="btn btn-sm btn-outline-success download">
                                <i class="bi bi-download"></i> Descargar
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-bookmark"></i> Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- PDF Viewer Modal -->
    <div class="modal fade viewer-modal" id="pdfViewerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content viewer-content">
                <div class="modal-header">
                    <h5 class="modal-title">Visualizador de PDF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0" style="height: 70vh;">
                    <iframe src="about:blank" class="w-100 h-100 border-0"></iframe>
                </div>
                <div class="modal-footer">
                    <small class="text-muted">Este documento no está disponible para descarga.</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Audio Viewer Modal -->
    <div class="modal fade viewer-modal" id="audioViewerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content viewer-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reproductor de audio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <audio controls class="w-100">
                        <source src="about:blank" type="audio/mpeg">
                        Tu navegador no soporta el elemento de audio.
                    </audio>
                </div>
                <div class="modal-footer">
                    <small class="text-muted">Este audio no está disponible para descarga.</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Scripts -->
        <script>
            const usuarioId = <?php echo json_encode($_SESSION['usuario_id']); ?>;
            const rol = <?php echo json_encode($_SESSION['rol']); ?>;
            console.log("ID del usuario desde sesion PHP:", usuarioId);
            console.log("ID del rol desde sesion PHP:", rol);
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script type="module" src="/assets/js/mainMusica.js"></script>
        <script type="module" src="/assets/js/main.js"></script>
    <script src="/assets/js/musica/musica_script_provicional.js"></script>
</body>
</html>
