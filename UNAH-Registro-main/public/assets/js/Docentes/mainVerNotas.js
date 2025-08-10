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


// -------- Controlador del Perfil Docentes - Docentes --------
import {
    obtenerEstudiantesNotas
} from '../../../../components/Docentes/verNotas_Controller.mjs';

const params = new URLSearchParams(window.location.search);
const idSeccion = params.get("idSeccion");

const obtenerEstudiantes = async (id) => {
    const datos = await obtenerEstudiantesNotas(id);


    const tablaEstudiantes = document.getElementById("listaEstudiantes")
    tablaEstudiantes.innerHTML = ""

    datos.forEach(estudiante => {

        let estudianteNombreCompleto = '';

        estudianteNombreCompleto = estudiante.nombre_completo + ' ' + estudiante.apellido_completo;

        const fila = document.createElement("tr");

        fila.innerHTML = `
        <td>${estudiante.numero_cuenta}</td>
        <td>${estudianteNombreCompleto}</td>
        <td>${estudiante.nombre_clase}</td>
        <td>${estudiante.nota}</td>
`;
        tablaEstudiantes.appendChild(fila);
    });
}

document.addEventListener("DOMContentLoaded", function () {


    obtenerEstudiantes(idSeccion);

});