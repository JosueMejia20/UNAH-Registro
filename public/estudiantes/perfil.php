<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Estudiante - UNAH</title>
    <link rel="icon" href="https://lepidopterahonduras.wordpress.com/wp-content/uploads/2015/04/cropped-escudo-unah-22.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/../../assets/css/principal_components.css">
    <link rel="stylesheet" href="/../../assets/css/estudiante_style.css">
</head>

<body>
    <unah-navbar></unah-navbar>

    <div class="container-completo">
        <!-- Sidebar -->
        <unah-sidebar menu-items='[
      {"label": "Perfil", "href": "perfil.php"},
      {"label": "Matrícula", "href": "matricula.php"},
      {"label": "Chat", "href": "chat.php"},
      {"label": "Gestión de Solicitudes", "href": "solicitudes.php"},
      {"label": "Perfil de Docentes", "href": "perfil_docentes.php"},
      {"label": "Certificado Académico", "href": "certificado.php"},
      {"label": "Evaluacion Docente", "href": "evaluaciones.php"}
    ]'
    ></unah-sidebar>

        <!-- Contenido principal -->
        <main class="main-content p-4">
            <div class="profile-header">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center">
                        <img id="fotoDePerfil" src="" alt="Foto perfil" class="profile-pic">
                    </div>
                    <div class="col-md-6">
                        <h2 data-field="nombre_completo">Juan Carlos Pérez López</h2>
                        <p class="mb-1"><span data-field="carrera_resumen">Estudiante de Ingeniería en Sistemas</span></p>
                        <p class="mb-0">Matrícula: <span data-field="matricula">201810010001</span></p>
                    </div>
                    <div class="col-md-4 text-end">
                        <button class="btn btn-yellow me-2" id="btn-editar-perfil">Editar Perfil</button>
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
                                <div class="info-label">Correo Electrónico Institucional</div>
                                <div class="info-value" data-field="correo_institucional">juan.perez@unah.edu.hn</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Correo Electrónico Personal</div>
                                <div class="info-value" data-field="correo_personal">juan.perez@unah.edu.hn</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Teléfono</div>
                                <div class="info-value" data-field="telefono">+504 9876-5432</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Dirección</div>
                                <div class="info-value" data-field="direccion">Colonia Las Colinas, Tegucigalpa</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Fecha de Nacimiento</div>
                                <div class="info-value" data-field="fecha_nacimiento">15/03/2000</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Identidad</div>
                                <div class="info-value" data-field="identidad">0801-2000-12345</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información académica -->
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
                                        <div class="info-value" data-field="carrera">Ingeniería en Sistemas</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Centro Universitario</div>
                                        <div class="info-value" data-field="centro">CU Tegucigalpa</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Facultad</div>
                                        <div class="info-value" data-field="facultad">Ingeniería</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">Año de Ingreso</div>
                                        <div class="info-value" data-field="ingreso">2018</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Estado</div>
                                        <div class="info-value" data-field="estado"><span class="badge bg-success">Activo</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Materias -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="mb-0">Materias Actuales</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="tabla-materias">
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
                                        <!-- Cuerpo dinámico cargado por JS -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL DE EDICIÓN -->
            <div class="modal fade" id="modalEditarPerfil" tabindex="-1" aria-labelledby="editarPerfilLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-warning text-dark">
                            <h5 class="modal-title" id="editarPerfilLabel">Editar Perfil del Estudiante</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formEditarPerfil" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="correo" class="form-label">Correo Electrónico Personal</label>
                                        <input type="email" class="form-control" id="correo" name="correo" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="telefono" class="form-label">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="direccion" class="form-label">Dirección</label>
                                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_perfil" class="form-label">Foto de Perfil</label>
                                        <input type="file" class="form-control" id="foto_perfil" name="foto_perfil" accept="image/*">
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Overlay de carga -->
    <div id="overlayCarga">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
    </div>

    <unah-modal></unah-modal>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>

</html>