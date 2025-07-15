// ==========================
// IMPORTACIÓN DE COMPONENTES Y CONTROLADORES
// ==========================
import { UnahNavbar } from "/../../components/navbar.mjs";
customElements.define("unah-navbar", UnahNavbar);

import { Cargando, loadingEvent } from "../../components/loading.mjs";
customElements.define("pantalla-de-carga", Cargando);
loadingEvent();

import { UnahFooter } from "/../../components/footer.mjs";
customElements.define("unah-footer", UnahFooter);

import { UnahSidebar } from "/../../components/sidebar.mjs";
customElements.define("unah-sidebar", UnahSidebar);

// -------- Controlador del PERFIL --------
import {
  obtenerPerfilEstudiante,
  mostrarPerfilEnVista,
  cargarFormularioEdicion,
  obtenerMateriasActuales,
  mostrarMateriasEnTabla
} from '../../components/Estudiantes/perfil_Controller.mjs';

// -------- Controlador de MATRÍCULA --------
import {
  obtenerAsignaturasPorClasificacion,
  obtenerHorariosPorAsignatura,
  matricularSeccion,
  obtenerSeccionesActuales,
  cancelarSecciones
} from '../../components/Estudiantes/matricula_Controller.mjs';

// ==========================
// VARIABLES GLOBALES
// ==========================
let perfilGlobal = null;

// ==========================
// FUNCIÓN PARA OBTENER MATRÍCULA DESDE SESIÓN
// ==========================
function obtenerMatriculaDesdeSesion() {
  return sessionStorage.getItem('matricula') || '20201003849';
}

// ==========================
// OBSERVADOR DE VISTAS DINÁMICAS (PERFIL y MATRÍCULA)
// ==========================
document.addEventListener('DOMContentLoaded', async () => {
  const observer = new MutationObserver(async (mutations, obs) => {
    const btnEditar = document.getElementById('btn-editar-perfil');
    const form = document.getElementById('formEditarPerfil');
    const seccionMatricula = document.getElementById('matricula');

    // ----------------------------
    // ==== VISTA DE PERFIL =======
    // ----------------------------
    if (btnEditar && form) {
      obs.disconnect();
      const matriculaEstudiante = obtenerMatriculaDesdeSesion();
      

      // Cargar perfil y materias
      perfilGlobal = await obtenerPerfilEstudiante(matriculaEstudiante);
       if (perfilGlobal) mostrarPerfilEnVista(perfilGlobal);

       const materias = await obtenerMateriasActuales(matriculaEstudiante);
       mostrarMateriasEnTabla(materias);

      // Abrir modal de edición
      btnEditar.addEventListener('click', () => {
        cargarFormularioEdicion(perfilGlobal);
        const modal = new bootstrap.Modal(document.getElementById('modalEditarPerfil'));
        modal.show();
      });

      // Envío del formulario
      form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        const archivo = document.getElementById('foto_perfil').files[0];
        if (archivo) formData.append('foto_perfil', archivo);

        try {
          const response = await fetch('/api/estudiantes/post/updatePerfil', {
            method: 'POST',
            body: formData
          });
          const resultado = await response.json();
          if (resultado.success) {
            alert('Perfil actualizado correctamente');
            perfilGlobal = await obtenerPerfilEstudiante(matriculaEstudiante);
            mostrarPerfilEnVista(perfilGlobal);
            bootstrap.Modal.getInstance(document.getElementById('modalEditarPerfil')).hide();
          } else {
            alert('Error al actualizar perfil');
          }
        } catch (error) {
          console.error('Error al enviar perfil:', error);
          alert('Error de conexión al actualizar perfil.');
        }
      });
    }

    // ----------------------------
    // ==== VISTA DE MATRÍCULA ====
    // ----------------------------
    if (seccionMatricula) {
      inicializarVistaMatricula();
    }
  });

  const contenedor = document.getElementById('main-content');
  observer.observe(contenedor, { childList: true, subtree: true });
});

// ==========================
// FUNCIONES - VISTA MATRÍCULA Y CANCELACIÓN
// ==========================
const inicializarVistaMatricula = () => {
  const selectClasificacion = document.querySelector("#matricula select:nth-child(2)");
  const selectAsignatura = document.querySelector("#matricula select:nth-child(4)");
  const selectHorario = document.querySelector("#matricula select:nth-child(6)");
  const btnMatricular = document.querySelector("#matricula button.btn-unah");
  const tablaHorario = document.querySelector("#matricula table tbody");
  const tablaCancelacion = document.querySelector("#cancelacion table tbody");
  const btnCancelar = document.querySelector("#cancelacion button.btn-danger");
  const checkboxSelectAll = document.querySelector("#selectAllCancel");

  const limpiarSelect = (select) => {
    if (!select) return;
    while (select.options.length > 1) {
      select.remove(1);
    }
  };

  const llenarSelect = (select, items, textKey) => {
    if (!select) return;
    items.forEach(item => {
      const option = document.createElement("option");
      option.textContent = item[textKey];
      option.value = item.id || item[textKey];
      select.appendChild(option);
    });
  };

  const generarHorarioEjemplo = () => {
    if (!tablaHorario) return;
    tablaHorario.innerHTML = `
      <tr>
        <td>10:00 - 11:30</td>
        <td class="bg-light-blue">Matemática II<br>C1-205</td>
        <td></td>
        <td class="bg-light-blue">Matemática II<br>C1-205</td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>13:00 - 14:30</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="bg-light-blue">Inglés Técnico<br>I2-302</td>
      </tr>
    `;
  };

  const mostrarSeccionesCancelables = async () => {
    const secciones = await obtenerSeccionesActuales();
    if (!tablaCancelacion) return;

    tablaCancelacion.innerHTML = "";
    secciones.forEach(seccion => {
      const fila = document.createElement("tr");
      fila.innerHTML = `
        <td><input class="form-check-input" type="checkbox" value="${seccion.id}"></td>
        <td>${seccion.codigo}</td>
        <td>${seccion.asignatura}</td>
        <td>${seccion.seccion}</td>
        <td>${seccion.horario}</td>
        <td>${seccion.docente}</td>
      `;
      tablaCancelacion.appendChild(fila);
    });
  };

  // Eventos
  selectClasificacion?.addEventListener("change", async () => {
    limpiarSelect(selectAsignatura);
    limpiarSelect(selectHorario);
    const clasificacion = selectClasificacion.value;

    if (clasificacion !== "Selecciona una clasificación") {
      const asignaturas = await obtenerAsignaturasPorClasificacion(clasificacion);
      llenarSelect(selectAsignatura, asignaturas, "nombre");
    }
  });

  selectAsignatura?.addEventListener("change", async () => {
    limpiarSelect(selectHorario);
    const asignatura = selectAsignatura.value;

    if (asignatura !== "Selecciona una asignatura") {
      const horarios = await obtenerHorariosPorAsignatura(asignatura);
      llenarSelect(selectHorario, horarios, "descripcion");
    }
  });

  btnMatricular?.addEventListener("click", async () => {
    const asignatura = selectAsignatura.value;
    const horario = selectHorario.value;

    if (!asignatura || !horario || asignatura.includes("Selecciona") || horario.includes("Selecciona")) {
      alert("Debe seleccionar una asignatura y un horario.");
      return;
    }

    const datos = { asignatura, horario };
    const respuesta = await matricularSeccion(datos);

    if (respuesta.success) {
      alert("¡Matrícula realizada con éxito!");
      generarHorarioEjemplo();
      mostrarSeccionesCancelables();
    } else {
      alert(respuesta.mensaje || "No se pudo realizar la matrícula.");
    }
  });

  btnCancelar?.addEventListener("click", async () => {
    const checkboxes = tablaCancelacion.querySelectorAll("input[type='checkbox']:checked");
    const ids = Array.from(checkboxes).map(c => c.value);

    if (ids.length === 0) {
      alert("Selecciona al menos una asignatura para cancelar.");
      return;
    }

    const confirmacion = confirm("¿Estás seguro de cancelar las secciones seleccionadas?");
    if (!confirmacion) return;

    const respuesta = await cancelarSecciones(ids);

    if (respuesta.success) {
      alert("Secciones canceladas correctamente.");
      mostrarSeccionesCancelables();
    } else {
      alert(respuesta.mensaje || "No se pudo cancelar.");
    }
  });

  checkboxSelectAll?.addEventListener("change", (e) => {
    const checkboxes = tablaCancelacion.querySelectorAll("input[type='checkbox']");
    checkboxes.forEach(cb => cb.checked = e.target.checked);
  });

  // Inicializar datos al cargar matrícula
  mostrarSeccionesCancelables();
};



