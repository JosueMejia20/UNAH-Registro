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
  mostrarMateriasEnTabla,
  actualizarPerfil,
  obtenerFotoPerfilEstudiante
} from '../../components/Estudiantes/perfil_Controller.mjs';

// -------- Controlador de MATRÍCULA --------
import {
  obtenerDepartamentosPorClases,
  obtenerAsignaturasPorDepartamento,
  obtenerHorariosPorAsignatura,
  matricularSeccion,
  obtenerSeccionesActuales,
  cancelarSecciones
} from '../../components/Estudiantes/matricula_Controller.mjs';

let perfilGlobal = null;

function obtenerMatriculaDesdeSesion() {
  return sessionStorage.getItem('matricula') || '20201003849';
}

const asignarImagenBase64 = (imgTag, base64String, mime = 'image/jpeg') => {
      imgTag.src = base64String
        ? `data:${mime};base64,${base64String}`
        : 'https://via.placeholder.com/300x400?text=Sin+Documento';
    };

document.addEventListener('DOMContentLoaded', async () => {
  const ruta = window.location.pathname;

  //Se le puede agregar lo mismo que matricula. Un metodo aparte y que lo mande a llamar para iniciarlizar la vista
  if (ruta.includes('perfil.php')) {
    const matriculaEstudiante = sessionStorage.getItem('matricula') || '20201003849';
    const perfilGlobal = await obtenerPerfilEstudiante(matriculaEstudiante);
    const fotoPerfil = await obtenerFotoPerfilEstudiante(matriculaEstudiante) || null;
    console.log(fotoPerfil);
    const imgTagFotoPerfil = document.getElementById("fotoDePerfil");

    if (perfilGlobal) {
      mostrarPerfilEnVista(perfilGlobal);
      if(fotoPerfil != null){
          asignarImagenBase64(imgTagFotoPerfil, fotoPerfil[0]["foto_perfil"]);
      } else{
        imgTagFotoPerfil.src = '';
      }
      const materias = await obtenerMateriasActuales(matriculaEstudiante);
     // console.log(fotoPerfil[0]["foto_perfil"]);
      mostrarMateriasEnTabla(materias);
    }

    const btnEditar = document.getElementById('btn-editar-perfil');
    const form = document.getElementById('formEditarPerfil');
    btnEditar?.addEventListener('click', () => {
      cargarFormularioEdicion(perfilGlobal);
      const modal = new bootstrap.Modal(document.getElementById('modalEditarPerfil'));
      modal.show();
    });

    const toBase64 = file => new Promise((resolve, reject) => {
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = () => resolve(reader.result);
      reader.onerror = reject;
    });

    


    form?.addEventListener('submit', async (e) => {
      e.preventDefault();
      const formData = new FormData(form);
      const datosJSON = {};

      //Comentado porque ya se inserta la foto cuando se hace newFormData. Descongelar cuando sea necesario
      //const archivo = document.getElementById('foto_perfil')?.files[0];
      //if (archivo) formData.append('foto_perfil', archivo);

      formData.append('matricula', matriculaEstudiante);

      console.log(formData);


    for (const [key, value] of formData.entries()) {
      if (value instanceof File && value.name) {
        datosJSON[key] = await toBase64(value);
      } else {
        datosJSON[key] = value;
      }
    }

    console.log(datosJSON);

      try {
        const response = await actualizarPerfil(datosJSON);
        //const resultado = await response.json();

        if (response.success) {
          alert('Perfil actualizado correctamente');
          const nuevoPerfil = await obtenerPerfilEstudiante(matriculaEstudiante);
          mostrarPerfilEnVista(nuevoPerfil);
          bootstrap.Modal.getInstance(document.getElementById('modalEditarPerfil'))?.hide();
          location.reload();
        } else {
          alert('Error al actualizar perfil');
        }
      } catch (error) {
        alert('Error de conexión al actualizar perfil.');
      }
    });
  }

  if (ruta.includes('matricula.php')) {
    inicializarVistaMatricula(); // Declarada abajo
  }

  // De acuerdo se agreguen mas metodos para las demas vistas. Se deben agregar mas if en esta parte de aca
});


// ==========================
// FUNCIÓN - VISTA MATRÍCULA
// ==========================
 const inicializarVistaMatricula = async () => {
  const selectClasificacion = document.querySelector('#departamentosClases');
  console.log(selectClasificacion);
  
  const selectAsignatura = document.querySelector("#clasesDepartamentos");
  console.log(selectAsignatura);

  const selectHorario = document.querySelector("#horarios");
  console.log(selectHorario);

  const btnMatricular = document.querySelector("#matricula button.btn-unah");
  const tablaHorario = document.querySelector("#matricula table tbody");
  const tablaCancelacion = document.querySelector("#cancelacion table tbody");
  const btnCancelar = document.querySelector("#cancelacion button.btn-danger");
  const checkboxSelectAll = document.querySelector("#selectAllCancel");

  const idEstudiante = localStorage.getItem('matricula') || '20201003849';

  const limpiarSelect = (select) => {
    if (!select) return;
    while (select.options.length > 1) {
      select.remove(1);
    }
  };

  const llenarSelect = (select, items, textKey, valueKey) => {
  if (!select) return;
  items.forEach(item => {
    const option = document.createElement("option");
    option.textContent = item[textKey];
    option.value = item[valueKey];
    select.appendChild(option);
  });
};

const llenarSelectHorarios = (select, items, textKeyCodigo, textKeyDias, textKeyHoraIni, textKeyHoraFin, valueKey) => {
  if (!select) return;
  items.forEach(item => {
    const option = document.createElement("option");
    option.textContent = `${item[textKeyCodigo]} - ${item[textKeyDias]} ${item[textKeyHoraIni]}-${item[textKeyHoraFin]}`;
    option.value = item[valueKey];
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

  if (idEstudiante) {
  const departamentos = await obtenerDepartamentosPorClases('20201003849');
  console.log(departamentos);
  limpiarSelect(selectClasificacion);
  llenarSelect(selectClasificacion, departamentos, "nombre_departamento", "departamento_id");
}

  // Eventos
  selectClasificacion?.addEventListener("change", async () => {
    limpiarSelect(selectAsignatura);
    limpiarSelect(selectHorario);
    const clasificacion = selectClasificacion.value;

    if (clasificacion !== "Selecciona una clasificación") {
      const asignaturas = await obtenerAsignaturasPorDepartamento('20201003849',clasificacion);
      llenarSelect(selectAsignatura, asignaturas, "nombre_clase", "clase_id");
    }
  });

  selectAsignatura?.addEventListener("change", async () => {
    limpiarSelect(selectHorario);
    const asignatura = selectAsignatura.value;

    if (asignatura !== "Selecciona una asignatura") {
      const horarios = await obtenerHorariosPorAsignatura(asignatura);
     // llenarSelect(selectHorario, horarios, "descripcion");
      llenarSelectHorarios(selectHorario, horarios, "codigo_seccion", "dias", "hora_inicio", "hora_fin", "seccion_id")
    }
  });

  btnMatricular?.addEventListener("click", async () => {
    const estudiante = '20201003849'; //SE DEBE HACER LOGICA PARA OBTENERLO DE SESION
    const horario = selectHorario.value;

    if (!horario || horario.includes("Selecciona")) {
      alert("Debe seleccionar una seccion");
      return;
    }

    const datos = { estudiante, horario };
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

  mostrarSeccionesCancelables();
};
/*
document.addEventListener('DOMContentLoaded', () => {
  inicializarVistaMatricula();
});*/