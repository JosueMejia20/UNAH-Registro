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
    cargarEstudiantesLista
} from '../../../../components/Docentes/listaEstudiantes_Controller.mjs';

const obtenerEstudiantes = async(id) => {
    const datos = await cargarEstudiantesLista(id);

    console.log(datos);

    const tablaEstudiantes = document.getElementById("listaEstudiantes")
    tablaEstudiantes.innerHTML = ""
    datos.forEach(estudiante => {

        const fila = document.createElement("tr");

        fila.innerHTML = `
        <td>${estudiante.numero_cuenta}</td>
        <td>${estudiante.nombre_estudiante}</td>
        <td>${estudiante.carrera}</td>
        <td>${estudiante.correo}</td>
`;
        tablaEstudiantes.appendChild(fila);
    })

};

document.addEventListener("DOMContentLoaded", function () {
    
    const params = new URLSearchParams(window.location.search);

    const id = params.get("idSeccion");

    obtenerEstudiantes(id);

});