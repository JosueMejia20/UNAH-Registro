function verRecurso(id) {
        // En una implementación real, esto obtendría los datos del recurso desde el backend
        const card = $(`.ver-recurso[data-id="${id}"]`).closest('.recurso-card');
        const titulo = card.find('.card-title').text();
        const autores = card.find('.card-autores').text();
        
        $('#visorPdfModalTitle').text(titulo);
        $('#pdfMetadata').text('Autores: ' + autores);
        
        // Simulación de URL de PDF (en un caso real sería la URL del servidor)
        $('#pdfViewer').attr('src', 'https://example.com/sample.pdf');
        
        $('#visorPdfModal').modal('show');
    }

    $(document).ready(function() {
        // Filtrado de recursos
        $('#filtroCurso, #busquedaRecursos').on('change keyup', function() {
            const cursoSeleccionado = $('#filtroCurso').val();
            const terminoBusqueda = $('#busquedaRecursos').val().toLowerCase();
            
            let resultados = 0;
            
            $('.recurso-card').each(function() {
                const cursosRecurso = $(this).data('cursos').split(', ');
                const textoBusqueda = $(this).data('busqueda');
                
                const cumpleCurso = !cursoSeleccionado || cursosRecurso.includes(cursoSeleccionado);
                const cumpleBusqueda = !terminoBusqueda || textoBusqueda.includes(terminoBusqueda);
                
                if (cumpleCurso && cumpleBusqueda) {
                    $(this).parent().show();
                    resultados++;
                } else {
                    $(this).parent().hide();
                }
            });
            
            $('#noResultados').toggle(resultados === 0);
        });
        
        // Visualización de PDF al hacer click en botón Ver
        $('.ver-recurso').click(function(e) {
            e.stopPropagation(); // Evita que se active el click de la tarjeta
            verRecurso($(this).data('id'));
        });
        
        // Evitar que el iframe permita descargas
        $('#visorPdfModal').on('hide.bs.modal', function() {
            $('#pdfViewer').attr('src', '');
        });

        // Manejo del formulario de subida
        $('#formSubirRecurso').on('submit', function(e) {
            e.preventDefault();
            alert('Recurso subido correctamente (simulación)');
            $('#subirRecursoModal').modal('hide');
            this.reset();
        });
    });