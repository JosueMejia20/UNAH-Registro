// -------- Controlador del Chat --------
import {
} from '../../components/Biblioteca/biblioteca_Controller.mjs';


const idDocente = sessionStorage.getItem('idDocente') || '1002';

// Funcion para cargar los recursos del docente
const cargarMisRecursos = async (idDocente) => {
    const misRecursos = await cargarRecursosDocente(idDocente);
    //const misRecursos = document.querySelectorAll('.recurso-card[data-propietario="true"]');
    const gridMisRecursos = document.getElementById('gridMisRecursos');
    const noMisRecursos = document.getElementById('noMisRecursos');
            
    if (misRecursos.length > 0) {
        gridMisRecursos.innerHTML = '';
        misRecursos.forEach(recurso => {
        `
            <div id="colRecurso" class="col">
                <div class="card h-100 shadow-sm recurso-card" data-cursos="1, 3" data-busqueda="introducción a la programación john doe programación, algoritmos, python" data-categoria="libro">
                    <div class="portada-container" onclick="verRecurso(1)">
                        <img src="https://m.media-amazon.com/images/I/61K5jyMB5VL._AC_UF1000,1000_QL80_.jpg" alt="Portada de Introducción a la Programación" class="img-fluid portada-img">
                        <div class="position-absolute top-0 end-0 p-2 d-flex gap-1">
                            <button class="btn btn-warning btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;" data-bs-toggle="modal" data-bs-target="#editarRecursoModal" onclick="cargarDatosEdicion(1)">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;" onclick="confirmarEliminacion(1)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <span class="badge text-bg-info mb-2">Libro</span>
                        <h5 class="card-title">Introducción a la Programación</h5>
                        <p class="card-text small text-muted">John Doe, María Pérez, Carlos López</p>
                        <p class="small text-muted"><i class="bi bi-calendar me-1"></i>2022</p>
                                
                        <p class="card-text small text-truncate">Este libro ofrece una introducción completa a los fundamentos de la programación, desde conceptos básicos hasta estructuras de datos simples. Ideal para estudiantes de primer año.</p>
                                
                            <div class="border-top pt-2 mt-2">
                                <div class="mb-2">
                                    <span class="badge badge-tag me-1">programación</span>
                                    <span class="badge badge-tag me-1">algoritmos</span>
                                    <span class="badge badge-tag me-1">Python</span>
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
                });
                noMisRecursos.style.display = 'none';
            } else {
                gridMisRecursos.innerHTML = '';
                noMisRecursos.style.display = 'block';
            }
        }