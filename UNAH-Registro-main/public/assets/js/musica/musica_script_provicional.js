// Menú desplegable del usuario
        const userMenuButton = document.getElementById('userMenuButton');
        const userMenu = document.getElementById('userMenu');

        userMenuButton.addEventListener('click', (e) => {
            e.stopPropagation();
            userMenu.classList.toggle('show');
        });

        // Cerrar menú al hacer clic fuera
        document.addEventListener('click', () => {
            userMenu.classList.remove('show');
        });

        // Evitar que el menú se cierre al hacer clic en él
        userMenu.addEventListener('click', (e) => {
            e.stopPropagation();
        });

        // Activar modales
        document.querySelectorAll('.view-pdf').forEach(btn => {
            btn.addEventListener('click', () => {
                const pdfModal = new bootstrap.Modal(document.getElementById('pdfViewerModal'));
                pdfModal.show();
                document.querySelector('#pdfViewerModal iframe').src = 'about:blank';
            });
        });

        document.querySelectorAll('.view-audio').forEach(btn => {
            btn.addEventListener('click', () => {
                const audioModal = new bootstrap.Modal(document.getElementById('audioViewerModal'));
                audioModal.show();
                document.querySelector('#audioViewerModal audio source').src = 'about:blank';
                document.querySelector('#audioViewerModal audio').load();
            });
        });

        // Filtrar recursos al hacer clic en tags
        document.querySelectorAll('.filter-tag').forEach(tag => {
            tag.addEventListener('click', () => {
                document.querySelector('.filter-tag.active').classList.remove('active');
                tag.classList.add('active');
            });
        });

        // Pausar audio al cerrar modal
        document.getElementById('audioViewerModal').addEventListener('hidden.bs.modal', function () {
            document.querySelector('#audioViewerModal audio').pause();
        });