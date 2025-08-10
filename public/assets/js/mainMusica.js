// -------- Controlador del Chat / Recursos Biblioteca --------
import {
    cargarTipoRecurso,
    subirRecurso,
    cargarClasesDocente,
    cargarRecursos,
    recursoDetalle,
    recursoPortadaArchivo,
    editarRecurso,
    eliminarRecurso,
    validarCredenciales,
    obtenerIdEstudiante,
    obtenerIdDocente,
    cargarRecursosEstudiante,
    filtroCursoEstudiantes,
    filtroCursoDocente,
    getSugerencias,
    obtenerNombreUsuario
} from '../../../components/Biblioteca/biblioteca_Controller.mjs';

import {
    subirRecursoMusica
} from '../../../components/Musica/musica_Controller.mjs'

import { UnahModal } from '../../components/modal.mjs';
customElements.define("unah-modal", UnahModal);

// Referencias globales
const modal = document.querySelector('unah-modal');
const overlayCarga = document.getElementById('overlayCarga');

let idDocente = null;
let idEstudiante = null;

// Asignar IDs según rol
if (rol === 1) {
    idEstudiante = await obtenerIdEstudiante(usuarioId);
}
if (rol === 2 || rol === 3) {
    idDocente = await obtenerIdDocente(usuarioId);
}

// ------------------- Función para separar tags -------------------
function separarTags(cadena) {
    if (!cadena) return [];
    return cadena
        .split(',')
        .map(tag => tag.trim())
        .filter(tag => tag.length > 0);
}

// ------------------ Funcion para el nombre de usuario --------------------
const cargarNombreUsuario = async (id) => {
    const datos = await obtenerNombreUsuario(id);

    const nombreUsuario = document.getElementById('nombreUsuario');

    const nombreCompleto = datos[0].nombre_completo + ' ' + datos[0].apellido_completo;

    nombreUsuario.textContent = nombreCompleto;

}

// ------------------- Subir recurso -------------------
const btnSubirRecurso = document.getElementById('modalSubir');
if (rol == 1 || rol == 2) {
    btnSubirRecurso.style = "display: none";
}
const formSubirRecurso = document.getElementById('formSubirRecurso');

btnSubirRecurso?.addEventListener('click', () => {
    const modalBootstrap = new bootstrap.Modal(document.getElementById('subirRecursoModal'));
    modalBootstrap.show();
    cargarTipoRecurso();
    cargarClasesDocente(idDocente);
});

const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = reject;
});

formSubirRecurso?.addEventListener('submit', async (e) => {
    e.preventDefault();
    overlayCarga.style.display = 'flex';

    const formData = new FormData(formSubirRecurso);
    const datosJSON = {};
    const datosJSONArchivo = {};
    formData.append('idDocente', idDocente);

    // console.log(formData);

    for (const [key, value] of formData.entries()) {
        if (value instanceof File && value.name) {
            datosJSONArchivo[key] = await toBase64(value);
        } else {
            datosJSON[key] = (key === 'autores' || key === 'tags') ? separarTags(value) : value;
        }
    }

    console.log(datosJSON);
    console.log(datosJSONArchivo);

    try {
        const response = await subirRecursoMusica(datosJSON, datosJSONArchivo);
        overlayCarga.style.display = 'none';

        if (response.success) {
            // Cerrar modal antes de notificación
            const subirRecursoModal = bootstrap.Modal.getInstance(document.getElementById('subirRecursoModal'));
            subirRecursoModal?.hide();

            modal.show('Recurso subido correctamente.', () => {
                location.reload();
            });
        } else {
            modal.show('Error al subir el recurso.');
        }
    } catch (error) {
        overlayCarga.style.display = 'none';
        modal.show('Error de conexión al subir el recurso.');
    }
});

// ------------------- Confirmar eliminación de recurso -------------------
const confirmarEliminacion = async (id) => {
    // Mostramos el modal de confirmación usando nuestro Web Component
    const modalEl = document.querySelector('unah-modal');

    modalEl.confirm(
        "¿Estás seguro de que quieres eliminar este recurso?",
        async () => {
            overlayCarga.style.display = 'flex';

            const respuesta = await eliminarRecurso(id);

            overlayCarga.style.display = 'none';

            if (respuesta.success) {
                modalEl.show("Recurso eliminado correctamente.", () => location.reload());
            } else {
                modalEl.show(respuesta.mensaje || "No se pudo eliminar.");
            }
        }
    );
};

// ------------------- Cargar recursos (Docente/Estudiante) -------------------
const cargarRecursosDetalle = async () => {
    const misRecursos = await cargarRecursos(idDocente);
    const gridMisRecursos = document.getElementById('gridRecursos');

    if (!misRecursos) return;
    if (misRecursos.length > 0) {
        gridMisRecursos.innerHTML = '';
        misRecursos.forEach(recurso => {

            const nombresClases = recurso.clases_asociadas
                ? recurso.clases_asociadas
                    .split(',')
                    .map(c => c.trim().replace(/^[A-Z0-9]+\s*-\s*/, ''))
                    .join(', ')
                : '';

            const tagsArray = separarTags(recurso.tags);
            const tagsHTML = tagsArray.map(tag => `<span class="badge badge-tag me-1">${tag}</span>`).join('');

            let botonesEliminarModificar = '';
            if (rol == 3) {
                botonesEliminarModificar = `
                 <div class="position-absolute top-0 end-0 p-2 d-flex gap-1">
                     <button class="btn btn-warning btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center editar-btn" style="width: 30px; height: 30px;" data-id-editar="${recurso.id}">
                         <i class="bi bi-pencil"></i>
                     </button>
                     <button class="btn btn-danger btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center eliminar-btn" style="width: 30px; height: 30px;" data-id-eliminar="${recurso.id}">
                         <i class="bi bi-trash"></i>
                     </button>
                 </div>`;
            }

            const html = `
                <!-- PDF Resource -->
            <div class="col-md-6 col-lg-4">
                <div class="resource-card card h-100 shadow-sm animate-fadeInUp data-cursos="${nombresClases}" data-busqueda="${recurso.titulo}, ${recurso.tags}" data-categoria="${recurso.tipo_recurso}">
                    <div class="thumbnail-pdf card-img-top d-flex align-items-center justify-content-center" style="height: 160px;">
                        <i class="bi bi-file-earmark-pdf fs-1"></i>
                        ${botonesEliminarModificar}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-unah-blue">${recurso.titulo}</h5>
                        <p class="card-text text-muted small">${recurso.autores}</p>
                        <p class="small text-muted"><i class="bi bi-calendar me-1"></i>${recurso.anio}</p>
                        <p class="card-text small text-truncate">${recurso.descripcion}</p>
                        <div class="border-top pt-2 mt-2">
                            <div class="mb-2">${tagsHTML}</div>
                            <button class="btn btn-outline-unah-blue btn-sm w-100 ver-recurso" data-id="${recurso.id}">
                                <i class="bi bi-eye me-1"></i> Ver documento
                            </button>
                        </div>
                    </div>
                </div>
            </div>
`;
            gridMisRecursos.innerHTML += html;
        });

        // Listeners
        document.querySelectorAll('.ver-recurso').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                verRecurso(id);
            });
        });
        document.querySelectorAll('.eliminar-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id-eliminar');
                confirmarEliminacion(id);
            });
        });
        document.querySelectorAll('.editar-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id-editar');
                cargarDatosEdicion(id);
            });
        });

    } else {
        gridMisRecursos.innerHTML = '';
    }
};


const cargarRecursosDetalleEstudiante = async () => {
    const misRecursos = await cargarRecursosEstudiante(idEstudiante);
    const gridMisRecursos = document.getElementById('gridRecursos');

    if (!misRecursos) return;
    if (misRecursos.length > 0) {
        gridMisRecursos.innerHTML = '';
        misRecursos.forEach(recurso => {

            // Aquí sí puedes acceder a recurso.clases_asociadas
            const nombresClasesES = recurso.clases_asociadas
                ? recurso.clases_asociadas
                    .split(',')
                    .map(c => c.trim().replace(/^[A-Z0-9]+\s*-\s*/, ''))
                    .join(', ')
                : '';

            const tagsArray = separarTags(recurso.tags);
            const tagsHTML = tagsArray.map(tag => `<span class="badge badge-tag me-1">${tag}</span>`).join('');
            let botonesEliminarModificar = '';
            if (rol == 3) {
                botonesEliminarModificar = `
                 <div class="position-absolute top-0 end-0 p-2 d-flex gap-1">
                     <button class="btn btn-warning btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center editar-btn" style="width: 30px; height: 30px;" data-id-editar="${recurso.id}">
                         <i class="bi bi-pencil"></i>
                     </button>
                     <button class="btn btn-danger btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center eliminar-btn" style="width: 30px; height: 30px;" data-id-eliminar="${recurso.id}">
                         <i class="bi bi-trash"></i>
                     </button>
                 </div>`;
            }
            const html = `
                <!-- PDF Resource -->
            <div class="col-md-6 col-lg-4">
                <div class="resource-card card h-100 shadow-sm animate-fadeInUp data-cursos="${nombresClases}" data-busqueda="${recurso.titulo}, ${recurso.tags}" data-categoria="${recurso.tipo_recurso}">
                    <div class="thumbnail-pdf card-img-top d-flex align-items-center justify-content-center" style="height: 160px;">
                        <i class="bi bi-file-earmark-pdf fs-1"></i>
                        ${botonesEliminarModificar}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-unah-blue">${recurso.titulo}</h5>
                        <p class="card-text text-muted small">${recurso.autores}</p>
                        <p class="small text-muted"><i class="bi bi-calendar me-1"></i>${recurso.anio}</p>
                        <p class="card-text small text-truncate">${recurso.descripcion}</p>
                        <div class="border-top pt-2 mt-2">
                            <div class="mb-2">${tagsHTML}</div>
                            <button class="btn btn-outline-unah-blue btn-sm w-100 ver-recurso" data-id="${recurso.id}">
                                <i class="bi bi-eye me-1"></i> Ver documento
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Audio Resource -->
            <div class="col-md-6 col-lg-4">
                <div class="resource-card card h-100 shadow-sm animate-fadeInUp">
                    <div class="thumbnail-audio card-img-top d-flex align-items-center justify-content-center" style="height: 160px;">
                        <i class="bi bi-music-note-beamed fs-1"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-unah-blue">Concierto para violín No. 1</h5>
                        <p class="card-text text-muted small">Ludwig van Beethoven</p>
                        <div class="d-flex flex-wrap gap-1 mb-3">
                            <span class="badge bg-secondary">clásica</span>
                            <span class="badge bg-secondary">violín</span>
                            <span class="badge bg-secondary">orquesta</span>
                        </div>
                        <div class="d-flex justify-content-between pt-2 border-top">
                            <button class="btn btn-sm btn-outline-primary view-audio">
                                <i class="bi bi-play"></i> Escuchar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Score Resource -->
            <div class="col-md-6 col-lg-4">
                <div class="resource-card card h-100 shadow-sm animate-fadeInUp">
                    <div class="thumbnail-score card-img-top d-flex align-items-center justify-content-center" style="height: 160px;">
                        <i class="bi bi-file-earmark-music fs-1"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-unah-blue">Sonata Claro de Luna</h5>
                        <p class="card-text text-muted small">Ludwig van Beethoven</p>
                        <div class="d-flex flex-wrap gap-1 mb-3">
                            <span class="badge bg-secondary">piano</span>
                            <span class="badge bg-secondary">clásica</span>
                            <span class="badge bg-secondary">partitura</span>
                        </div>
                        <div class="d-flex justify-content-between pt-2 border-top">
                            <button class="btn btn-sm btn-outline-success download">
                                <i class="bi bi-download"></i> Descargar
                            </button>
                        </div>
                    </div>
                </div>
            </div>`;
            gridMisRecursos.innerHTML += html;
        });

        document.querySelectorAll('.ver-recurso').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                verRecurso(id);
            });
        });
    } else {
        gridMisRecursos.innerHTML = '';
    }
};

// ------------------- Ver recurso -------------------
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.8.162/pdf.worker.min.js';

let pdfDoc = null;
let currentPage = 1;
const scale = 1.5;
const canvas = document.getElementById('pdfCanvas');
const ctx = canvas.getContext('2d');

async function renderPage(num) {
  const page = await pdfDoc.getPage(num);
  const viewport = page.getViewport({ scale });
  canvas.height = viewport.height;
  canvas.width = viewport.width;

  const renderContext = {
    canvasContext: ctx,
    viewport: viewport,
  };

  await page.render(renderContext).promise;

  // Actualizar número de página en UI
  document.getElementById('pageNum').textContent = num;
}

async function loadPDF(base64PDF) {
  // Convertir base64 a Uint8Array
  const raw = atob(base64PDF);
  const uint8Array = new Uint8Array(raw.length);
  for (let i = 0; i < raw.length; i++) {
    uint8Array[i] = raw.charCodeAt(i);
  }

  pdfDoc = await pdfjsLib.getDocument({ data: uint8Array }).promise;
  currentPage = 1;
  document.getElementById('pageCount').textContent = pdfDoc.numPages;

  await renderPage(currentPage);
  // Subir al principio al cargar el PDF
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

document.getElementById('btnPrev').addEventListener('click', async () => {
  if (currentPage <= 1) return;
  currentPage--;
  await renderPage(currentPage);
  // Subir al principio al cambiar de página
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

document.getElementById('btnNext').addEventListener('click', async () => {
  if (currentPage >= pdfDoc.numPages) return;
  currentPage++;
  await renderPage(currentPage);
  // Subir al principio al cambiar de página
  window.scrollTo({ top: 0, behavior: 'smooth' });
});


const verRecurso = async (id) => {
    const recurso = await recursoDetalle(id);
    console.log(recurso);
    if (recurso[0].tipo_recurso == 'Audio') {
        document.getElementById('visorAudioModalTitle').textContent = recurso[0].titulo;
        const audioSource = document.getElementById('audioViewer');
        const audioElement = document.getElementById('elementAudio'); // <audio>
        // Validar que el base64 no este vacio
        if (!recurso[0].archivo || recurso[0].archivo.trim() === '') {
            console.error('NO hay archivo de audio');
            return;
        }
        audioSource.src = `data:audio/mp3;base64,${recurso[0].archivo}`;
        audioElement.load();
    } else if (recurso[0].tipo_recurso == 'Pdf') {
        const recursopdf = await recursoDetalle(id);
        document.getElementById('visorPdfModalTitle').textContent = recurso[0].titulo;
        document.getElementById('pdfMetadata').textContent = `Autores: ${recurso[0].autores}`;

        await loadPDF(recurso[0].archivo);

        const modalBootstrap = new bootstrap.Modal(document.getElementById('visorPdfModal'));
        modalBootstrap.show();
    } else if (recurso[0].tipo_recurso == 'Partitura') {

    } else {
        return;
    }
    /*
    document.getElementById('visorPdfModalTitle').textContent = recurso[0].titulo;
    document.getElementById('pdfMetadata').textContent = `Autores: ${recurso[0].autores}`;
    document.getElementById('pdfViewer').src = `data:application/pdf;base64,${recurso[0].archivo}#toolbar=0&navpanes=0`;
    document.getElementById('pdfViewer').setAttribute('sandbox', 'allow-scripts allow-same-origin');
    document.getElementById('pdfViewer').setAttribute('disable-download', "");
*/

    let modalRecurso;



    switch (recurso[0].tipo_recurso) {
        case 'Audio':
            modalRecurso = document.getElementById('audioViewerModal');
            break;
        case 'Pdf':
            modalRecurso = document.getElementById('pdfViewerModal');
            break;
        //case 'Partitura':

    }

    const modalBootstrap = new bootstrap.Modal(modalRecurso);
    modalBootstrap.show();
};

// ------------------- Editar recurso -------------------
const editarFormulario = async (form, id) => {
    form?.addEventListener('submit', async (e) => {
        e.preventDefault();
        overlayCarga.style.display = 'flex';

        const formData = new FormData(form);
        const datosJSON = {};
        formData.append('idDocente', idDocente);

        const portadaArchivo = await recursoPortadaArchivo(id);
        const portada = formData.get('edit_portada');
        const archivo = formData.get('edit_archivo');

        if (portada.size === 0) {
            formData.set('edit_portada', portadaArchivo[0].portada);
        }
        if (archivo.size === 0) {
            formData.set('edit_archivo', portadaArchivo[0].archivo);
        }

        for (const [key, value] of formData.entries()) {
            if (value instanceof File && value.name) {
                datosJSON[key] = await toBase64(value);
            } else {
                datosJSON[key] = (key == 'edit_autores' || key == 'edit_tags') ? separarTags(value) : value;
            }
        }

        try {
            const response = await editarRecurso(datosJSON);
            overlayCarga.style.display = 'none';

            if (response.success) {
                // Cerrar modal antes de notificación
                const editarRecursoModal = bootstrap.Modal.getInstance(document.getElementById('editarRecursoModal'));
                editarRecursoModal?.hide();

                modal.show('Recurso actualizado correctamente.', () => {
                    location.reload();
                });
            } else {
                modal.show('Error al actualizar recurso.');
            }
        } catch (error) {
            overlayCarga.style.display = 'none';
            modal.show('Error de conexión al actualizar recurso.');
        }
    });
};

const cargarDatosEdicion = async (id) => {
    const formEditarRecurso = document.getElementById('formEditarRecurso');
    const modalBootstrap = new bootstrap.Modal(document.getElementById('editarRecursoModal'));
    modalBootstrap.show();
    cargarTipoRecurso();
    cargarClasesDocente(idDocente);

    const recurso = await recursoDetalle(id);

    document.getElementById('edit_titulo').value = recurso[0].titulo;
    document.getElementById('edit_autores').value = recurso[0].autores;
    document.getElementById('edit_anio').value = recurso[0].anio;
    document.getElementById('edit_categoria').value = recurso[0].tipo_recurso_id;
    document.getElementById('edit_descripcion').value = recurso[0].descripcion;
    document.getElementById('edit_tags').value = recurso[0].tags;
    document.getElementById('recurso_id').value = id;
    document.getElementById('edit_cursos').value = recurso[0].cursos_relacionados_ids;

    editarFormulario(formEditarRecurso, id);
};

// ------------------- Autocompletado -------------------

function llenarDatalist(id, valores) {
    const datalist = document.getElementById(id);
    console.log(datalist);
    datalist.innerHTML = '';
    valores.forEach(valor => {
        if (valor) {
            console.log(valor);
            const option = document.createElement('option');
            if (id === 'listaAutores') {
                option.value = valor.nombre_completo;
            } else {
                option.value = valor.titulo;
            }

            datalist.appendChild(option);
        }
    });
}

// ------------------- Cargar filtro de cursos -------------------
const cargarFiltroCursos = async () => {
    const selectFiltro = document.getElementById('cursos');
    if (!selectFiltro) return;

    // Limpiar y agregar la opción por defecto
    selectFiltro.innerHTML = `<option value="">Todos los cursos</option>`;

    let clases = [];

    if (rol === 1 && idEstudiante) {
        clases = await filtroCursoEstudiantes(idEstudiante); 
    } else if ((rol === 2 || rol === 3) && idDocente) {
        clases = await filtroCursoDocente(idDocente); 

    console.log('Clases cargadas para filtro:', clases);

    clases?.forEach(clase => {
        const option = document.createElement('option');
        option.value = clase.nombre_clase; 
        option.textContent = clase.nombre_clase;
        selectFiltro.appendChild(option);
    });
};


// ------------------- Filtrar recursos -------------------
function filtrarRecursos() {
    const filtroCurso = document.getElementById('filtroCurso')?.value.trim() || '';
    const filtroCategoria = document.getElementById('filtroCategoria')?.value.toLowerCase() || '';
    const busqueda = document.getElementById('busquedaRecursos')?.value.toLowerCase() || '';

    const recursos = document.querySelectorAll('#gridRecursos .recurso-card');
    let resultadosEncontrados = false;

    recursos.forEach(recurso => {
        const cursosData = recurso.getAttribute('data-cursos') || '';
        // separar los nombres de las clases y limpiar espacios
        const cursos = cursosData.split(',').map(c => c.trim());

        const categoria = recurso.getAttribute('data-categoria')?.toLowerCase() || '';
        const textoBusqueda = recurso.getAttribute('data-busqueda')?.toLowerCase() || '';

        // Si filtroCurso está vacío (""), mostramos todo; si no, chequeamos si incluye la clase filtrada
        const coincideCurso = filtroCurso === '' || cursos.includes(filtroCurso);

        const coincideCategoria = filtroCategoria === '' || categoria === filtroCategoria;
        const coincideBusqueda = busqueda === '' || textoBusqueda.includes(busqueda);

        if (coincideCurso && coincideCategoria && coincideBusqueda) {
            recurso.closest('#colRecurso').style.display = '';
            resultadosEncontrados = true;
        } else {
            recurso.closest('#colRecurso').style.display = 'none';
        }
    });

    const noResultados = document.getElementById('noResultados');
    if (noResultados) {
        noResultados.classList.toggle('d-none', resultadosEncontrados);
    }
}








// ------------------- Inicialización -------------------
window.onload = async function () {
    try {
        cargarNombreUsuario(usuarioId);
        if (rol == 2 || rol == 3) {
            await cargarRecursosDetalle();
            await cargarFiltroCursos();
            // Autores
            const autores = await getSugerencias('autores');
            llenarDatalist('listaAutores', autores);

            // Títulos
            const titulos = await getSugerencias('titulos');
            llenarDatalist('listaTitulos', titulos);
        } else {
            await cargarRecursosDetalleEstudiante();
            await cargarFiltroCursos();
        }

        //PDF
        document.addEventListener('contextmenu', e => e.preventDefault());
        document.addEventListener('keydown', function (e) {
            // Ctrl+P (imprimir), Ctrl+S (guardar), Ctrl+U (ver código fuente)
            if ((e.ctrlKey || e.metaKey) && ['p', 's', 'u'].includes(e.key.toLowerCase())) {
                e.preventDefault();
                modal.show('Esta acción está deshabilitada.');
            }
        });

        // Cambiar formatos de archivo según tipo de recurso
        document.getElementById('categoria').addEventListener('change', function () {
            const fileInput = document.getElementById('archivo_recurso');
            const formatosInfo = document.getElementById('formatosAceptados');

            switch (this.value) {
                case 'pdf':
                    fileInput.accept = '.pdf';
                    formatosInfo.textContent = 'Formatos aceptados: PDF';
                    break;
                case 'audio':
                    fileInput.accept = '.mp3';
                    formatosInfo.textContent = 'Formatos aceptados: MP3';
                    break;
                case 'partitura':
                    fileInput.accept = '.pdf,.mus,.mxl,.musicxml,.sib';
                    formatosInfo.textContent = 'Formatos aceptados: PDF, .mus, .mxl, .musicxml, .sib';
                    break;
                default:
                    fileInput.accept = '';
                    formatosInfo.textContent = 'Seleccione un tipo de recurso para ver formatos aceptados';
            }
        });



        // Listeners de filtro
        document.getElementById('filtroCurso')?.addEventListener('change', filtrarRecursos);
        document.getElementById('filtroCategoria')?.addEventListener('input', filtrarRecursos);
        document.getElementById('busquedaRecursos')?.addEventListener('input', filtrarRecursos);
    } catch (error) {
        console.error("Error fatal:", error);
    }
};
