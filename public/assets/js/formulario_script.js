 // Variables globales
        let currentSection = 1;
        const totalSections = 5;
        const form = document.getElementById('admissionForm');
        const loadingOverlay = document.getElementById('loadingOverlay');
        const initialLoading = document.getElementById('initialLoading');
        const contentContainer = document.getElementById('contentContainer');
        const initialProgressBar = document.getElementById('initialProgressBar');
        
        // Mostrar pantalla de carga inicial
        document.addEventListener('DOMContentLoaded', function() {
            // Simular carga de recursos
            simulateInitialLoading();
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
                    document.getElementById('completeMessage').style.display = allSectionsComplete ? 'block' : 'none';
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

            // Configurar navegación
            document.getElementById('next1').addEventListener('click', function() {
                if (validateCurrentSection()) {
                    goToSection(2);
                }
            });
            
            document.getElementById('next2').addEventListener('click', function() {
                if (validateCurrentSection()) {
                    goToSection(3);
                }
            });
            
            document.getElementById('next3').addEventListener('click', function() {
                if (validateCurrentSection()) {
                    goToSection(4);
                }
            });
            
            document.getElementById('next4').addEventListener('click', function() {
                if (validateCurrentSection()) {
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
        }