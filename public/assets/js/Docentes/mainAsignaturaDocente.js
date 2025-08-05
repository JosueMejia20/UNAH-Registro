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
    obtenerInfoAsignatura
} from '../../../../components/Docentes/asignaturaDocente.mjs';

const idDocente = sessionStorage.getItem('idDocente') || '1002';


const cargarAsignaturaDocente = async () => {
    const datos = await obtenerInfoAsignatura(idDocente);
    console.log(datos)
    const tablaAsignaturas = document.getElementById("tablaAsignaturas")
    tablaAsignaturas.innerHTML = ""
    datos.forEach(asignatura => {

        const fila = document.createElement("tr");

        const botonVer = document.createElement("button");
        botonVer.textContent = "Ver Lista";
        botonVer.classList.add("action-btn");
        botonVer.addEventListener("click", () => {
            window.location.href = `lista_estudiantes.php?idSeccion=${asignatura.id}`;
        });

        fila.innerHTML = `
        <td>${asignatura.codigo_clase}</td>
        <td>${asignatura.nombre_clase}</td>
        <td>${asignatura.departamento_clase}</td>
        <td>${asignatura.codigo_seccion}</td>
        <td></td>
        <td><button class="action-btn">Descargar</button></td>
`;
        fila.children[4].appendChild(botonVer);
        tablaAsignaturas.appendChild(fila);
    })
}

document.addEventListener('DOMContentLoaded', () => {
    cargarAsignaturaDocente()
})