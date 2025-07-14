<div class="profile-header">
    <div class="row align-items-center">
        <div class="col-md-2 text-center">
            <img src="https://via.placeholder.com/150" alt="Foto de perfil" class="profile-pic">
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
                    <div class="info-label">Correo Electrónico</div>
                    <div class="info-value" data-field="correo">juan.perez@unah.edu.hn</div>
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

        <!-- Tarjeta de estadísticas académicas (sin cambios) -->
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
                        <div class="info-item">
                            <div class="info-label">Tipo de Estudiante</div>
                            <div class="info-value" data-field="tipo">Regular</div>
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
        <form id="formEditarPerfil">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="correo" class="form-label">Correo Electrónico</label>
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
              <label for="identidad" class="form-label">Identidad</label>
              <input type="text" class="form-control" id="identidad" name="identidad" readonly>
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
