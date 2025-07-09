  // Simular carga de página
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('loading-screen').classList.add('hidden');
            }, 1500);
        });

        // Funciones para el modal
        let currentAction = '';
        let currentRequestId = '';

        function showConfirmationModal(action, requestId) {
            currentAction = action;
            currentRequestId = requestId;
            
            const modal = document.getElementById('confirmationModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const rejectionReason = document.getElementById('rejectionReason');
            const confirmBtn = document.getElementById('confirmActionBtn');
            
            if (action === 'approve') {
                modalTitle.textContent = 'Confirmar aprobación';
                modalMessage.textContent = `¿Está seguro que desea aprobar la solicitud ${requestId}?`;
                rejectionReason.style.display = 'none';
                confirmBtn.textContent = 'Aprobar';
                confirmBtn.className = 'btn btn-primary btn-approve';
            } else {
                modalTitle.textContent = 'Confirmar rechazo';
                modalMessage.textContent = `¿Está seguro que desea rechazar la solicitud ${requestId}?`;
                rejectionReason.style.display = 'block';
                confirmBtn.textContent = 'Rechazar';
                confirmBtn.className = 'btn btn-primary btn-reject';
            }
            
            modal.style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('confirmationModal').style.display = 'none';
        }

        function confirmAction() {
            if (currentAction === 'reject') {
                const reason = document.getElementById('reasonText').value;
                if (!reason.trim()) {
                    alert('Por favor ingrese la razón del rechazo.');
                    return;
                }
                // Aquí iría la lógica para rechazar la solicitud
                console.log(`Solicitud ${currentRequestId} rechazada. Razón: ${reason}`);
            } else {
                // Aquí iría la lógica para aprobar la solicitud
                console.log(`Solicitud ${currentRequestId} aprobada.`);
            }
            
            closeModal();
            // Aquí podrías actualizar la tabla o mostrar un mensaje de éxito
        }

        // Configurar el botón de confirmación
        document.getElementById('confirmActionBtn').addEventListener('click', confirmAction);