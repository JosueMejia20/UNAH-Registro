import { UnahModal } from '../../components/modal.mjs';
customElements.define("unah-modal", UnahModal);

// Referencias globales
const modal = document.querySelector('unah-modal');
const overlayCarga = document.getElementById('overlayCarga');

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
        clases = await filtroCursoEstudiantes(idEstudiante); // Devuelve nombre_clase
    } else if ((rol === 2 || rol === 3) && idDocente) {
        clases = await filtroCursoDocente(idDocente); // Devuelve nombre_clase
    }

    console.log('Clases cargadas para filtro:', clases);

    // Agregar las clases como opciones (usamos nombre_clase como value)
    clases?.forEach(clase => {
        const option = document.createElement('option');
        option.value = clase.nombre_clase; // Usamos nombre de la clase como valor
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


        // Listeners de filtro
        document.getElementById('filtroCurso')?.addEventListener('change', filtrarRecursos);
        document.getElementById('filtroCategoria')?.addEventListener('input', filtrarRecursos);
        document.getElementById('busquedaRecursos')?.addEventListener('input', filtrarRecursos);
    } catch (error) {
        console.error("Error fatal:", error);
    }
};
