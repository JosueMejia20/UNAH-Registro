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

// -------- Controlador del PERFIL --------
import {
    obtenerMateriasActuales
} from '../../../components/Estudiantes/perfil_Controller.mjs';

// -------- Controlador de EVALUACION DOCENTE --------
import {
    subirEvaluacion
} from '../../../components/Estudiantes/evaluacionDocente_Controller.mjs';

// -------- Controlador de MATRÍCULA --------
import {
    obtenerDepartamentosPorClases,
    obtenerAsignaturasPorDepartamento,
    obtenerHorariosPorAsignatura,
    matricularSeccion,
    obtenerSeccionesActuales,
    cancelarSecciones,
    obtenerClasesEstudiante
} from '../../../components/Estudiantes/matricula_Controller.mjs';



const matriculaEstudiante = sessionStorage.getItem('matricula') || '20201003849';
const listaClases = document.getElementById('listaClases');



const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = reject;
});

window.abrirModalEvaluacion = async function (asignatura, docente, idSeccion) {
    document.getElementById('eval-asignatura').textContent = asignatura;
    document.getElementById('eval-docente').textContent = docente;

    const modal = new bootstrap.Modal(document.getElementById('modalEvaluacion'));
    modal.show();


    console.log(idSeccion);

    document.getElementById("form-evaluacion").addEventListener("submit", async function (e) {
        e.preventDefault();

        const form = document.getElementById("form-evaluacion");

        const formData = new FormData(form);
        const datosJSON = { jsonEvaluacion: {} };

        formData.append('idEstudiante', matriculaEstudiante);
        formData.append('idSeccion', idSeccion);

        const archivoPDF = formData.get('archivo_pdf');

        if (archivoPDF.size === 0) {
            formData.set('archivo_pdf', null);
        }

        console.log(formData);

        for (const [key, value] of formData.entries()) {
            if (value instanceof File && value.name) {
                datosJSON[key] = await toBase64(value);
            } else {
                if (key.match(/^preg/)?.[0]) {
                    const numeroPregunta = key.replace(/^preg/, '');
                    datosJSON.jsonEvaluacion[`preg${numeroPregunta}`] = parseInt(value);
                } else {
                    datosJSON[key] = value;
                }

            }
        }

        console.log(datosJSON);

        try {
            const response = await subirEvaluacion(datosJSON);
            //const resultado = await response.json();

            if (response.success) {
                alert("¡Gracias por completar la evaluación!");
                //const nuevoPerfil = await obtenerPerfilEstudiante(matriculaEstudiante);
                //mostrarPerfilEnVista(nuevoPerfil);
                bootstrap.Modal.getInstance(document.getElementById('modalEvaluacion'))?.hide();
                this.reset();
                location.reload();
            } else {
                alert('Error al actualizar perfil');
            }
        } catch (error) {
            alert('Error de conexión al actualizar perfil.');
        }

    });

}

const mostrarClasesEnDiv = async (idEstudiante) => {
    const materiasActuales = await obtenerMateriasActuales(idEstudiante);

    materiasActuales.forEach(materia => {
        const item = document.createElement("div");
        item.className = "list-group-item list-group-action";


        /**
        const estadoTexto = evaluada ? "Completada" : "Pendiente";
        const estadoClase = evaluada ? "text-success" : "text-warning";
         */

        const evaluada = false;
        const estadoTexto = "Pendiente";
        const estadoClase = "text-warning";

        // En los data-set poner el id de la seccion y el id del docente. Lo que esta en evaluaciones docente de la base de datos
        item.innerHTML = `
                <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">${materia.nombre_clase}</h5>
                <small class="${estadoClase}">${estadoTexto}</small>
                </div>
                <p class="mb-1">Prof. ${materia.nombre_docente}</p>
                <small>Período: ${materia.periodo}</small>
                ${evaluada
                ? `<button class="btn btn-sm btn-outline-secondary mt-2">Evaluacion Realizada</button>`
                : `<button class="btn btn-sm btn-unah mt-2 btn-evaluar"
                    onclick="abrirModalEvaluacion('${materia.nombre_clase}', '${materia.nombre_docente}', ${materia.seccion_id})">Realizar Evaluación</button>`}
  `;

        listaClases.appendChild(item);
    });


};



document.addEventListener('DOMContentLoaded', async () => {

    mostrarClasesEnDiv(matriculaEstudiante);


});
