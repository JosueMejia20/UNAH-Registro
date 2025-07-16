<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat - UNAH</title>
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
      {"label": "Chat y Solicitudes", "href": "chat.php"},
      {"label": "Gestión de Solicitudes", "href": "solicitudes.php"},
      {"label": "Perfil de Docentes", "href": "perfil_docentes.php"},
      {"label": "Certificado Académico", "href": "certificado.php"}
    ]'></unah-sidebar>

    <main class="main-content p-4">
      <div class="header animate__animated animate__fadeIn">
                    <h2><i class="fas fa-comments me-2" style="color: var(--unah-blue);"></i> Chat</h2>
                    <p class="mb-0">Comunícate con el departamento académico</p>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="card animate__animated animate__fadeInUp">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-users me-2"></i>Contactos</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush">
                                    <a href="#" class="list-group-item list-group-item-action active">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="...">
                                            <div>
                                                <h6 class="mb-0">Departamento Académico</h6>
                                                <small>En línea</small>
                                            </div>
                                            <span class="badge bg-white text-dark ms-auto">3</span>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="...">
                                            <div>
                                                <h6 class="mb-0">Consejería Estudiantil</h6>
                                                <small>En línea</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="...">
                                            <div>
                                                <h6 class="mb-0">Registro Académico</h6>
                                                <small>Disponible</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="...">
                                            <div>
                                                <h6 class="mb-0">Financiero</h6>
                                                <small>No disponible</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Buscar contacto...">
                                    <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-md-8">
                        <div class="card animate__animated animate__fadeInUp animate__delay-1s">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="...">
                                    <div>
                                        <h5 class="mb-0">Departamento Académico</h5>
                                        <small class="text-success">En línea</small>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-phone"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-video"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-ellipsis-v"></i></button>
                                </div>
                            </div>
                            <div class="card-body chat-container" style="height: 400px; overflow-y: auto; background-color: #f8f9fa;">
                                <div class="chat-message mb-3">
                                    <div class="d-flex justify-content-start">
                                        <div>
                                            <img src="https://via.placeholder.com/30" class="rounded-circle me-2" alt="...">
                                        </div>
                                        <div>
                                            <div class="bg-white p-3 rounded" style="max-width: 70%;">
                                                <p class="mb-0">Hola, ¿en qué puedo ayudarte hoy?</p>
                                            </div>
                                            <small class="text-muted">10:15 AM</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="chat-message mb-3">
                                    <div class="d-flex justify-content-end">
                                        <div>
                                            <div class="bg-primary text-white p-3 rounded" style="max-width: 70%;">
                                                <p class="mb-0">Hola, quería saber el estado de mi solicitud de cambio de carrera</p>
                                            </div>
                                            <small class="text-muted d-block text-end">10:16 AM</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="chat-message mb-3">
                                    <div class="d-flex justify-content-start">
                                        <div>
                                            <img src="https://via.placeholder.com/30" class="rounded-circle me-2" alt="...">
                                        </div>
                                        <div>
                                            <div class="bg-white p-3 rounded" style="max-width: 70%;">
                                                <p class="mb-0">Tu solicitud #12345 está en proceso de revisión. Faltan algunos documentos por validar.</p>
                                            </div>
                                            <small class="text-muted">10:18 AM</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="chat-message mb-3">
                                    <div class="d-flex justify-content-end">
                                        <div>
                                            <div class="bg-primary text-white p-3 rounded" style="max-width: 70%;">
                                                <p class="mb-0">¿Qué documentos faltan? Pensé que había enviado todo</p>
                                            </div>
                                            <small class="text-muted d-block text-end">10:19 AM</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Escribe un mensaje...">
                                    <button class="btn btn-unah" type="button"><i class="fas fa-paper-plane"></i></button>
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
