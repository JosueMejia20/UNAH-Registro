// Simula pantalla de carga
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('loading-screen').classList.add('hidden');
            }, 1500);
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Inicialización de componentes
            initNavigation();
            // Cargar vista inicial
            loadView('dashboard');
        });

        // Inicialización del sistema de navegación
        function initNavigation() {
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelectorAll('.nav-link').forEach(nav => nav.classList.remove('active'));
                    this.classList.add('active');
                    const view = this.getAttribute('data-view');
                    loadView(view);
                });
            });
        }

        // Cambio de vistas
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.nav-link').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
                const view = this.getAttribute('data-view');
                loadView(view);
            });
        });

        function loadView(view) {
            const mainContent = document.querySelector('.main-content');
            // Simula pantalla de carga
            window.addEventListener('load', function() {
                setTimeout(function() {
                    document.getElementById('loading-screen').classList.add('hidden');
                }, 1500);
            });

            // Animación de salida
            mainContent.classList.add('animate__animated', 'animate__fadeOut');
            
            setTimeout(() => {
                mainContent.innerHTML = '';
                
                // Cargar la vista correspondiente
                switch(view) {
                    case 'dashboard':
                        mainContent.innerHTML = getDashboardView();
                        break;
                    
                    case 'certificado':
                        mainContent.innerHTML = getCertificadoView();
                        break;
                    case 'evaluacion':
                        mainContent.innerHTML = getEvaluacionView();
                        break;
                    case 'chat':
                        mainContent.innerHTML = getChatView();
                        break;
                    case 'solicitudes':
                        mainContent.innerHTML = getSolicitudesView();
                        break;
                    case 'docentes':
                        mainContent.innerHTML = getDocentesView();
                        break;
                    case 'matricula':
                        mainContent.innerHTML = getMatriculaView();
                        break;
                }
                
                // Animación de entrada
                mainContent.classList.remove('animate__fadeOut');
                mainContent.classList.add('animate__animated', 'animate__fadeIn');
            }, 300);
        }

        // Funciones para generar cada vista
        function getDashboardView() {
            return `
                <div class="profile-header">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center">
                            <img src="https://via.placeholder.com/150" alt="Foto de perfil" class="profile-pic">
                        </div>
                        <div class="col-md-6">
                            <h2>Juan Carlos Pérez López</h2>
                            <p class="mb-1">Estudiante de Ingeniería en Sistemas</p>
                            <p class="mb-0">Matrícula: 201810010001</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <button class="btn btn-yellow me-2">Editar Perfil</button>
                            <button class="btn btn-light">Descargar Credencial</button>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Información Personal</h5>
                            </div>
                            <div class="card-body">
                                <div class="info-item">
                                    <div class="info-label">Correo Electrónico</div>
                                    <div class="info-value">juan.perez@unah.edu.hn</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Teléfono</div>
                                    <div class="info-value">+504 9876-5432</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Dirección</div>
                                    <div class="info-value">Colonia Las Colinas, Tegucigalpa</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Fecha de Nacimiento</div>
                                    <div class="info-value">15/03/2000</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Identidad</div>
                                    <div class="info-value">0801-2000-12345</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="mb-0">Estadísticas Académicas</h5>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-6 mb-3">
                                        <div class="stats-card">
                                            <div class="stats-number">3.8</div>
                                            <div class="stats-label">Índice Académico</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="stats-card">
                                            <div class="stats-number">85%</div>
                                            <div class="stats-label">Asistencia</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="stats-card">
                                            <div class="stats-number">45</div>
                                            <div class="stats-label">Créditos</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="stats-card">
                                            <div class="stats-number">5</div>
                                            <div class="stats-label">Períodos</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Información Académica</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="info-label">Carrera</div>
                                            <div class="info-value">Ingeniería en Sistemas</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Centro Universitario</div>
                                            <div class="info-value">CU Tegucigalpa</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Facultad</div>
                                            <div class="info-value">Ingeniería</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="info-label">Año de Ingreso</div>
                                            <div class="info-value">2018</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Estado</div>
                                            <div class="info-value"><span class="badge bg-success">Activo</span></div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Tipo de Estudiante</div>
                                            <div class="info-value">Regular</div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <div class="stats-card">
                                            <div class="stats-number">25</div>
                                            <div class="stats-label">Asignaturas Aprobadas</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="stats-card">
                                            <div class="stats-number">3</div>
                                            <div class="stats-label">Asignaturas Reprobadas</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="stats-card">
                                            <div class="stats-number">5</div>
                                            <div class="stats-label">Asignaturas Pendientes</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="stats-card">
                                            <div class="stats-number">33</div>
                                            <div class="stats-label">Asignaturas Restantes</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="mb-0">Materias Actuales</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Asignatura</th>
                                                <th>Sección</th>
                                                <th>Horario</th>
                                                <th>Docente</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>MAT-201</td>
                                                <td>Matemática II</td>
                                                <td>0800</td>
                                                <td>Lunes y Miércoles, 10:00-11:30</td>
                                                <td>Juan Carlos Martínez</td>
                                            </tr>
                                            <tr>
                                                <td>FIS-101</td>
                                                <td>Física I</td>
                                                <td>1000</td>
                                                <td>Martes y Jueves, 8:00-9:30</td>
                                                <td>Ana Lucia Fernández</td>
                                            </tr>
                                            <tr>
                                                <td>ING-301</td>
                                                <td>Inglés Técnico</td>
                                                <td>1200</td>
                                                <td>Viernes, 13:00-16:00</td>
                                                <td>María José García</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        function getCertificadoView() {
            return `
                <div class="header">
                    <h2>Certificado Académico</h2>
                    <p class="mb-0">Descarga tu historial académico oficial</p>
                </div>
                
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Generar Certificado</h5>
                            </div>
                            <div class="card-body text-center">
                                <div style="height: 120px; display: flex; justify-content: center; align-items: center; margin-bottom: 2rem;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#FF6B6B" viewBox="0 0 16 16">
                                        <path d="M5.523 10.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548zm2.455-1.647c-.119.025-.237.05-.356.078a21.035 21.035 0 0 0 .5-1.05 11.96 11.96 0 0 0 .51.858c-.217.032-.436.07-.654.114zm2.525.939a3.888 3.888 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256zM8.278 4.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z"/>
                                        <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm.165 11.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.458-.394.458-.742 0-.36-.08-.667-.237-.877-.136-.194-.343-.322-.528-.391-.263-.086-.543-.056-.75.039-.197.089-.307.234-.377.415-.1.242-.104.532.007.8.033.096.086.185.168.255z"/>
                                    </svg>
                                </div>
                                <h4>Certificado Académico Oficial</h4>
                                <p class="text-muted mb-4">Este documento contiene tu historial académico completo en la UNAH</p>
                                
                                <div class="alert alert-unah mb-4">
                                    <p class="mb-0">El certificado incluye todas las asignaturas cursadas, calificaciones obtenidas y estado actual de tu matrícula.</p>
                                </div>
                                
                                <button class="btn btn-unah btn-lg">
                                    Descargar Certificado
                                </button>
                                
                                <div class="mt-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="incluirPendientes" checked>
                                        <label class="form-check-label" for="incluirPendientes">Incluir materias pendientes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="incluirPromedio" checked>
                                        <label class="form-check-label" for="incluirPromedio">Incluir promedio acumulado</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <small>Última descarga: 15/03/2023</small>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        function getEvaluacionView() {
            return `
                <div class="header">
                    <h2>Evaluación Docente</h2>
                    <p class="mb-0">Completa las evaluaciones para ver tus calificaciones</p>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Evaluaciones Pendientes</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-unah mb-4">
                                    <p class="mb-0">Debes completar todas las evaluaciones docentes para poder visualizar tus calificaciones finales.</p>
                                </div>
                                
                                <div class="list-group">
                                    <div class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Matemática II</h5>
                                            <small class="text-warning">Pendiente</small>
                                        </div>
                                        <p class="mb-1">Prof. Juan Carlos Martínez</p>
                                        <small>Período: I PAC 2023</small>
                                        <button class="btn btn-sm btn-unah mt-2">Realizar Evaluación</button>
                                    </div>
                                    
                                    <div class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Física I</h5>
                                            <small class="text-warning">Pendiente</small>
                                        </div>
                                        <p class="mb-1">Prof. Ana Lucia Fernández</p>
                                        <small>Período: I PAC 2023</small>
                                        <button class="btn btn-sm btn-unah mt-2">Realizar Evaluación</button>
                                    </div>
                                    
                                    <div class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Inglés Técnico</h5>
                                            <small class="text-success">Completada</small>
                                        </div>
                                        <p class="mb-1">Prof. María José García</p>
                                        <small>Período: I PAC 2023</small>
                                        <button class="btn btn-sm btn-outline-secondary mt-2">Ver Evaluación</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Progreso</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="mb-4">
                                    <div class="d-flex justify-content-center mb-2">
                                        <div class="circular-progress" style="width: 120px; height: 120px; background: conic-gradient(var(--unah-blue) 66%, var(--blue-gray) 0); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <div style="width: 90px; height: 90px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.5rem;">
                                                66%
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-0">Evaluaciones completadas</p>
                                </div>
                                
                                <div class="alert alert-info">
                                    <small>Las evaluaciones son anónimas y confidenciales.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        function getChatView() {
            return `
                <div class="header animate__animated animate__fadeIn">
                    <h2><i class="fas fa-comments me-2" style="color: var(--unah-blue);"></i> Chat y Solicitudes</h2>
                    <p class="mb-0">Comunícate con el departamento académico y revisa el estado de tus solicitudes</p>
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
                        
                        <div class="card animate__animated animate__fadeInUp animate__delay-1s mt-3">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Estado de Solicitudes</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <small class="text-muted">Solicitud #12345</small>
                                    <h6 class="mb-1">Cambio de carrera</h6>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-success" style="width: 75%;"></div>
                                    </div>
                                    <small>En revisión</small>
                                </div>
                                
                                <div class="mb-3">
                                    <small class="text-muted">Solicitud #12346</small>
                                    <h6 class="mb-1">Reposición de matrícula</h6>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-warning" style="width: 30%;"></div>
                                    </div>
                                    <small>Documentación pendiente</small>
                                </div>
                                
                                <div class="mb-3">
                                    <small class="text-muted">Solicitud #12347</small>
                                    <h6 class="mb-1">Cancelación de asignatura</h6>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-success" style="width: 100%;"></div>
                                    </div>
                                    <small>Completada</small>
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
            `;
        }

        function getSolicitudesView() {
            return `
                <div class="header animate__animated animate__fadeIn">
                    <h2><i class="fas fa-file-alt me-2" style="color: var(--unah-blue);"></i> Gestión de Solicitudes</h2>
                    <p class="mb-0">Realiza y da seguimiento a tus solicitudes académicas</p>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="card animate__animated animate__fadeInUp">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Solicitudes Recientes</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th># Solicitud</th>
                                                <th>Tipo</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#12345</td>
                                                <td>Cambio de carrera</td>
                                                <td>15/03/2023</td>
                                                <td><span class="badge bg-warning">En revisión</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-print"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#12346</td>
                                                <td>Reposición de matrícula</td>
                                                <td>10/03/2023</td>
                                                <td><span class="badge bg-info">Documentación pendiente</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-print"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#12347</td>
                                                <td>Cancelación de asignatura</td>
                                                <td>05/03/2023</td>
                                                <td><span class="badge bg-success">Aprobada</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-print"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Anterior</a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Siguiente</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card animate__animated animate__fadeInUp animate__delay-1s">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Nueva Solicitud</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-unah mb-2" type="button">
                                        <i class="fas fa-exchange-alt me-2"></i>Cambio de Carrera
                                    </button>
                                    <button class="btn btn-unah mb-2" type="button">
                                        <i class="fas fa-ban me-2"></i>Cancelación de Matrícula
                                    </button>
                                    <button class="btn btn-unah mb-2" type="button">
                                        <i class="fas fa-redo me-2"></i>Reposición de Matrícula
                                    </button>
                                    <button class="btn btn-unah mb-2" type="button">
                                        <i class="fas fa-calendar-times me-2"></i>Cancelación de Asignatura
                                    </button>
                                    <button class="btn btn-unah mb-2" type="button">
                                        <i class="fas fa-file-upload me-2"></i>Subir Documentos
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card animate__animated animate__fadeInUp animate__delay-2s mt-3">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información Importante</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-warning">
                                    <h6><i class="fas fa-exclamation-triangle me-2"></i>Plazos de solicitud</h6>
                                    <p class="mb-0">Las solicitudes de cambio de carrera solo se reciben hasta el 30 de abril.</p>
                                </div>
                                
                                <div class="alert alert-info">
                                    <h6><i class="fas fa-clock me-2"></i>Tiempos de respuesta</h6>
                                    <ul class="mb-0">
                                        <li>Cambio de carrera: 15 días hábiles</li>
                                        <li>Cancelaciones: 5 días hábiles</li>
                                        <li>Reposiciones: 7 días hábiles</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        function getDocentesView() {
            return `
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
            `;
        }

        function getMatriculaView() {
            return `
                <div class="header">
                    <h2>Matrícula y Cancelación de Secciones</h2>
                    <p class="mb-0">Realiza tu matrícula académica y gestiona tus secciones</p>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#matricula-tab">Matrícula</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#cancelacion-tab">Cancelación</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="matricula-tab">
                                        <div class="alert alert-unah mb-4">
                                            <h5>Período de Matrícula Activo</h5>
                                            <p class="mb-0">Puedes matricularte en las asignaturas disponibles según tu índice académico.</p>
                                        </div>
                                        
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Buscar asignatura...">
                                                    <button class="btn btn-unah" type="button">Buscar</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <select class="form-select">
                                                        <option selected>Filtrar por departamento...</option>
                                                        <option>Matemáticas</option>
                                                        <option>Física</option>
                                                        <option>Inglés</option>
                                                        <option>Computación</option>
                                                    </select>
                                                    <button class="btn btn-outline-secondary" type="button">Filtrar</button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="accordion" id="asignaturasAccordion">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#matematicas">
                                                        Matemáticas
                                                    </button>
                                                </h2>
                                                <div id="matematicas" class="accordion-collapse collapse show" data-bs-parent="#asignaturasAccordion">
                                                    <div class="accordion-body p-0">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover mb-0">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th>Código</th>
                                                                        <th>Asignatura</th>
                                                                        <th>Secciones</th>
                                                                        <th>Créditos</th>
                                                                        <th>Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>MAT-201</td>
                                                                        <td>Matemática II</td>
                                                                        <td>
                                                                            <select class="form-select form-select-sm">
                                                                                <option selected>Seleccionar sección...</option>
                                                                                <option>0800 - Lunes/Miércoles 10:00-11:30 (C1-205)</option>
                                                                                <option>0801 - Martes/Jueves 8:00-9:30 (C2-102)</option>
                                                                            </select>
                                                                        </td>
                                                                        <td>4</td>
                                                                        <td><button class="btn btn-sm btn-success">Matricular</button></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>MAT-310</td>
                                                                        <td>Cálculo III</td>
                                                                        <td>
                                                                            <select class="form-select form-select-sm">
                                                                                <option selected>Seleccionar sección...</option>
                                                                                <option>0900 - Lunes/Miércoles 13:00-14:30 (C1-301)</option>
                                                                            </select>
                                                                        </td>
                                                                        <td>5</td>
                                                                        <td><button class="btn btn-sm btn-success">Matricular</button></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#fisica">
                                                        Física
                                                    </button>
                                                </h2>
                                                <div id="fisica" class="accordion-collapse collapse" data-bs-parent="#asignaturasAccordion">
                                                    <div class="accordion-body p-0">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover mb-0">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th>Código</th>
                                                                        <th>Asignatura</th>
                                                                        <th>Secciones</th>
                                                                        <th>Créditos</th>
                                                                        <th>Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>FIS-101</td>
                                                                        <td>Física I</td>
                                                                        <td>
                                                                            <select class="form-select form-select-sm">
                                                                                <option selected>Seleccionar sección...</option>
                                                                                <option>1000 - Martes/Jueves 8:00-9:30 (F1-105)</option>
                                                                                <option>1001 - Viernes 13:00-16:00 (F1-201)</option>
                                                                            </select>
                                                                        </td>
                                                                        <td>4</td>
                                                                        <td><button class="btn btn-sm btn-success">Matricular</button></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card mt-4">
                                            <div class="card-header">
                                                <h5 class="mb-0">Horario Generado</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>Hora</th>
                                                                <th>Lunes</th>
                                                                <th>Martes</th>
                                                                <th>Miércoles</th>
                                                                <th>Jueves</th>
                                                                <th>Viernes</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>7:00 - 8:30</td>
                                                                <td></td>
                                                                <td class="bg-light-blue">Física I<br>F1-105</td>
                                                                <td></td>
                                                                <td class="bg-light-blue">Física I<br>F1-105</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>8:30 - 10:00</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>10:00 - 11:30</td>
                                                                <td class="bg-light-blue">Matemática II<br>C1-205</td>
                                                                <td></td>
                                                                <td class="bg-light-blue">Matemática II<br>C1-205</td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>13:00 - 14:30</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="bg-light-blue">Inglés Técnico<br>I2-302</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="tab-pane fade" id="cancelacion-tab">
                                        <div class="alert alert-unah mb-4">
                                            <h5>Período de Cancelación</h5>
                                            <p class="mb-0">Puedes cancelar asignaturas durante el período de matrícula sin penalización.</p>
                                        </div>
                                        
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 40px;"></th>
                                                        <th>Código</th>
                                                        <th>Asignatura</th>
                                                        <th>Sección</th>
                                                        <th>Horario</th>
                                                        <th>Docente</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input class="form-check-input" type="checkbox"></td>
                                                        <td>MAT-201</td>
                                                        <td>Matemática II</td>
                                                        <td>0800</td>
                                                        <td>Lunes y Miércoles, 10:00-11:30</td>
                                                        <td>Juan Carlos Martínez</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input class="form-check-input" type="checkbox"></td>
                                                        <td>FIS-101</td>
                                                        <td>Física I</td>
                                                        <td>1000</td>
                                                        <td>Martes y Jueves, 8:00-9:30</td>
                                                        <td>Ana Lucia Fernández</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between mt-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="selectAllCancel">
                                                <label class="form-check-label" for="selectAllCancel">
                                                    Seleccionar todas
                                                </label>
                                            </div>
                                            <button class="btn btn-danger">
                                                Cancelar seleccionadas
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }