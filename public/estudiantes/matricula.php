<div class="header">
    <h2>Matrícula y Cancelación de Secciones</h2>
    <p class="mb-0">Realiza tu matrícula académica y gestiona tus secciones</p>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="matriculaTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="matricula-tab" data-bs-toggle="tab" data-bs-target="#matricula" type="button" role="tab" aria-controls="matricula" aria-selected="true">Matrícula</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cancelacion-tab" data-bs-toggle="tab" data-bs-target="#cancelacion" type="button" role="tab" aria-controls="cancelacion" aria-selected="false">Cancelación</button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="matriculaTabsContent">
                    <!-- Contenido MATRÍCULA -->
                    <div class="tab-pane fade show active" id="matricula" role="tabpanel" aria-labelledby="matricula-tab">
                        <div class="row">
                            <!-- Clasificación -->
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">Clasificación de Asignatura</label>
                                <select class="form-select" size="15">
                                    <option selected>Selecciona una clasificación</option>
                                    <option>Obligatoria</option>
                                    <option>Electiva</option>
                                    <option>General</option>
                                    <option>Prerrequisito</option>
                                    <option>Complementaria</option>
                                </select>
                            </div>

                            <!-- Asignatura -->
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">Asignatura</label>
                                <select class="form-select" size="15">
                                    <option selected>Selecciona una asignatura</option>
                                    <option>Matemática II</option>
                                    <option>Física I</option>
                                    <option>Inglés Técnico</option>
                                    <option>Algoritmos</option>
                                    <option>Programación I</option>
                                </select>
                            </div>

                            <!-- Horarios -->
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">Horarios Disponibles</label>
                                <select class="form-select" size="15">
                                    <option selected>Selecciona un horario</option>
                                    <option>0800 - Lunes/Miércoles 10:00-11:30</option>
                                    <option>0801 - Martes/Jueves 8:00-9:30</option>
                                    <option>0900 - Viernes 13:00-16:00</option>
                                    <option>1000 - Sábado 7:00-10:00</option>
                                    <option>1001 - Sábado 10:00-13:00</option>
                                </select>
                            </div>
                        </div>

                        <!-- Botón Matricular -->
                        <div class="text-center">
                            <button class="btn btn-unah px-5 py-2">Matricular</button>
                        </div>

                        <!-- Horario Generado -->
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
                        <!-- /Horario Generado -->

                    </div>

                    <!-- Contenido CANCELACIÓN -->
                    <div class="tab-pane fade" id="cancelacion" role="tabpanel" aria-labelledby="cancelacion-tab">
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
                </div> <!-- /.tab-content -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col-md-12 -->
</div> <!-- /.row -->
