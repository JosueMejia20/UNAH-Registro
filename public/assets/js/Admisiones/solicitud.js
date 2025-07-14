// Variable para controlar si hay cambios pendientes
        let cambiosPendientes = false;
        let camposEditables = [];

        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show loading spinner
            document.getElementById('loadingSpinner').style.display = 'block';
            document.getElementById('resultCard').style.display = 'none';
            document.getElementById('notFoundAlert').style.display = 'none';
            
            // Simulate API call (replace with actual AJAX call)
            setTimeout(function() {
                document.getElementById('loadingSpinner').style.display = 'none';
                
                // For demo purposes, we'll randomly show either the result or not found message
                if (Math.random() > 0.3) {
                    document.getElementById('resultCard').style.display = 'block';
                    
                    // Update status badge randomly for demo
                    const statuses = ['pending', 'approved', 'rejected'];
                    const randomStatus = statuses[Math.floor(Math.random() * statuses.length)];
                    
                    const statusBadge = document.getElementById('statusBadge');
                    statusBadge.className = `status-badge status-${randomStatus}`;
                    
                    if (randomStatus === 'pending') {
                        statusBadge.textContent = 'En Revisión';
                    } else if (randomStatus === 'approved') {
                        statusBadge.textContent = 'Aprobada';
                    } else {
                        statusBadge.textContent = 'Rechazada';
                    }
                    
                    // Reset editable fields
                    resetEditableFields();
                } else {
                    document.getElementById('notFoundAlert').style.display = 'block';
                }
            }, 1500);
        });
        
        // Enable editing for a field
        function enableEdit(fieldId, type = 'text') {
            const field = document.getElementById(fieldId);
            
            if (field.contentEditable === 'true') {
                field.contentEditable = 'false';
                field.classList.remove('editing');
                return;
            }
            
            field.contentEditable = 'true';
            field.classList.add('editing');
            field.focus();
            
            // If it's a select field, replace with actual select element
            if (type === 'select') {
                const currentValue = field.textContent;
                let options = '';
                
                if (fieldId === 'genero') {
                    options = `
                        <option value="Masculino" ${currentValue === 'Masculino' ? 'selected' : ''}>Masculino</option>
                        <option value="Femenino" ${currentValue === 'Femenino' ? 'selected' : ''}>Femenino</option>
                        <option value="Otro" ${currentValue === 'Otro' ? 'selected' : ''}>Otro</option>
                    `;
                } else if (fieldId === 'centroRegional') {
                    options = `
                        <option value="CU Tegucigalpa" ${currentValue === 'CU Tegucigalpa' ? 'selected' : ''}>CU Tegucigalpa</option>
                        <option value="CU SPS" ${currentValue === 'CU SPS' ? 'selected' : ''}>CU San Pedro Sula</option>
                        <option value="UNAH-VS" ${currentValue === 'UNAH-VS' ? 'selected' : ''}>UNAH Valle de Sula</option>
                        <option value="CU TEC" ${currentValue === 'CU TEC' ? 'selected' : ''}>CU Danlí</option>
                    `;
                } else if (fieldId === 'carreraInteres') {
                    options = `
                        <option value="Medicina" ${currentValue === 'Medicina' ? 'selected' : ''}>Medicina</option>
                        <option value="Derecho" ${currentValue === 'Derecho' ? 'selected' : ''}>Derecho</option>
                        <option value="Ingeniería Civil" ${currentValue === 'Ingeniería Civil' ? 'selected' : ''}>Ingeniería Civil</option>
                        <option value="Administración de Empresas" ${currentValue === 'Administración de Empresas' ? 'selected' : ''}>Administración de Empresas</option>
                    `;
                }
                
                const selectHtml = `<select class="form-select">${options}</select>`;
                field.innerHTML = selectHtml;
                field.querySelector('select').focus();
            }
            
            // Add to editable fields array if not already there
            if (!camposEditables.includes(fieldId)) {
                camposEditables.push(fieldId);
            }
            
            cambiosPendientes = true;
        }
        
        // Reset all editable fields to non-editable state
        function resetEditableFields() {
            camposEditables.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                field.contentEditable = 'false';
                field.classList.remove('editing');
            });
            
            camposEditables = [];
            cambiosPendientes = false;
        }
        
        // Update button functionality
        document.getElementById('updateBtn').addEventListener('click', function() {
            if (!cambiosPendientes) {
                alert('No hay cambios pendientes para guardar.');
                return;
            }
            
            // Show loading on button
            const btn = this;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando...';
            btn.disabled = true;
            
            // Hide any previous messages
            document.getElementById('updateSuccess').style.display = 'none';
            document.getElementById('updateError').style.display = 'none';
            
            // Simulate API call to save changes
            setTimeout(function() {
                // For demo purposes, we'll randomly show success or error
                if (Math.random() > 0.2) {
                    document.getElementById('updateSuccess').style.display = 'block';
                    
                    // Reset editable fields after successful update
                    resetEditableFields();
                } else {
                    document.getElementById('updateError').style.display = 'block';
                }
                
                // Reset button
                btn.innerHTML = '<i class="bi bi-send-check"></i> Enviar Actualización';
                btn.disabled = false;
            }, 2000);
        });