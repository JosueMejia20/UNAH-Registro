document.addEventListener('DOMContentLoaded', function() {
            // Variables de estado
            let pendingApplications = 12;
            const pendingCountElement = document.getElementById('pendingCount');
            
            // Manejar los checkboxes de validación (solo uno seleccionable por campo)
            document.querySelectorAll('.field-validation').forEach(container => {
                const checkboxes = container.querySelectorAll('input[type="checkbox"]');
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        if (this.checked) {
                            // Desmarcar el otro checkbox del mismo grupo
                            const groupName = this.name;
                            checkboxes.forEach(cb => {
                                if (cb !== this && cb.name === groupName) {
                                    cb.checked = false;
                                }
                            });
                        }
                    });
                });
            });
            
            // Función para cargar la siguiente solicitud
            function loadNextApplication() {
                if (pendingApplications > 0) {
                    pendingApplications--;
                    pendingCountElement.textContent = pendingApplications;
                    
                    // Aquí iría la lógica para cargar los datos de la siguiente solicitud
                    // Por ahora simulamos el comportamiento
                    alert('Solicitud procesada. Cargando siguiente solicitud...');
                    
                    // Si no hay más solicitudes, mostrar mensaje
                    if (pendingApplications === 0) {
                        alert('¡Felicidades! Has revisado todas las solicitudes pendientes.');
                    }
                }
            }
            
            // Manejar los botones de aprobar/rechazar
            document.getElementById('acceptBtn').addEventListener('click', function() {
                // Validar que al menos todos los campos tengan una selección
                const allValidated = Array.from(document.querySelectorAll('.field-validation')).every(container => {
                    return container.querySelector('input[type="checkbox"]:checked') !== null;
                });
                
                if (!allValidated) {
                    alert('Por favor, valide todos los campos antes de aprobar la solicitud.');
                    return;
                }
                
                // Aquí iría la lógica para aprobar la solicitud
                alert('Solicitud aprobada correctamente.');
                loadNextApplication();
            });
            
            document.getElementById('rejectBtn').addEventListener('click', function() {
                // Validar que al menos un campo esté marcado como incorrecto
                const hasIncorrectFields = Array.from(document.querySelectorAll('.field-validation')).some(container => {
                    return container.querySelector('input[value="incorrecto"]:checked') !== null;
                });
                
                if (!hasIncorrectFields) {
                    alert('Por favor, marque al menos un campo como incorrecto para rechazar la solicitud.');
                    return;
                }
                
                // Aquí iría la lógica para rechazar la solicitud
                alert('Solicitud rechazada correctamente.');
                loadNextApplication();
            });
        });