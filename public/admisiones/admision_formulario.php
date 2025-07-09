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
                                    <label for="nombre-completo" class="required">Nombre(s) Completo(s)</label>
                                    <input type="text" id="nombre-completo" name="nombre_completo" required 
                                           pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" 
                                           title="Ingrese su(s) nombre(s) completo(s)">
                                    <div class="error-message" id="nombre-completo-error">Ingrese al menos un nombre válido</div>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="apellido-completo" class="required">Apellido(s) Completo(s)</label>
                                    <input type="text" id="apellido-completo" name="apellido_completo" required
                                           pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+"
                                           title="Ingrese su(s) apellido(s) completo(s)">
                                    <div class="error-message" id="apellido-completo-error">Ingrese al menos un apellido válido</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="fecha-nacimiento" class="required">Fecha de Nacimiento</label>
                                    <input type="date" id="fecha-nacimiento" name="fecha_nacimiento" required>
                                    <div class="error-message" id="fecha-nacimiento-error">Debe ser una fecha válida</div>
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
                                    <div class="error-message" id="genero-error">Seleccione una opción</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="tipo-identificacion" class="required">Tipo de Identificación</label>
                                    <select id="tipo-identificacion" name="tipo_identificacion" required>
                                        <option value="">Seleccionar...</option>
                                        <option value="identidad">Identidad</option>
                                        <option value="pasaporte">Pasaporte</option>
                                    </select>
                                    <div class="error-message" id="tipo-identificacion-error">Seleccione una opción</div>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="numero-identificacion" class="required">Número de Identificación</label>
                                    <input type="text" id="numero-identificacion" name="numero_identificacion" required 
                                           placeholder="0000-0000-00000 o número de pasaporte">
                                    <div class="error-message" id="numero-identificacion-error">Ingrese un número válido</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="estado-civil" class="required">Estado Civil</label>
                                    <select id="estado-civil" name="estado_civil" required>
                                        <option value="">Seleccionar...</option>
                                        
                                    </select>
                                    <div class="error-message" id="estado-civil-error">Seleccione una opción</div>
                                </div>
                            </div>
                            <div class="form-col">
                                <!-- Espacio dejado para mantener el diseño -->
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
                                        
                                    </select>
                                    <div class="error-message" id="departamento-error">Seleccione un departamento</div>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="direccion" class="required">Dirección Completa</label>
                                    <textarea id="direccion" name="direccion" rows="2" required></textarea>
                                    <div class="error-message" id="direccion-error">Ingrese una dirección válida</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="telefono" class="required">Teléfono</label>
                                    <input type="tel" id="telefono" name="telefono" required 
                                           placeholder="3XXX-XXXX, 7XXX-XXXX, 22XX-XXXX, 8XXX-XXXX o 9XXX-XXXX" 
                                           pattern="^(3\d{3}|7\d{3}|22\d{2}|[89]\d{3})-\d{4}$" 
                                           title="Ingrese un número de teléfono hondureño válido">
                                    <div class="error-message" id="telefono-error">El formato debe ser 3XXX-XXXX, 7XXX-XXXX, 22XX-XXXX, 8XXX-XXXX o 9XXX-XXXX</div>
                                </div>
                            </div>
                            <div class="form-col">
                                <!-- Espacio dejado para mantener el diseño -->
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="email" class="required">Correo Electrónico</label>
                                    <input type="email" id="email" name="email" required placeholder="ejemplo@correo.com" 
                                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                                           title="Ingrese un correo electrónico válido">
                                    <div class="error-message" id="email-error">Ingrese un correo electrónico válido</div>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="email-confirm" class="required">Confirmar Correo Electrónico</label>
                                    <input type="email" id="email-confirm" name="email_confirm" required placeholder="ejemplo@correo.com">
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
                                    <input type="text" id="instituto" name="instituto_educacion_media" required>
                                    <div class="error-message" id="instituto-error">Ingrese el nombre del instituto</div>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="graduacion" class="required">Año de Graduación</label>
                                    <input type="number" id="graduacion" name="anio_graduacion" min="1950" max="2025" required
                                           title="El año debe estar entre 1950 y 2025">
                                    <div class="error-message" id="graduacion-error">Ingrese un año válido (1950-2025)</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="pais-estudio" class="required">País donde realizó estudios</label>
                                    <select id="pais-estudio" name="pais_estudios" required>
                                        <option value="">Seleccionar...</option>
                                        <option value="honduras">Honduras</option>
                                        <option value="otros">Otro país</option>
                                    </select>
                                    <div class="error-message" id="pais-estudio-error">Seleccione una opción</div>
                                </div>
                            </div>
                            <div class="form-col">
                                <!-- Espacio dejado para mantener el diseño -->
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="centro-regional" class="required">Centro Regional</label>
                                    <select id="centro-regional" name="centro_regional" required>
                                        
                                    </select>
                                    <div class="error-message" id="centro-regional-error">Seleccione un centro regional</div>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="carrera-interes" class="required">Carrera de Interés (Primera Opción)</label>
                                    <select id="carrera-interes" name="carrera_interes_primera" required>
                                        
                                    </select>
                                    <div class="error-message" id="carrera-interes-error">Seleccione una carrera</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="carrera-secundaria">Carrera de Interés (Segunda Opción)</label>
                                    <select id="carrera-secundaria" name="carrera_interes_secundaria">
                                        <option value="">Seleccione una carrera</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-col">
                                <!-- Espacio dejado para mantener el diseño -->
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
                            <p>Por favor, adjunte su título de educación media (PDF o imágenes JPG/PNG, máximo 5MB):</p>
                            
                            <div class="file-upload">
                                <label for="documentos" class="btn">Seleccionar Archivo</label>
                                <input type="file" id="documentos" name="documentos" 
                                       accept=".pdf,.jpg,.jpeg,.png" 
                                       onchange="validateFiles(this)" required>
                                <div class="file-list" id="fileList"></div>
                                <div class="file-error" id="fileError"></div>
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
                                <div class="error-message" id="declaracion-error">Debe aceptar la declaración</div>
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

    <div id="previewDatos" class="alert alert-info mt-4" style="display:none; white-space: pre-wrap;"></div>

    <unah-footer></unah-footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../../assets/js/mainAdmisiones.js"></script>
    
    <script src="../../assets/js/Admisiones/formulario_script.js"></script>

</body>
</html>