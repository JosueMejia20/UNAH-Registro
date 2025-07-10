<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisión de Admisiones - UNAH</title>
    <link rel="icon" href="https://lepidopterahonduras.wordpress.com/wp-content/uploads/2015/04/cropped-escudo-unah-22.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/../../assets/css/principal_components.css">
    <link rel="stylesheet" href="/../../assets/css/revisores_style.css">
</head>
<body>
    <pantalla-de-carga></pantalla-de-carga>
    <unah-navbar></unah-navbar>

    <!-- Contenido principal -->
    <!-- Contenido principal -->
    <header>
        <div class="container header-content">
            <img src="https://via.placeholder.com/200x50/FFFFFF/005F87?text=UNAH+Admisiones" alt="Logo UNAH" class="logo">
            <div class="user-info">
                <span>Bienvenido, Revisor</span>
                <div class="user-avatar">R</div>
            </div>
        </div>
    </header>

    <div class="container">
        <h1 class="main-title">Revisión de Solicitudes de Admisión</h1>
        
        <div class="requests-count">Total de solicitudes pendientes: <span id="pending-count">4</span></div>

        <!-- Tabla de solicitudes -->
        <table class="requests-table">
            <thead>
                <tr>
                    <th>N° Solicitud</th>
                    <th>Nombre del Estudiante</th>
                    <th>Carrera</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="requests-body">
                <!-- Las solicitudes se cargarán aquí dinámicamente -->
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="pagination" id="pagination">
            <!-- Los botones de paginación se generarán aquí -->
        </div>
    </div>

    <!-- Modal de detalles -->
    <div class="modal" id="detailsModal">
        <div class="modal-content">
            <h3 class="modal-title">Detalles de la Solicitud <span id="modal-request-id"></span></h3>
            <div class="modal-body">
                <div class="request-details">
                    <div class="request-image">
                        <img src="https://via.placeholder.com/400x500?text=Documento+del+Estudiante" alt="Documento del estudiante" id="request-document">
                        <p>Documento adjunto</p>
                    </div>
                    <div class="request-info">
                        <div class="info-item">
                            <span class="info-label">Nombre:</span>
                            <span id="info-name">Juan Pérez López</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Carrera:</span>
                            <span id="info-career">Medicina</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Fecha de solicitud:</span>
                            <span id="info-date">15/05/2023</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Estado:</span>
                            <span id="info-status" class="status-pending">Pendiente</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Correo electrónico:</span>
                            <span id="info-email">juan.perez@example.com</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Teléfono:</span>
                            <span id="info-phone">+504 9876-5432</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Notas adicionales:</span>
                            <span id="info-notes">Ninguna</span>
                        </div>
                    </div>
                </div>
                
                <div id="rejection-section" style="margin-top: 20px; display: none;">
                    <div class="form-group">
                        <label for="reasonText">Razón de rechazo:</label>
                        <textarea id="reasonText" placeholder="Describa la razón por la cual rechaza esta solicitud..."></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" onclick="closeModal()">Cerrar</button>
                <button class="btn btn-approve" id="approve-btn">Aprobar</button>
                <button class="btn btn-reject" id="reject-btn">Rechazar</button>
            </div>
        </div>
    </div>
    <unah-footer></unah-footer>

    <script src="/../../assets/js/Admisiones/revisores.js"></script>
    <script type="module" src="../../assets/js/main.js"></script>
</body>
</html>