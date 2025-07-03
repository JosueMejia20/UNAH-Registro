//  Reemplaza todo el código JavaScript con este: 

        // Variables globales
        let currentSection = 1;
        const totalSections = 5;
        const form = document.getElementById('admissionForm');
        const loadingOverlay = document.getElementById('loadingOverlay');
        const initialLoading = document.getElementById('initialLoading');
        const contentContainer = document.getElementById('contentContainer');
        const initialProgressBar = document.getElementById('initialProgressBar');
        
        // Mapeo de carreras por centro regional (actualizado)
        const carrerasPorCentro = {
            'tegucigalpa': [
                {value: 'medicina', text: 'Medicina'},
                {value: 'derecho', text: 'Derecho'},
                {value: 'ingenieria-civil', text: 'Ingeniería Civil'},
                {value: 'arquitectura', text: 'Arquitectura'},
                {value: 'psicologia', text: 'Psicología'},
                {value: 'administracion', text: 'Administración de Empresas'}
            ],
            'san-pedro-sula': [
                {value: 'administracion', text: 'Administración de Empresas'},
                {value: 'contaduria', text: 'Contaduría Pública'},
                {value: 'ingenieria-industrial', text: 'Ingeniería Industrial'},
                {value: 'ingenieria-sistemas', text: 'Ingeniería en Sistemas'},
                {value: 'mercadotecnia', text: 'Mercadotecnia'}
            ],
            'comayagua': [
                {value: 'agronomia', text: 'Agronomía'},
                {value: 'veterinaria', text: 'Medicina Veterinaria'},
                {value: 'ingenieria-ambiental', text: 'Ingeniería Ambiental'},
                {value: 'ingenieria-alimentos', text: 'Ingeniería en Alimentos'}
            ],
            'la-ceiba': [
                {value: 'turismo', text: 'Turismo'},
                {value: 'hoteleria', text: 'Hotelería'},
                {value: 'biologia-marina', text: 'Biología Marina'}
            ],
            'puerto-cortes': [
                {value: 'logistica', text: 'Logística Portuaria'},
                {value: 'comercio-internacional', text: 'Comercio Internacional'}
            ]
        };

        // Mostrar pantalla de carga inicial
        document.addEventListener('DOMContentLoaded', function() {
            // Simular carga de recursos
            simulateInitialLoading();
            
            // Configurar eventos para el centro regional y carreras
            document.getElementById('centro-regional').addEventListener('change', function() {
                cargarCarreras();
                
                // Validación adicional para habilitar/deshabilitar los selects
                const carreraPrimera = document.getElementById('carrera-interes');
                const carreraSecundaria = document.getElementById('carrera-secundaria');
                
                if (this.value) {
                    carreraPrimera.disabled = false;
                    carreraSecundaria.disabled = false;
                } else {
                    carreraPrimera.disabled = true;
                    carreraSecundaria.disabled = true;
                }
            });

            // La función cargarCarreras() debe quedar así:
            function cargarCarreras() {
                const centroSelect = document.getElementById('centro-regional');
                const carreraPrimera = document.getElementById('carrera-interes');
                const carreraSecundaria = document.getElementById('carrera-secundaria');
                
                // Limpiar opciones actuales
                carreraPrimera.innerHTML = '';
                carreraSecundaria.innerHTML = '';
                
                if (centroSelect.value) {
                    // Habilitar selects
                    carreraPrimera.disabled = false;
                    carreraSecundaria.disabled = false;
                    
                    const carreras = carrerasPorCentro[centroSelect.value] || [];
                    
                    // Agregar opción por defecto
                    const defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = 'Seleccione una carrera';
                    carreraPrimera.appendChild(defaultOption.cloneNode(true));
                    carreraSecundaria.appendChild(defaultOption.cloneNode(true));
                    
                    // Agregar carreras disponibles
                    carreras.forEach(carrera => {
                        const option = document.createElement('option');
                        option.value = carrera.value;
                        option.textContent = carrera.text;
                        carreraPrimera.appendChild(option);
                        
                        const option2 = option.cloneNode(true);
                        carreraSecundaria.appendChild(option2);
                    });
                } else {
                    // Deshabilitar selects y mostrar mensaje
                    carreraPrimera.disabled = true;
                    carreraSecundaria.disabled = true;
                    
                    const defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = 'Primero seleccione un centro regional';
                    carreraPrimera.appendChild(defaultOption);
                    carreraSecundaria.appendChild(defaultOption.cloneNode(true));
                }
            }
            
            // Configurar evento para código de país
            document.getElementById('codigo-pais').addEventListener('change', function() {
                const codigoPaisInput = document.getElementById('codigo-pais-input');
                if (this.value === 'other') {
                    codigoPaisInput.readOnly = false;
                    codigoPaisInput.value = '';
                    codigoPaisInput.placeholder = 'Ingrese código';
                } else {
                    codigoPaisInput.readOnly = true;
                    codigoPaisInput.value = this.value;
                }
            });
            
            // Configurar validación para número de identificación según tipo
            document.getElementById('tipo-identificacion').addEventListener('change', function() {
                const numeroIdentificacion = document.getElementById('numero-identificacion');
                const errorElement = document.getElementById('numero-identificacion-error');
                
                if (this.value === 'identidad') {
                    numeroIdentificacion.pattern = '^\\d{4}-\\d{4}-\\d{5}$';
                    numeroIdentificacion.title = 'Formato correcto: 0000-0000-00000';
                    numeroIdentificacion.placeholder = '0000-0000-00000';
                    errorElement.textContent = 'El formato debe ser 0000-0000-00000';
                } else if (this.value === 'pasaporte') {
                    numeroIdentificacion.pattern = '^[A-Za-z0-9]{6,20}$';
                    numeroIdentificacion.title = 'Ingrese su número de pasaporte';
                    numeroIdentificacion.placeholder = 'Número de pasaporte';
                    errorElement.textContent = 'Ingrese un número de pasaporte válido';
                }
            });
        });

        // Simular carga inicial
        function simulateInitialLoading() {
            let progress = 0;
            const interval = setInterval(function() {
                progress += Math.random() * 10;
                if (progress > 100) progress = 100;
                initialProgressBar.style.width = `${progress}%`;
                
                if (progress >= 100) {
                    clearInterval(interval);
                    setTimeout(function() {
                        initialLoading.classList.add('hidden');
                        contentContainer.classList.add('show');
                        setupForm();
                    }, 500);
                }
            }, 300);
        }

        // Configurar el formulario después de que se cargue la página
        function setupForm() {
            // Mostrar archivos seleccionados
            function showFiles(input) {
                const fileList = document.getElementById('fileList');
                fileList.innerHTML = '';
                
                if (input.files.length > 0) {
                    for (let i = 0; i < input.files.length; i++) {
                        const fileItem = document.createElement('div');
                        fileItem.className = 'file-item';
                        fileItem.innerHTML = `
                            <span class="file-name">${input.files[i].name}</span>
                            <span class="remove-file" onclick="removeFile(this, ${i})">×</span>
                        `;
                        fileList.appendChild(fileItem);
                    }
                }
                checkSectionCompletion(4);
            }

            // Eliminar archivo de la lista
            function removeFile(element, index) {
                const input = document.getElementById('documentos');
                const files = Array.from(input.files);
                files.splice(index, 1);
                
                const dataTransfer = new DataTransfer();
                files.forEach(file => dataTransfer.items.add(file));
                input.files = dataTransfer.files;
                
                showFiles(input);
            }

            // Cambiar sección
            function goToSection(sectionNumber) {
                // Ocultar sección actual
                document.getElementById(`section${currentSection}`).classList.remove('active');
                document.getElementById(`step${currentSection}`).classList.remove('active');
                
                // Mostrar nueva sección
                document.getElementById(`section${sectionNumber}`).classList.add('active');
                document.getElementById(`step${sectionNumber}`).classList.add('active');
                
                // Marcar sección anterior como completada
                if (sectionNumber > currentSection) {
                    document.getElementById(`section${currentSection}`).classList.add('completed');
                    document.getElementById(`step${currentSection}`).classList.add('completed');
                }
                
                currentSection = sectionNumber;
                
                // Actualizar barra de progreso
                updateProgressBar();
                
                // Mostrar mensaje de completado en la última sección
                if (currentSection === totalSections) {
                    const allComplete = checkFormCompletion();
                    document.getElementById('completeMessage').style.display = allComplete ? 'block' : 'none';
                }
                
                // Desplazar hacia arriba
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }

            // Actualizar barra de progreso
            function updateProgressBar() {
                const progress = ((currentSection - 1) / (totalSections - 1)) * 100;
                document.getElementById('progressBar').style.width = `${progress}%`;
            }

            // Validar sección actual
            function validateCurrentSection() {
                const section = document.getElementById(`section${currentSection}`);
                const inputs = section.querySelectorAll('input[required], select[required], textarea[required]');
                let isValid = true;
                
                inputs.forEach(input => {
                    if (!input.value) {
                        isValid = false;
                        input.classList.add('invalid');
                    } else {
                        input.classList.remove('invalid');
                    }
                    
                    // Validación especial para checkboxes
                    if (input.type === 'checkbox' && !input.checked) {
                        isValid = false;
                        input.classList.add('invalid');
                    } else if (input.type === 'checkbox') {
                        input.classList.remove('invalid');
                    }
                });
                
                // Validación especial para email
                if (currentSection === 2) {
                    const email = document.getElementById('email');
                    const emailConfirm = document.getElementById('email-confirm');
                    
                    if (email.value !== emailConfirm.value) {
                        isValid = false;
                        emailConfirm.classList.add('invalid');
                        document.getElementById('email-confirm-error').style.display = 'block';
                    } else {
                        emailConfirm.classList.remove('invalid');
                        document.getElementById('email-confirm-error').style.display = 'none';
                    }
                }
                
                return isValid;
            }

            // Verificar si una sección está completa
            function checkSectionCompletion(sectionNumber) {
                const section = document.getElementById(`section${sectionNumber}`);
                const inputs = section.querySelectorAll('input[required], select[required], textarea[required]');
                let isComplete = true;
                
                inputs.forEach(input => {
                    if (!input.value) {
                        isComplete = false;
                    }
                    
                    if (input.type === 'checkbox' && !input.checked) {
                        isComplete = false;
                    }
                });
                
                // Verificación especial para archivos
                if (sectionNumber === 4) {
                    const fileInput = document.getElementById('documentos');
                    if (fileInput.files.length === 0) {
                        isComplete = false;
                    }
                }
                
                return isComplete;
            }

            // Verificar si todo el formulario está completo
            function checkFormCompletion() {
                let allSectionsComplete = true;
                
                for (let i = 1; i <= totalSections; i++) {
                    if (!checkSectionCompletion(i)) {
                        allSectionsComplete = false;
                        break;
                    }
                }
                
                // Mostrar/ocultar mensaje en la última sección
                if (currentSection === totalSections) {
                    document.getElementById('completeMessage').style.display = allComplete ? 'block' : 'none';
                }
                
                return allSectionsComplete;
            }

            // Mostrar pantalla de carga
            function showLoading() {
                loadingOverlay.classList.add('active');
            }

            // Ocultar pantalla de carga
            function hideLoading() {
                loadingOverlay.classList.remove('active');
            }

            // Función para cargar carreras según el centro regional seleccionado (CORREGIDA)
            function cargarCarreras() {
                const centroSelect = document.getElementById('centro-regional');
                const carreraPrimera = document.getElementById('carrera-interes');
                const carreraSecundaria = document.getElementById('carrera-secundaria');
                
                // Limpiar opciones actuales
                carreraPrimera.innerHTML = '';
                carreraSecundaria.innerHTML = '';
                
                if (centroSelect.value && carrerasPorCentro[centroSelect.value]) {
                    // Habilitar los selects de carreras
                    carreraPrimera.disabled = false;
                    carreraSecundaria.disabled = false;
                    
                    // Obtener las carreras para el centro seleccionado
                    const carreras = carrerasPorCentro[centroSelect.value];
                    
                    // Agregar opción por defecto
                    const defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = 'Seleccione una carrera';
                    carreraPrimera.appendChild(defaultOption.cloneNode(true));
                    carreraSecundaria.appendChild(defaultOption.cloneNode(true));
                    
                    // Agregar carreras disponibles a ambos selects
                    carreras.forEach(carrera => {
                        const option1 = document.createElement('option');
                        option1.value = carrera.value;
                        option1.textContent = carrera.text;
                        carreraPrimera.appendChild(option1);
                        
                        const option2 = document.createElement('option');
                        option2.value = carrera.value;
                        option2.textContent = carrera.text;
                        carreraSecundaria.appendChild(option2);
                    });
                } else {
                    // Deshabilitar y resetear los selects si no hay centro seleccionado
                    carreraPrimera.disabled = true;
                    carreraSecundaria.disabled = true;
                    
                    const defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = centroSelect.value ? 'No hay carreras disponibles' : 'Primero seleccione un centro regional';
                    carreraPrimera.appendChild(defaultOption);
                    carreraSecundaria.appendChild(defaultOption.cloneNode(true));
                }
            }

            // Validación de archivos adjuntos
            function validateFiles(input) {
                const fileError = document.getElementById('fileError');
                const fileList = document.getElementById('fileList');
                const maxSize = 5 * 1024 * 1024; // 5MB
                const allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
                let isValid = true;
                
                fileError.textContent = '';
                fileList.innerHTML = '';
                
                if (input.files.length > 0) {
                    for (let i = 0; i < input.files.length; i++) {
                        const file = input.files[i];
                        const fileItem = document.createElement('div');
                        fileItem.textContent = `${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                        
                        // Validar tipo de archivo
                        if (!allowedTypes.includes(file.type)) {
                            fileItem.textContent += ' - Formato no permitido';
                            fileItem.style.color = 'red';
                            isValid = false;
                        }
                        
                        // Validar tamaño
                        if (file.size > maxSize) {
                            fileItem.textContent += ' - Archivo demasiado grande (máx. 5MB)';
                            fileItem.style.color = 'red';
                            isValid = false;
                        }
                        
                        // Validar dimensiones si es imagen
                        if (file.type.startsWith('image/') && file.type !== 'image/svg+xml') {
                            const img = new Image();
                            img.onload = function() {
                                if (this.width > 2000 || this.height > 2000) {
                                    fileItem.textContent += ' - Imagen demasiado grande (máx. 2000x2000px)';
                                    fileItem.style.color = 'red';
                                    isValid = false;
                                    fileError.textContent = 'Algunos archivos no cumplen con los requisitos';
                                }
                            };
                            img.src = URL.createObjectURL(file);
                        }
                        
                        fileList.appendChild(fileItem);
                    }
                    
                    if (!isValid) {
                        fileError.textContent = 'Algunos archivos no cumplen con los requisitos';
                        input.value = ''; // Limpiar selección si hay errores
                    }
                }
                
                return isValid;
            }

            // Validación de campos de nombre (sin caracteres especiales)
            function validarNombre(input) {
                const regex = /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/;
                return regex.test(input.value);
            }

            // Validación de sección antes de avanzar
            function validarSeccion(seccionId) {
                let isValid = true;
                const seccion = document.getElementById(seccionId);
                const inputs = seccion.querySelectorAll('input[required], select[required], textarea[required]');
                
                inputs.forEach(input => {
                    const errorElement = document.getElementById(`${input.id}-error`);
                    
                    // Validación especial para campos de nombre
                    if (input.id.includes('nombre') || input.id.includes('apellido')) {
                        if (input.value && !validarNombre(input)) {
                            input.classList.add('invalid');
                            if (errorElement) errorElement.style.display = 'block';
                            isValid = false;
                            return;
                        }
                    }
                    
                    // Validación para confirmación de email
                    if (input.id === 'email-confirm') {
                        const email = document.getElementById('email').value;
                        if (input.value !== email) {
                            input.classList.add('invalid');
                            if (errorElement) errorElement.style.display = 'block';
                            isValid = false;
                            return;
                        }
                    }
                    
                    // Validación para número de identificación según tipo
                    if (input.id === 'numero-identificacion') {
                        const tipoIdentificacion = document.getElementById('tipo-identificacion').value;
                        if (tipoIdentificacion === 'identidad') {
                            const regex = /^\d{4}-\d{4}-\d{5}$/;
                            if (!regex.test(input.value)) {
                                input.classList.add('invalid');
                                if (errorElement) errorElement.style.display = 'block';
                                isValid = false;
                                return;
                            }
                        } else if (tipoIdentificacion === 'pasaporte') {
                            const regex = /^[A-Za-z0-9]{6,20}$/;
                            if (!regex.test(input.value)) {
                                input.classList.add('invalid');
                                if (errorElement) errorElement.style.display = 'block';
                                isValid = false;
                                return;
                            }
                        }
                    }
                    
                    // Validación para carreras
                    if (input.id === 'carrera-interes' || input.id === 'centro-regional') {
                        if (!input.value) {
                            input.classList.add('invalid');
                            if (errorElement) errorElement.style.display = 'block';
                            isValid = false;
                            return;
                        }
                    }
                    
                    // Validación estándar
                    if (!input.value) {
                        input.classList.add('invalid');
                        if (errorElement) errorElement.style.display = 'block';
                        isValid = false;
                    } else {
                        input.classList.remove('invalid');
                        input.classList.add('valid');
                        if (errorElement) errorElement.style.display = 'none';
                    }
                });
                
                // Validación especial para archivos en la sección 4
                if (seccionId === 'section4') {
                    const fileInput = document.getElementById('documentos');
                    const requiredCheckboxes = seccion.querySelectorAll('input[type="checkbox"][required]');
                    
                    // Validar que al menos un archivo esté adjunto para los documentos requeridos
                    let hasFiles = fileInput.files.length > 0;
                    if (!hasFiles) {
                        document.getElementById('fileError').textContent = 'Debe adjuntar al menos un archivo';
                        isValid = false;
                    } else if (!validateFiles(fileInput)) {
                        isValid = false;
                    }
                    
                    // Validar checkboxes de documentos requeridos
                    requiredCheckboxes.forEach(checkbox => {
                        const errorElement = document.getElementById(`${checkbox.id}-error`);
                        if (!checkbox.checked) {
                            if (errorElement) errorElement.style.display = 'block';
                            isValid = false;
                        } else {
                            if (errorElement) errorElement.style.display = 'none';
                        }
                    });
                }
                
                return isValid;
            }

            // Configurar navegación
            document.getElementById('next1').addEventListener('click', function() {
                if (validarSeccion('section1')) {
                    goToSection(2);
                }
            });
            
            document.getElementById('next2').addEventListener('click', function() {
                if (validarSeccion('section2')) {
                    goToSection(3);
                }
            });
            
            document.getElementById('next3').addEventListener('click', function() {
                if (validarSeccion('section3')) {
                    goToSection(4);
                }
            });
            
            document.getElementById('next4').addEventListener('click', function() {
                if (validarSeccion('section4')) {
                    goToSection(5);
                }
            });
            
            document.getElementById('prev2').addEventListener('click', function() {
                goToSection(1);
            });
            
            document.getElementById('prev3').addEventListener('click', function() {
                goToSection(2);
            });
            
            document.getElementById('prev4').addEventListener('click', function() {
                goToSection(3);
            });
            
            document.getElementById('prev5').addEventListener('click', function() {
                goToSection(4);
            });
            
            // Validación en tiempo real
            document.getElementById('identidad').addEventListener('input', function() {
                const regex = /^\d{4}-\d{4}-\d{5}$/;
                validateField(this, regex, 'identidad-error');
            });
            
            document.getElementById('telefono').addEventListener('input', function() {
                const regex = /^\d{4}-\d{4}$/;
                validateField(this, regex, 'telefono-error');
            });
            
            document.getElementById('email').addEventListener('input', function() {
                const regex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
                validateField(this, regex, 'email-error');
                validateEmailMatch();
            });
            
            document.getElementById('email-confirm').addEventListener('input', validateEmailMatch);
            
            // Verificar cambios en los campos
            form.addEventListener('input', function() {
                if (currentSection === totalSections) {
                    const allComplete = checkFormCompletion();
                    document.getElementById('completeMessage').style.display = allComplete ? 'block' : 'none';
                }
            });
            
            // Validar checkbox de declaración
            document.getElementById('declaracion').addEventListener('change', function() {
                if (currentSection === totalSections) {
                    checkFormCompletion();
                }
            });
            
            // Manejar envío del formulario
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validar todo el formulario antes de enviar
                if (checkFormCompletion()) {
                    showLoading();
                    
                    // Simular envío de datos (en un caso real sería una petición AJAX)
                    setTimeout(function() {
                        hideLoading();
                        
                        // Aquí iría el código para manejar la respuesta del servidor
                        alert('¡Formulario enviado con éxito!');
                        
                        // Redireccionar o mostrar mensaje de éxito
                        // window.location.href = 'gracias.html';
                    }, 3000); // Simulamos un retraso de 3 segundos
                } else {
                    alert('Por favor complete todos los campos requeridos antes de enviar.');
                }
            });

            // Función para validar campos con regex
            function validateField(field, regex, errorId) {
                const errorElement = document.getElementById(errorId);
                
                if (regex.test(field.value)) {
                    field.classList.add('valid');
                    field.classList.remove('invalid');
                    errorElement.style.display = 'none';
                } else {
                    field.classList.add('invalid');
                    field.classList.remove('valid');
                    errorElement.style.display = 'block';
                }
            }

            // Función para validar que los emails coincidan
            function validateEmailMatch() {
                const email = document.getElementById('email');
                const emailConfirm = document.getElementById('email-confirm');
                const errorElement = document.getElementById('email-confirm-error');
                
                if (email.value === emailConfirm.value && email.value !== '') {
                    emailConfirm.classList.add('valid');
                    emailConfirm.classList.remove('invalid');
                    errorElement.style.display = 'none';
                } else {
                    emailConfirm.classList.add('invalid');
                    emailConfirm.classList.remove('valid');
                    errorElement.style.display = 'block';
                }
            }

            // Hacer funciones accesibles globalmente
            window.showFiles = showFiles;
            window.removeFile = removeFile;
            window.validateFiles = validateFiles;
        }