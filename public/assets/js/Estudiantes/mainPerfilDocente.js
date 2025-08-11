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
  obtenerIdEstudiante
} from '../../../components/Biblioteca/biblioteca_Controller.mjs';

// INICIALIZACION DE VARIABLES Y FUNCIONES
//let perfilGlobal = null;


const matriculaEstudiante = await obtenerIdEstudiante(usuarioId);

const mostrarDocentes = async (idEstudiante, listaDocentes) => {
  const docentes = await cargarDocentesSeccionesMatriculadas(idEstudiante);
  console.log(docentes);
  if (!listaDocentes) return;
  //console.log(contactos);
  listaDocentes.innerHTML = "";
  docentes.forEach(docente => {
    const item = document.createElement("a");
    item.href = "#";
    item.className = "list-group-item list-group-item-action";
    //const fila = document.createElement("tr");
    item.innerHTML = `
            <div class="d-flex align-items-center">
                <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="...">
                <div>
                    <h6 class="mb-0">${docente.docente_nombre_completo}</h6>
                    <small>${docente.nombre_clase} - ${docente.codigo_seccion}</small>
                </div>
                <span class="badge bg-white text-dark ms-auto"></span>
            </div>
      `;

    item.addEventListener("click", () => {
      mostrarInfoDocente(docente.numero_empleado_docente);
      //contactoSeleccionadoId = contacto.contacto_id;
      //console.log(contactoSeleccionadoId);
    });


    listaDocentes.appendChild(item);
  });
};

const mostrarInfoDocente = async (idDocente) => {
  //Mostrar informacion personal
  const tituloNombreDocente = document.querySelector("#tituloNombreDocente");
  const pDepartamentoDocente = document.querySelector("#pDepartamentoDocente");
  const pCorreoInstitucionalDocente = document.querySelector("#pCorreoInstitucionalDocente");

  const infoDocente = await cargarInfoDocente(idDocente);

  tituloNombreDocente.textContent = infoDocente[0].nombre_completo;
  pDepartamentoDocente.textContent = `Profesor del ${infoDocente[0].nombre_departamento}`;
  pCorreoInstitucionalDocente.textContent = infoDocente[0].correo_institucional;

  //Mostrar la tabla de asignaturas
  const asignaturas = await cargarAsignaturasDocente(idDocente);

  mostrarAsignaturasEnTabla(asignaturas);
};

const mostrarAsignaturasEnTabla = (materias) => {
  const tbody = document.querySelector('#tablaAsignaturasDocente');
  tbody.innerHTML = '';
  materias.forEach(materia => {
    const fila = document.createElement('tr');
    fila.innerHTML = `
      <td>${materia.codigo_clase}</td>
      <td>${materia.nombre_clase}</td>
      <td>${materia.codigo_seccion}</td>
    `;
    tbody.appendChild(fila);
  });
};


/**
 * Inicializacion de la vista
 */
/*
document.addEventListener('DOMContentLoaded', async () => {
  const docenteSeccionMatriculada = document.querySelector("#docenteSeccionMatriculada");

  mostrarDocentes(matriculaEstudiante, docenteSeccionMatriculada);
});*/

window.onload = async function () {

  const docenteSeccionMatriculada = document.querySelector("#docenteSeccionMatriculada");

  mostrarDocentes(matriculaEstudiante, docenteSeccionMatriculada);
}