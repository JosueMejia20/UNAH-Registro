<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Estudiante - UNAH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/../../assets/css/principal_components.css">
    <link rel="stylesheet" href="/../../assets/css/estudiante_style.css">
</head>
<body>
    <pantalla-de-carga></pantalla-de-carga>
    <unah-navbar></unah-navbar>

    <div class="container-completo">
        <!-- Sidebar -->
        <unah-sidebar menu-items='[
            {"label": "Perfil", "view": "perfil"},
            {"label": "Matrícula", "view": "matricula"},
            {"label": "Chat y Solicitudes", "view": "chat"},
            {"label": "Gestión de Solicitudes", "view": "solicitudes"},
            {"label": "Perfil de Docentes", "view": "perfil_docentes"},
            {"label": "Certificado Académico", "view": "certificado"}
        ]'></unah-sidebar>

        <!-- Contenido Principal -->
        <div id="main-content" class="main-content"></div>

        <div class="modal fade" id="loadingModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background: transparent; border: none;">
                    <div class="modal-body text-center">
                        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                        <h5 class="mt-3 text-white">Procesando solicitud...</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/Estudiantes/estudiante.js"></script>
    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>
