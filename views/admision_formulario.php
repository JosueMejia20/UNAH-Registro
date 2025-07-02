<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Admisiones - UNAH</title>
    <link rel="icon" href="https://lepidopterahonduras.wordpress.com/wp-content/uploads/2015/04/cropped-escudo-unah-22.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/../../assets/css/principal_components.css">
    <link rel="stylesheet" href="/../../assets/css/formulario_style.css">
</head>
<body>
    
    <unah-navbar></unah-navbar>

    <!-- Initial Loading Screen -->
    <div class="initial-loading" id="initialLoading">
        <img src="https://biologia.unah.edu.hn/dmsdocument/1433-unah-logo-texto" alt="Logo UNAH" class="initial-loading-logo">
        <div class="initial-spinner"></div>
        <div class="initial-loading-text">Cargando formulario de admisión...</div>
        <div class="initial-progress">
            <div class="initial-progress-bar" id="initialProgressBar"></div>
        </div>
    </div>

    <!-- Content Container (initially hidden) -->
    <div class="content-container" id="contentContainer">
        <!-- Loading Overlay for form submission -->
        <div class="loading-overlay" id="loadingOverlay">
            <div class="loading-spinner"></div>
            <div class="loading-text">Procesando su solicitud...</div>
        </div>

        <div class="container-form">
            <div class="header">
                <img src="https://biologia.unah.edu.hn/dmsdocument/1433-unah-logo-texto" alt="Logo UNAH" class="logo">
                <h1>Formulario de Admisión</h1>
                <p>Universidad Nacional Autónoma de Honduras</p>
            </div>

            <div class="form-container">
                <!-- Progress Bar -->
                <div class="progress-container">
                    <div class="progress-bar" id="progressBar"></div>
                </div>

                <!-- Section Indicator -->
                <div class="section-indicator">
                    <div class="section-step active" id="step1">1</div>
                    <div class="section-step" id="step2">2</div>
                    <div class="section-step" id="step3">3</div>
                    <div class="section-step" id="step4">4</div>
                    <div class="section-step" id="step5">5</div>
                </div>

                <form id="admissionForm" action="#" method="post" enctype="multipart/form-data">
                    <!-- Sección 1: Datos Personales -->
                    <div class="form-section active" id="section1" data-section="1">
                        <h2 class="section-title">Datos Personales</h2>
                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="primer-nombre" class="required">Primer Nombre</label>
                                    <input type="text" id="primer-nombre" name="primer-nombre" required>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="segundo-nombre">Segundo Nombre</label>
                                    <input type="text" id="segundo-nombre" name="segundo-nombre">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="primer-apellido" class="required">Primer Apellido</label>
                                    <input type="text" id="primer-apellido" name="primer-apellido" required>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="segundo-apellido">Segundo Apellido</label>
                                    <input type="text" id="segundo-apellido" name="segundo-apellido">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="fecha-nacimiento" class="required">Fecha de Nacimiento</label>
                                    <input type="date" id="fecha-nacimiento" name="fecha-nacimiento" required>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="genero" class="required">Género</label>
                                    <select id="genero" name="genero" required>
                                        <option value="">Seleccionar...</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="femenino">Femenino</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="identidad" class="required">Número de Identidad</label>
                                    <input type="text" id="identidad" name="identidad" required placeholder="0000-0000-00000" pattern="^\d{4}-\d{4}-\d{5}$" title="Formato correcto: 0000-0000-00000">
                                    <div class="error-message" id="identidad-error">El formato debe ser 0000-0000-00000</div>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="estado-civil" class="required">Estado Civil</label>
                                    <select id="estado-civil" name="estado-civil" required>
                                        <option value="">Seleccionar...</option>
                                        <option value="soltero">Soltero(a)</option>
                                        <option value="casado">Casado(a)</option>
                                        <option value="divorciado">Divorciado(a)</option>
                                        <option value="viudo">Viudo(a)</option>
                                        <option value="union-libre">Unión Libre</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-navigation">
                            <button type="button" class="btn btn-next" id="next1">Siguiente</button>
                        </div>
                    </div>

                    <!-- Sección 2: Información de Contacto -->
                    <div class="form-section" id="section2" data-section="2">
                        <h2 class="section-title">Información de Contacto</h2>
                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="departamento" class="required">Departamento de Residencia</label>
                                    <select id="departamento" name="departamento" required>
                                        <option value="">Seleccionar...</option>
                                        <option value="francisco-morazan">Francisco Morazán</option>
                                        <option value="cortes">Cortés</option>
                                        <option value="comayagua">Comayagua</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="municipio" class="required">Municipio</label>
                                    <input type="text" id="municipio" name="municipio" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="direccion" class="required">Dirección</label>
                                    <textarea id="direccion" name="direccion" rows="2" required></textarea>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="telefono" class="required">Teléfono</label>
                                    <input type="tel" id="telefono" name="telefono" required placeholder="0000-0000" pattern="^\d{4}-\d{4}$" title="Formato correcto: 0000-0000">
                                    <div class="error-message" id="telefono-error">El formato debe ser 0000-0000</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="email" class="required">Correo Electrónico</label>
                                    <input type="email" id="email" name="email" required placeholder="ejemplo@correo.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Ingrese un correo electrónico válido">
                                    <div class="error-message" id="email-error">Ingrese un correo electrónico válido</div>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="email-confirm" class="required">Confirmar Correo Electrónico</label>
                                    <input type="email" id="email-confirm" name="email-confirm" required placeholder="ejemplo@correo.com">
                                    <div class="error-message" id="email-confirm-error">Los correos electrónicos no coinciden</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-navigation">
                            <button type="button" class="btn btn-prev" id="prev2">Anterior</button>
                            <button type="button" class="btn btn-next" id="next2">Siguiente</button>
                        </div>
                    </div>

                    <!-- Sección 3: Información Académica -->
                    <div class="form-section" id="section3" data-section="3">
                        <h2 class="section-title">Información Académica</h2>
                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="instituto" class="required">Instituto de Educación Media</label>
                                    <input type="text" id="instituto" name="instituto" required>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="graduacion" class="required">Año de Graduación</label>
                                    <input type="number" id="graduacion" name="graduacion" min="1950" max="2025" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="pais-estudio" class="required">País donde realizó estudios</label>
                                    <select id="pais-estudio" name="pais-estudio" required>
                                        <option value="honduras">Honduras</option>
                                        <option value="otros">Otro país</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="titulo-obtenido" class="required">Título Obtenido</label>
                                    <input type="text" id="titulo-obtenido" name="titulo-obtenido" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="carrera-interes" class="required">Carrera de Interés</label>
                                    <select id="carrera-interes" name="carrera-interes" required>
                                        <option value="">Seleccionar...</option>
                                        <option value="medicina">Medicina</option>
                                        <option value="derecho">Derecho</option>
                                        <option value="ingenieria">Ingeniería</option>
                                        <option value="administracion">Administración de Empresas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="campus" class="required">Campus de Interés</label>
                                    <select id="campus" name="campus" required>
                                        <option value="">Seleccionar...</option>
                                        <option value="tegucigalpa">Tegucigalpa</option>
                                        <option value="san-pedro-sula">San Pedro Sula</option>
                                        <option value="comayagua">Comayagua</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-navigation">
                            <button type="button" class="btn btn-prev" id="prev3">Anterior</button>
                            <button type="button" class="btn btn-next" id="next3">Siguiente</button>
                        </div>
                    </div>

                    <!-- Sección 4: Documentación -->
                    <div class="form-section" id="section4" data-section="4">
                        <h2 class="section-title">Documentación Requerida</h2>
                        <div class="form-group">
                            <p>Por favor, adjunte los siguientes documentos (PDF o imágenes, máximo 5MB cada uno):</p>
                            
                            <div class="file-upload">
                                <label for="documentos" class="btn">Seleccionar Archivos</label>
                                <input type="file" id="documentos" name="documentos[]" multiple accept=".pdf,.jpg,.jpeg,.png" onchange="showFiles(this)">
                                <div class="file-list" id="fileList"></div>
                            </div>
                            
                            <div class="checkbox-group" style="margin-top: 20px;">
                                <input type="checkbox" id="doc-identidad" name="documentos-requeridos[]" value="identidad" required>
                                <label for="doc-identidad" class="required">Copia de identidad</label>
                            </div>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="doc-titulo" name="documentos-requeridos[]" value="titulo" required>
                                <label for="doc-titulo" class="required">Título de educación media (copia)</label>
                            </div>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="doc-record" name="documentos-requeridos[]" value="record" required>
                                <label for="doc-record" class="required">Record de notas (copia)</label>
                            </div>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="doc-foto" name="documentos-requeridos[]" value="foto">
                                <label for="doc-foto">Dos fotografías tamaño carnet</label>
                            </div>
                        </div>

                        <div class="form-navigation">
                            <button type="button" class="btn btn-prev" id="prev4">Anterior</button>
                            <button type="button" class="btn btn-next" id="next4">Siguiente</button>
                        </div>
                    </div>

                    <!-- Sección 5: Declaración -->
                    <div class="form-section" id="section5" data-section="5">
                        <h2 class="section-title">Declaración</h2>
                        <div class="form-group">
                            <div class="checkbox-group">
                                <input type="checkbox" id="declaracion" name="declaracion" required>
                                <label for="declaracion" class="required">Declaro que toda la información proporcionada es verídica y acepto los términos y condiciones del proceso de admisión.</label>
                            </div>
                        </div>

                        <div class="last-section-footer">
                            <div class="form-complete-message" id="completeMessage">
                                ¡Formulario completo! Revise sus datos antes de enviar.
                            </div>
                            <div>
                                <button type="button" class="btn btn-prev" id="prev5">Anterior</button>
                                <button type="submit" class="btn btn-submit" id="submitBtn">Enviar Solicitud</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <unah-footer></unah-footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../../assets/js/main.js"></script>
    <script src="../../assets/js/formulario_script.js"></script>

</body>
</html>