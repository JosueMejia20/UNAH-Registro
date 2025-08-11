// ==========================
// IMPORTACIÓN DE COMPONENTES Y CONTROLADORES
// ==========================
import { UnahNavbar } from "../../../components/navbar.mjs";
customElements.define("unah-navbar", UnahNavbar);

import { Cargando, loadingEvent } from "../../../components/loading.mjs";
customElements.define("pantalla-de-carga", Cargando);
loadingEvent();

import { UnahFooter } from "../../../components/footer.mjs";
customElements.define("unah-footer", UnahFooter);

import { UnahSidebar } from "../../../components/sidebar.mjs";
customElements.define("unah-sidebar", UnahSidebar);

// -------- Controlador del Chat --------
import {
    cargarDocentesSeccionesMatriculadas,
    cargarInfoDocente,
    cargarAsignaturasDocente
} from '../../../components/Estudiantes/perfilDocentes_Controller.mjs';

import {
    cargarIntroduccionClase,
    cargarPdfIntroduccion
} from '../../../components/Estudiantes/verClases_Controller.mjs';

// INICIALIZACION DE VARIABLES Y FUNCIONES
//let perfilGlobal = null;

const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = reject;
});

function obtenerMatriculaDesdeSesion() {
    return sessionStorage.getItem('matricula') || '20201003849';
}
const matriculaEstudiante = sessionStorage.getItem('matricula') || '20201003849';

const mostrarClases = async (idEstudiante, listaClases) => {
    const clases = await cargarDocentesSeccionesMatriculadas(idEstudiante);
    console.log(clases);
    if (!listaClases) return;
    //console.log(contactos);
    listaClases.innerHTML = "";
    clases.forEach(clase => {
        const item = document.createElement("a");
        item.href = "#";
        item.className = "list-group-item list-group-item-action";
        //const fila = document.createElement("tr");
        item.innerHTML = `
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">${clase.nombre_clase} - ${clase.codigo_seccion}</h6>
                    <small>${clase.docente_nombre_completo}</small>
                </div>
                <span class="badge bg-white text-dark ms-auto"></span>
            </div>
      `;

        item.addEventListener("click", () => {
            mostrarIntroduccionClase(clase.seccion_id);
            //contactoSeleccionadoId = contacto.contacto_id;
            //console.log(contactoSeleccionadoId);
        });


        listaClases.appendChild(item);
    });
};

const mostrarIntroduccionClase = async (idSeccion) => {
    //Mostrar informacion personal
    const tituloNombreClase = document.querySelector('#tituloNombreClase');
    const seccionClase = document.querySelector('#seccionClase');
    const pDepartamentoClase = document.querySelector('#pDepartamentoClase');

    const nombreDocente = document.querySelector('#nombreDocente');
    const pCorreoInstitucionalDocente = document.querySelector('#pCorreoInstitucionalDocente');

    const videoIntroduccion = document.querySelector('#videoIntroduccion');
    const btnDescargarPDF = document.querySelector('#btnDescargarPDF');


    const infoSeccion = await cargarIntroduccionClase(idSeccion);
    const pdfIntroduccion = await cargarPdfIntroduccion(idSeccion);

    console.log(pdfIntroduccion);

    const defaultUrl = 'https://www.youtube.com/embed/wsSWzs3Xxh0';

    const urlVideo = infoSeccion[0].video || defaultUrl;

    const videoIdMatch = urlVideo.match(/(?:\?v=|\/embed\/|\.be\/)([a-zA-Z0-9_-]{11})/);

    console.log(videoIdMatch)


    tituloNombreClase.textContent = infoSeccion[0].nombre_clase;
    seccionClase.textContent = infoSeccion[0].codigo_seccion;
    pDepartamentoClase.innerHTML = `<i class="fas fa-building me-2"></i>${infoSeccion[0].nombre_departamento}`;
    nombreDocente.textContent = infoSeccion[0].nombre_docente;
    pCorreoInstitucionalDocente.innerHTML = `<i class="fas fa-envelope me-2"></i>${infoSeccion[0].correo_institucional}`;

    videoIntroduccion.src = videoIdMatch ? `https://www.youtube.com/embed/${videoIdMatch[1]}` : defaultUrl;

    // -------- Logica para el pdf --------
    if (pdfIntroduccion && pdfIntroduccion.archivo_pdf) {
        btnDescargarPDF.disabled = false;
        btnDescargarPDF.onclick = () => {
            const link = document.createElement('a');
            link.href = `data:application/pdf;base64,${pdfIntroduccion.archivo_pdf}`;
            link.download = `${infoSeccion[0]?.nombre_clase || 'Introduccion'}_material.pdf`;
            link.click();
        };
        console.log('PDF disponible para descarga');
    } else {
        btnDescargarPDF.disabled = true;
        btnDescargarPDF.onclick = null;
        console.log('No hay PDF disponible');
    }

};



/**
 * Inicializacion de la vista
 */
document.addEventListener('DOMContentLoaded', async () => {
    const docenteSeccionMatriculada = document.querySelector("#docenteSeccionMatriculada");

    mostrarClases(matriculaEstudiante, docenteSeccionMatriculada);
});