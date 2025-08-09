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

import {
    obtenerInfoDocente,
    obtenerFotoDocente
} from '../../../../components/Docentes/perfilDocentes_Controller.mjs';

import {
    obtenerNumeroEmpleado
} from '../../../../components/Docentes/numeroEmpleado_Controller.mjs';

const idDocente = await obtenerNumeroEmpleado(usuarioId);

const cargarDatosDocente = async () => {
    const datos = await obtenerInfoDocente(idDocente);
    const foto = await obtenerFotoDocente(idDocente);


    const nombreDocente = document.getElementById('nombreDocente');

    nombreDocente.innerHTML = `${datos[0].nombre_completo}`;
}

const cargarAsignaturaDocente = async () => {
    const datos = await obtenerInfoAsignatura(idDocente);
    console.log(datos)
    const tablaAsignaturas = document.getElementById("tablaAsignaturas")
    tablaAsignaturas.innerHTML = ""
    datos.forEach(asignatura => {

        const fila = document.createElement("tr");

        const botonSubirNotas = document.createElement("button");
        botonSubirNotas.textContent = "Subir Notas";
        botonSubirNotas.classList.add("action-btn");
        botonSubirNotas.addEventListener("click", () => {
            window.location.href = `subir_notas.php?idSeccion=${asignatura.id}`;
        });

        const botonVerNotas = document.createElement("button");
        botonVerNotas.textContent = "Ver Notas";
        botonVerNotas.classList.add("action-btn");
        botonVerNotas.addEventListener("click", () => {
            window.location.href = `ver_notas.php?idSeccion=${asignatura.id}`;
        });

        fila.innerHTML = `
        <td>${asignatura.codigo_clase}</td>
        <td>${asignatura.nombre_clase}</td>
        <td>${asignatura.codigo_seccion}</td>
        <td></td>
        <td></td>
`;
        fila.children[3].appendChild(botonSubirNotas);
        fila.children[4].appendChild(botonVerNotas);
        tablaAsignaturas.appendChild(fila);
    })
}

window.onload = function () {
    cargarDatosDocente();
    cargarAsignaturaDocente();
}
