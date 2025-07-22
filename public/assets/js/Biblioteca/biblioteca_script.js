 
 // -------- Controlador del Chat --------
import {
    cargarRecursosDocente
} from '../../../components/Biblioteca/biblioteca_Controller.mjs';


const idDocente = sessionStorage.getItem('idDocente') || '1002';
 
 function separarTags(cadena) {
  if (!cadena) return [];

  return cadena
    .split(',')
    .map(tag => tag.trim())
    .filter(tag => tag.length > 0);
}

// Función para confirmar eliminación de recurso
window.confirmarEliminacion = function(id){
    document.getElementById('confirmarEliminarBtn').onclick = function() {
        // Aquí iría la lógica para eliminar el recurso
        console.log(`Recurso ${id} eliminado`);
                
        // Cerrar el modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('confirmarEliminarModal'));
        modal.hide();
                
        // Recargar la lista de recursos
        cargarMisRecursos(idDocente);
    };
            
    // Mostrar el modal de confirmación
    const modal = new bootstrap.Modal(document.getElementById('confirmarEliminarModal'));
    modal.show();
}

 
 
 // Función para filtrar recursos
        function filtrarRecursos() {
            const filtroCurso = document.getElementById('filtroCurso').value.toLowerCase();
            const filtroCategoria = document.getElementById('filtroCategoria').value.toLowerCase();
            const busqueda = document.getElementById('busquedaRecursos').value.toLowerCase();
            
            const recursos = document.querySelectorAll('#gridRecursos .recurso-card');
            let resultadosEncontrados = false;
            
            recursos.forEach(recurso => {
                const cursos = recurso.getAttribute('data-cursos');
                const categoria = recurso.getAttribute('data-categoria');
                const textoBusqueda = recurso.getAttribute('data-busqueda');
                
                const coincideCurso = filtroCurso === '' || cursos.includes(filtroCurso);
                const coincideCategoria = filtroCategoria === '' || categoria === filtroCategoria;
                const coincideBusqueda = busqueda === '' || textoBusqueda.includes(busqueda);
                
                if (coincideCurso && coincideCategoria && coincideBusqueda) {
                    recurso.style.display = '';
                    resultadosEncontrados = true;
                } else {
                    recurso.style.display = 'none';
                }
            });
            
            // Mostrar mensaje si no hay resultados
            const noResultados = document.getElementById('noResultados');
            if (resultadosEncontrados) {
                noResultados.classList.add('d-none');
            } else {
                noResultados.classList.remove('d-none');
            }
        }
        
        // Función para cargar los recursos del docente
        const cargarMisRecursos = async (idDocente) => {
            const misRecursos = await cargarRecursosDocente(idDocente);
            //const misRecursos = document.querySelectorAll('.recurso-card[data-propietario="true"]');
            const gridMisRecursos = document.getElementById('gridMisRecursos');
            const noMisRecursos = document.getElementById('noMisRecursos');
            
            console.log(misRecursos);

            if (!misRecursos) return;
            if (misRecursos.length > 0) {
                gridMisRecursos.innerHTML = '';
                misRecursos.forEach(recurso => {
                    //tagsString = recurso.tags;
                    const tagsArray = separarTags(recurso.tags);
                    console.log(tagsArray);

                    const tagsHTML = tagsArray.map(tag => `<span class="badge badge-tag me-1">${tag}</span>`).join('');

                   const html =  `
                    <div id="colRecurso" class="col">
                        <div class="card h-100 shadow-sm recurso-card" data-cursos="1, 3" data-busqueda="${recurso.titulo}, ${recurso.tags}" data-categoria="libro">
                            <div class="portada-container">
                                <img src="https://m.media-amazon.com/images/I/61K5jyMB5VL._AC_UF1000,1000_QL80_.jpg">
                                <div class="position-absolute top-0 end-0 p-2 d-flex gap-1">
                                    <button class="btn btn-warning btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;" data-bs-toggle="modal" data-bs-target="#editarRecursoModal" onclick="cargarDatosEdicion(${recurso.recurso_id})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;" onclick="confirmarEliminacion(${recurso.recurso_id})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">${recurso.titulo}</h5>
                                <p class="card-text small text-muted">${recurso.autor}</p>
                                <p class="small text-muted"><i class="bi bi-calendar me-1"></i>${recurso.anio}</p>
                                
                                <p class="card-text small text-truncate">Este libro ofrece una introducción completa a los fundamentos de la programación, desde conceptos básicos hasta estructuras de datos simples. Ideal para estudiantes de primer año.</p>
                                
                                <div class="border-top pt-2 mt-2">
                                    <div class="mb-2">
                                        ${tagsHTML}
                                    </div>
                                    <button class="btn btn-outline-unah-blue btn-sm w-100 ver-recurso" data-id="1">
                                        <i class="bi bi-eye me-1"></i> Ver documento
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                    //const clone = recurso.cloneNode(true);
                    //gridMisRecursos.appendChild(clone);
                    gridMisRecursos.innerHTML += html;
                });
                document.querySelectorAll('.ver-recurso').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    verRecurso(id);
                });
            });
                noMisRecursos.style.display = 'none';
            } else {
                gridMisRecursos.innerHTML = '';
                noMisRecursos.style.display = 'block';
            }
        }
        
        // Función para ver un recurso
        function verRecurso(id) {
            // Aquí iría la lógica para obtener los datos del recurso
            // Por ahora usamos datos de ejemplo
            const recursos = {
                1: {
                    titulo: "Introducción a la Programación",
                    autores: "John Doe, María Pérez, Carlos López",
                    url: "https://example.com/documento1.pdf"
                },
                2: {
                    titulo: "Historia del Arte Moderno: Del Renacimiento al Siglo XXI",
                    autores: "Prof. Carlos Méndez, Robert Johnson",
                    url: "https://example.com/documento2.pdf"
                },
                3: {
                    titulo: "Álgebra Lineal: Teoría y Práctica",
                    autores: "Equipo Matemáticas, Dr. Luis González",
                    url: "https://example.com/documento3.pdf"
                },
                4: {
                    titulo: "Diseño Web Moderno: Principios y Técnicas",
                    autores: "Prof. Carlos Méndez, Sofía Ramírez",
                    url: "https://example.com/documento4.pdf"
                }
            };
            
            const recurso = recursos[id];
            document.getElementById('visorPdfModalTitle').textContent = recurso.titulo;
            document.getElementById('pdfMetadata').textContent = `Autores: ${recurso.autores}`;
            document.getElementById('pdfViewer').src = recurso.url;
            
            // Mostrar el modal
            const modal = new bootstrap.Modal(document.getElementById('visorPdfModal'));
            modal.show();
        }
        
        // Función para cargar datos en el formulario de edición
        function cargarDatosEdicion(id) {
            // Aquí iría la lógica para obtener los datos del recurso a editar
            // Por ahora usamos datos de ejemplo
            const recursos = {
                1: {
                    titulo: "Introducción a la Programación",
                    autores: "John Doe, María Pérez, Carlos López",
                    anio: "2022",
                    categoria: "libro",
                    descripcion: "Este libro ofrece una introducción completa a los fundamentos de la programación, desde conceptos básicos hasta estructuras de datos simples. Ideal para estudiantes de primer año.",
                    tags: "programación, algoritmos, Python, básico",
                    cursos: ["1", "3"]
                },
                2: {
                    titulo: "Historia del Arte Moderno: Del Renacimiento al Siglo XXI",
                    autores: "Prof. Carlos Méndez, Robert Johnson",
                    anio: "2023",
                    categoria: "articulo",
                    descripcion: "Análisis comparativo de los movimientos artísticos desde el Renacimiento hasta el arte contemporáneo, con énfasis en la evolución de las técnicas y su contexto histórico.",
                    tags: "arte, renacimiento, cultura, historia",
                    cursos: ["2", "4"]
                },
                3: {
                    titulo: "Álgebra Lineal: Teoría y Práctica",
                    autores: "Equipo Matemáticas, Dr. Luis González",
                    anio: "2021",
                    categoria: "libro",
                    descripcion: "Manual completo de álgebra lineal con enfoque teórico-práctico, incluye ejercicios resueltos y aplicaciones en diversas áreas de la ingeniería.",
                    tags: "matemáticas, álgebra, ecuaciones, vectores",
                    cursos: ["1", "2"]
                },
                4: {
                    titulo: "Diseño Web Moderno: Principios y Técnicas",
                    autores: "Prof. Carlos Méndez, Sofía Ramírez",
                    anio: "2023",
                    categoria: "guia",
                    descripcion: "Guía práctica actualizada con las últimas técnicas de diseño web responsive, accesibilidad y mejores prácticas de UI/UX para el desarrollo frontend moderno.",
                    tags: "web, diseño, frontend, UI/UX",
                    cursos: ["3", "4"]
                }
            };
            
            const recurso = recursos[id];
            document.getElementById('edit_titulo').value = recurso.titulo;
            document.getElementById('edit_autores').value = recurso.autores;
            document.getElementById('edit_anio').value = recurso.anio;
            document.getElementById('edit_categoria').value = recurso.categoria;
            document.getElementById('edit_descripcion').value = recurso.descripcion;
            document.getElementById('edit_tags').value = recurso.tags;
            document.getElementById('recurso_id').value = id;
            
            // Limpiar selecciones previas
            const selectCursos = document.getElementById('edit_cursos');
            for (let i = 0; i < selectCursos.options.length; i++) {
                selectCursos.options[i].selected = recurso.cursos.includes(selectCursos.options[i].value);
            }
        }
        
        
        
        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Cargar los recursos del docente al inicio
            cargarMisRecursos(idDocente);
            
            // Configurar eventos de filtrado
            document.getElementById('filtroCurso').addEventListener('change', filtrarRecursos);
            document.getElementById('filtroCategoria').addEventListener('change', filtrarRecursos);
            document.getElementById('btnBuscar').addEventListener('click', filtrarRecursos);
            document.getElementById('busquedaRecursos').addEventListener('keyup', function(e) {
                if (e.key === 'Enter') filtrarRecursos();
            });
            
            // Configurar eventos para ver recursos
            document.querySelectorAll('.ver-recurso').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    verRecurso(id);
                });
            });
            
            // Configurar formulario para subir recurso
            document.getElementById('formSubirRecurso').addEventListener('submit', function(e) {
                e.preventDefault();
                // Aquí iría la lógica para subir el recurso
                alert('Recurso subido exitosamente');
                
                // Cerrar el modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('subirRecursoModal'));
                modal.hide();
                
                // Recargar la lista de recursos
                cargarMisRecursos(idDocente);
            });
            
            // Configurar formulario para editar recurso
            document.getElementById('formEditarRecurso').addEventListener('submit', function(e) {
                e.preventDefault();
                // Aquí iría la lógica para guardar los cambios
                alert('Cambios guardados exitosamente');
                
                // Cerrar el modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('editarRecursoModal'));
                modal.hide();
                
                // Recargar la lista de recursos
                cargarMisRecursos(idDocente);
            });
        });