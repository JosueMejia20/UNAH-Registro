<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta y Actualización de Solicitud - UNAH</title>
    <link rel="icon" href="https://lepidopterahonduras.wordpress.com/wp-content/uploads/2015/04/cropped-escudo-unah-22.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/../../assets/css/principal_components.css">
    <link rel="stylesheet" href="/../../assets/css/solicitud.css">
</head>
<body>
    <pantalla-de-carga></pantalla-de-carga>
    <unah-navbar></unah-navbar>
    <!-- Header -->
    <div class="header text-center">
        <div class="container">
            <img src="https://biologia.unah.edu.hn/dmsdocument/1433-unah-logo-texto" alt="Logo UNAH" class="logo">
            <h1>Consulta y Actualización de Solicitud</h1>
            <p class="lead">Universidad Nacional Autónoma de Honduras</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Search Card -->
        <div class="card search-card">
            <div class="card-body">
                <h2 class="section-title">Buscar Solicitud</h2>
                <form id="searchForm">
                    <div class="mb-3">
                        <label for="solicitudId" class="form-label info-label">Número de Solicitud</label>
                        <input type="text" class="form-control" id="solicitudId" placeholder="Ingrese su ID de solicitud (ej: SOL-2023-001234)" required>
                    </div>
                    <div class="mb-3">
                        <label for="identificacion" class="form-label info-label">Número de Identificación</label>
                        <input type="text" class="form-control" id="identificacion" placeholder="Ingrese su número de identidad o pasaporte" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-unah btn-lg">
                            <i class="bi bi-search"></i> Buscar Solicitud
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Loading Spinner -->
        <div class="loading-spinner" id="loadingSpinner"></div>

        <!-- Results Card (initially hidden) -->
        <div class="card result-card" id="resultCard">
            <div class="card-body">
                <!-- Status and Basic Info -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Detalles de la Solicitud</h2>
                    <span class="status-badge status-pending" id="statusBadge">En Revisión</span>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="info-label">Número de Solicitud</p>
                        <div class="info-value" id="solicitudNumber">SOL-2023-001234</div>
                    </div>
                    <div class="col-md-6">
                        <p class="info-label">Fecha de Solicitud</p>
                        <div class="info-value" id="fechaSolicitud">15/07/2023</div>
                    </div>
                </div>

                <!-- Personal Information -->
                <h3 class="section-title">Información Personal</h3>
                <div class="row">
                    <div class="col-md-6">
                        <p class="info-label">Nombre Completo <i class="bi bi-pencil-square edit-btn" onclick="enableEdit('nombreCompleto')"></i></p>
                        <div class="info-value editable-field" id="nombreCompleto" contenteditable="false">Juan Carlos Pérez López</div>
                    </div>
                    <div class="col-md-6">
                        <p class="info-label">Número de Identificación</p>
                        <div class="info-value" id="numeroIdentificacion">0801-1995-12345</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p class="info-label">Fecha de Nacimiento <i class="bi bi-pencil-square edit-btn" onclick="enableEdit('fechaNacimiento')"></i></p>
                        <div class="info-value editable-field" id="fechaNacimiento" contenteditable="false">15/05/1995</div>
                    </div>
                    <div class="col-md-6">
                        <p class="info-label">Género <i class="bi bi-pencil-square edit-btn" onclick="enableEdit('genero', 'select')"></i></p>
                        <div class="info-value editable-field" id="genero" contenteditable="false">Masculino</div>
                    </div>
                </div>

                <!-- Contact Information -->
                <h3 class="section-title mt-4">Información de Contacto</h3>
                <div class="row">
                    <div class="col-md-6">
                        <p class="info-label">Teléfono <i class="bi bi-pencil-square edit-btn" onclick="enableEdit('telefono')"></i></p>
                        <div class="info-value editable-field" id="telefono" contenteditable="false">2234-5678</div>
                    </div>
                    <div class="col-md-6">
                        <p class="info-label">Correo Electrónico <i class="bi bi-pencil-square edit-btn" onclick="enableEdit('email')"></i></p>
                        <div class="info-value editable-field" id="email" contenteditable="false">juan.perez@email.com</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="info-label">Dirección <i class="bi bi-pencil-square edit-btn" onclick="enableEdit('direccion')"></i></p>
                        <div class="info-value editable-field" id="direccion" contenteditable="false">Colonia Los Pinos, Calle Principal, Casa #123, Tegucigalpa, Francisco Morazán</div>
                    </div>
                </div>

                <!-- Academic Information -->
                <h3 class="section-title mt-4">Información Académica</h3>
                <div class="row">
                    <div class="col-md-6">
                        <p class="info-label">Centro Regional <i class="bi bi-pencil-square edit-btn" onclick="enableEdit('centroRegional', 'select')"></i></p>
                        <div class="info-value editable-field" id="centroRegional" contenteditable="false">CU Tegucigalpa</div>
                    </div>
                    <div class="col-md-6">
                        <p class="info-label">Carrera de Interés <i class="bi bi-pencil-square edit-btn" onclick="enableEdit('carreraInteres', 'select')"></i></p>
                        <div class="info-value editable-field" id="carreraInteres" contenteditable="false">Medicina</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p class="info-label">Instituto de Educación Media <i class="bi bi-pencil-square edit-btn" onclick="enableEdit('institutoEducacion')"></i></p>
                        <div class="info-value editable-field" id="institutoEducacion" contenteditable="false">Instituto Central Vicente Cáceres</div>
                    </div>
                    <div class="col-md-6">
                        <p class="info-label">Año de Graduación <i class="bi bi-pencil-square edit-btn" onclick="enableEdit('anioGraduacion')"></i></p>
                        <div class="info-value editable-field" id="anioGraduacion" contenteditable="false">2013</div>
                    </div>
                </div>

                <!-- Documents -->
                <h3 class="section-title mt-4">Documentos Adjuntos</h3>
                <div class="alert alert-unah">
                    <p>Para actualizar documentos, por favor contacte al departamento de admisiones.</p>
                    <ul class="list-unstyled" id="documentosList">
                        <li><a href="#" class="document-link"><i class="bi bi-file-earmark-pdf"></i> Título de Educación Media (PDF, 2.4MB)</a></li>
                        <li><a href="#" class="document-link"><i class="bi bi-file-earmark-image"></i> Fotografía (JPG, 1.2MB)</a></li>
                    </ul>
                </div>

                <!-- Status Updates -->
                <h3 class="section-title mt-4">Actualizaciones de Estado</h3>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-point"></div>
                        <div class="timeline-content">
                            <h5>Solicitud Recibida</h5>
                            <p class="text-muted">15/07/2023 - 10:30 AM</p>
                            <p>Su solicitud ha sido recibida y está en proceso de revisión.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-point"></div>
                        <div class="timeline-content">
                            <h5>Documentos Verificados</h5>
                            <p class="text-muted">18/07/2023 - 02:15 PM</p>
                            <p>Los documentos adjuntos han sido verificados satisfactoriamente.</p>
                        </div>
                    </div>
                </div>

                <!-- Update Message -->
                <div class="alert alert-success update-message" id="updateSuccess">
                    <i class="bi bi-check-circle"></i> Los cambios han sido guardados exitosamente.
                </div>
                <div class="alert alert-danger update-message" id="updateError">
                    <i class="bi bi-exclamation-triangle"></i> Ocurrió un error al guardar los cambios. Por favor intente nuevamente.
                </div>

                <!-- Update Button -->
                <div class="d-grid gap-2 mt-4">
                    <button class="btn btn-update btn-lg" id="updateBtn">
                        <i class="bi bi-send-check"></i> Enviar Actualización
                    </button>
                </div>
            </div>
        </div>

        <!-- Not Found Message (initially hidden) -->
        <div class="alert alert-danger text-center" id="notFoundAlert" style="display: none;">
            <h4><i class="bi bi-exclamation-triangle"></i> Solicitud no encontrada</h4>
            <p>No se encontró ninguna solicitud con los datos proporcionados. Por favor verifique la información e intente nuevamente.</p>
            <p>Si cree que esto es un error, por favor contacte al departamento de admisiones.</p>
        </div>
    </div>

    <!-- Footer -->
    <unah-footer></unah-footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../../assets/js/mainAdmisiones.js"></script>
    <script src="../../assets/js/Admisiones/solicitud.js"></script>
</body>
</html>