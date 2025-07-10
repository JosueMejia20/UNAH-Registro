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

    <header>
        <div class="container header-content">
            <img src="https://lepidopterahonduras.wordpress.com/wp-content/uploads/2015/04/cropped-escudo-unah-22.png" alt="Logo UNAH" class="logo">
            <div class="user-info">
                <span>Bienvenido, Revisor</span>
                <div class="user-avatar">R</div>
            </div>
        </div>
    </header>

    <div class="container">
        <h1 class="main-title">Revisión de Solicitudes de Admisión</h1>
        
        <div class="requests-info">
            <div class="requests-count">Solicitudes pendientes: <span id="pendingCount">4</span></div>
        </div>

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
            <tbody id="requestsTableBody">
                <!-- Las solicitudes se cargarán dinámicamente con JavaScript -->
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="pagination" id="pagination">
            <button id="prevPage" disabled>Anterior</button>
            <!-- Los números de página se generarán dinámicamente -->
            <button id="nextPage">Siguiente</button>
        </div>
    </div>

    <!-- Modal de detalles de solicitud -->
    <div class="modal" id="requestModal">
        <div class="modal-content">
            <h3 class="modal-title">Solicitud de Admisión <span id="modalRequestId"></span></h3>
            <div class="modal-body">
                <div class="request-details">
                    <div class="request-info">
                        <div class="info-group">
                            <label>Nombre del Estudiante:</label>
                            <p id="studentName"></p>
                        </div>
                        <div class="info-group">
                            <label>Carrera:</label>
                            <p id="studentCareer"></p>
                        </div>
                        <div class="info-group">
                            <label>Fecha de Solicitud:</label>
                            <p id="requestDate"></p>
                        </div>
                        <div class="info-group">
                            <label>Estado:</label>
                            <p id="requestStatus"></p>
                        </div>
                    </div>
                    <div class="request-document">
                        <h4>Documento Adjunto</h4>
                        <img src="" alt="Documento de solicitud" id="documentImage">
                    </div>
                </div>
                
                <div class="rejection-reason" id="rejectionReason">
                    <label>Razón de rechazo:</label>
                    <textarea id="reasonText" placeholder="Describa la razón por la cual rechaza esta solicitud..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" onclick="closeModal()">Cerrar</button>
                <button class="btn btn-reject" id="rejectBtn" onclick="showRejectionReason()">Rechazar</button>
                <button class="btn btn-approve" id="approveBtn" onclick="approveRequest()">Aprobar</button>
                <button class="btn btn-reject" id="confirmRejectBtn" onclick="rejectRequest()">Confirmar Rechazo</button>
            </div>
        </div>
    </div>
    <unah-footer></unah-footer>


    <script type="module" src="../../assets/js/mainAdmisiones.js"></script>
    
</body>
</html>