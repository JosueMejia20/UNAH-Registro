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
        cargarRecursos(idDocente);
    };
            
    // Mostrar el modal de confirmación
    const modal = new bootstrap.Modal(document.getElementById('confirmarEliminarModal'));
    modal.show();
}

// Función para cargar los recursos del docente
        const cargarRecursos = async (idDocente) => {
            const recursos = await cargarRecursosDocente(idDocente);
            const gridRecursos = document.getElementById('gridRecursos');
            const noMisRecursos = document.getElementById('noMisRecursos');
            
            console.log(misRecursos);

            if (!recursos) return;
            if (recursos.length > 0) {
                gridRecursos.innerHTML = '';
                recursos.forEach(recurso => {
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
                    gridRecursos.innerHTML += html;
                });
                document.querySelectorAll('.ver-recurso').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    verRecurso(id);
                });
            });
                noMisRecursos.style.display = 'none';
            } else {
                gridRecursos.innerHTML = '';
                noMisRecursos.style.display = 'block';
            }
        }

