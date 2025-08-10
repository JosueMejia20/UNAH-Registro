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

// -------- MODAL REUTILIZABLE --------
import { UnahModal } from "../../components/modal.mjs";
customElements.define("unah-modal", UnahModal);
const modal = document.querySelector("unah-modal");

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
  cancelarSecciones,
  obtenerClasesEstudiante,
  obtenerDiasMatriculaEstudiante,
  verificarConflictoHorario
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

  if (ruta.includes('perfil.php')) {
    const matriculaEstudiante = sessionStorage.getItem('matricula') || '20201003849';
    const perfilGlobal = await obtenerPerfilEstudiante(matriculaEstudiante);
    const fotoPerfil = await obtenerFotoPerfilEstudiante(matriculaEstudiante) || null;
    const imgTagFotoPerfil = document.getElementById("fotoDePerfil");

    if (perfilGlobal) {
      mostrarPerfilEnVista(perfilGlobal);
      if (fotoPerfil != null) {
        asignarImagenBase64(imgTagFotoPerfil, fotoPerfil[0]["foto_perfil"]);
      } else {
        imgTagFotoPerfil.src = '';
      }
      const materias = await obtenerMateriasActuales(matriculaEstudiante);
      mostrarMateriasEnTabla(materias);
    }

    const btnEditar = document.getElementById('btn-editar-perfil');
    const form = document.getElementById('formEditarPerfil');
    btnEditar?.addEventListener('click', () => {
      cargarFormularioEdicion(perfilGlobal);
      const modalBootstrap = new bootstrap.Modal(document.getElementById('modalEditarPerfil'));
      modalBootstrap.show();
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

      formData.append('matricula', matriculaEstudiante);
      const fotoEstudiante = await obtenerFotoPerfilEstudiante(matriculaEstudiante);
      const foto = formData.get('foto_perfil');

      if (foto.size === 0) {
        formData.set('foto_perfil', fotoEstudiante == null ? null : fotoEstudiante[0].foto_perfil);
      }

      for (const [key, value] of formData.entries()) {
        if (value instanceof File && value.name) {
          datosJSON[key] = await toBase64(value);
        } else {
          datosJSON[key] = value;
        }
      }

      try {
        const response = await actualizarPerfil(datosJSON);

        if (response.success) {
          bootstrap.Modal.getInstance(document.getElementById('modalEditarPerfil'))?.hide();
          modal.show('Perfil actualizado correctamente', () => {
            const nuevoPerfil = obtenerPerfilEstudiante(matriculaEstudiante).then(mostrarPerfilEnVista);
            location.reload();
          });
        } else {
          modal.show('Error al actualizar perfil');
        }
      } catch (error) {
        modal.show('Error de conexión al actualizar perfil.');
      }
    });
  }

  if (ruta.includes('matricula.php')) {
    inicializarVistaMatricula();
  }

  if (ruta.includes('certificado.php')) {
    inicializarVistaCertificado();
  }
});

// ==========================
// FUNCIÓN - VISTA MATRÍCULA
// ==========================
const inicializarVistaMatricula = async () => {
  const matriculaEstudiante = sessionStorage.getItem('matricula') || '20201003849';

  const selectClasificacion = document.querySelector('#departamentosClases');
  const selectAsignatura = document.querySelector("#clasesDepartamentos");
  const selectHorario = document.querySelector("#horarios");
  const btnMatricular = document.querySelector("#matricula button.btn-unah");
  const tablaHorario = document.querySelector("#tableBodyHorarioGenerado");
  const tablaCancelacion = document.querySelector("#tablaCancelacion");
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

  function separarDias(cadena) {
    const dias = [];
    for (let i = 0; i < cadena.length; i += 2) {
      dias.push(cadena.substring(i, i + 2));
    }
    return dias;
  }

  const materiasActuales = await obtenerMateriasActuales(matriculaEstudiante);
  const datosHorario = [];

  materiasActuales.forEach((materia) => {
    const diasSeparados = separarDias(materia.dias);
    diasSeparados.forEach((dia) => {
      datosHorario.push({
        dia: dia,
        hora: materia.horario,
        materia: materia.nombre_clase,
        aula: `${materia.edificio}-${materia.aula}`
      });
    });
  });

  const diasOrden = ["Lu", "Ma", "Mi", "Ju", "Vi"];
  const generarHorarioEjemplo = (datosHorario, tablaHorario) => {
    if (!tablaHorario) return;

    const horasUnicas = [...new Set(datosHorario.map(d => d.hora))].sort();
    const horarioMap = {};

    horasUnicas.forEach(hora => {
      horarioMap[hora] = {};
      diasOrden.forEach(dia => {
        horarioMap[hora][dia] = null;
      });
    });

    datosHorario.forEach(({ dia, hora, materia, aula }) => {
      if (horarioMap[hora]) {
        horarioMap[hora][dia] = `${materia}<br>${aula}`;
      }
    });

    let stringBuilderHtml = "";
    horasUnicas.forEach(hora => {
      stringBuilderHtml += `<tr>`;
      stringBuilderHtml += `<td>${hora}</td>`;
      diasOrden.forEach(dia => {
        const contenido = horarioMap[hora][dia];
        stringBuilderHtml += `<td class="${contenido ? 'bg-light-blue' : ''}">${contenido || ''}</td>`;
      });
      stringBuilderHtml += `</tr>`;
    });

    tablaHorario.innerHTML = stringBuilderHtml;
  };

  const mostrarSeccionesCancelables = async () => {
    const secciones = await obtenerSeccionesActuales(idEstudiante);
    if (!tablaCancelacion) return;

    tablaCancelacion.innerHTML = "";
    secciones.forEach(seccion => {
      const fila = document.createElement("tr");
      fila.innerHTML = `
        <td><input class="form-check-input" type="checkbox" value="${seccion.seccion_id}"></td>
        <td>${seccion.codigo_clase}</td>
        <td>${seccion.nombre_clase}</td>
        <td>${seccion.codigo_seccion}</td>
        <td>${seccion.horario}</td>
        <td>${seccion.nombre_docente}</td>
      `;
      tablaCancelacion.appendChild(fila);
    });
  };

  function puedeMatricularHoy(datos) {
    // fecha actual en formato YYYY-MM-DD
    const fechaHoy = new Date().toISOString().split('T')[0];

    // Buscar registro donde la fecha sea hoy Y puede_matricular sea 1
    const registroHoy = datos.find(registro =>
      registro.dia === fechaHoy && registro.puede_matricular === 1
    );

    return registroHoy ? true : false;
  }

  function obtenerProximoDiaMatricula(datos) {
    // Buscar el dia donde puede_matricular == 1
    const diaAsignado = datos.find(registro =>
      registro.puede_matricular === 1
    );

    return diaAsignado || null;
  }

  //Aqui insertar la verificacion por fecha de matricula.
  // if(verificar fecha actual con la que vamos a traer de la base, que tenga valor true){
  //    if(idestudiante){fdsfds lo mismo}   
  //} else{ al select ponerle que la fecha de matriucla no esta activa }

  const diasDeMatricula = await obtenerDiasMatriculaEstudiante(idEstudiante);
  console.log(diasDeMatricula);

  if (idEstudiante) {
    if (puedeMatricularHoy(diasDeMatricula)) {
      const departamentos = await obtenerDepartamentosPorClases('20201003849');
      limpiarSelect(selectClasificacion);
      llenarSelect(selectClasificacion, departamentos, "nombre_departamento", "departamento_id");
    } else {
      const proximoDia = obtenerProximoDiaMatricula(diasDeMatricula);
      limpiarSelect(selectClasificacion);
      const optionNoPuede = document.createElement("option");
      const optionProximoDia = document.createElement("option");
      optionNoPuede.textContent = `No puede matricular`;
      optionProximoDia.textContent = `Tu dia de matricula es: ${proximoDia.dia}`;
      optionNoPuede.disabled = true;
      optionProximoDia.disabled = true;
      optionNoPuede.style.backgroundColor = "red";
      optionProximoDia.style.backgroundColor = "red";
      optionNoPuede.style.color = "white";
      optionProximoDia.style.color = "white";
      selectClasificacion.appendChild(optionNoPuede);
      selectClasificacion.appendChild(optionProximoDia);

      console.log(proximoDia);
    }
  }

  selectClasificacion?.addEventListener("change", async () => {
    limpiarSelect(selectAsignatura);
    limpiarSelect(selectHorario);
    const clasificacion = selectClasificacion.value;

    if (clasificacion !== "Selecciona una clasificación") {
      const asignaturas = await obtenerAsignaturasPorDepartamento('20201003849', clasificacion);
      llenarSelect(selectAsignatura, asignaturas, "nombre_clase", "clase_id");
    }
  });

  const clasesCursadasYCursando = await obtenerClasesEstudiante(matriculaEstudiante);
  selectAsignatura?.addEventListener("change", async () => {
    limpiarSelect(selectHorario);
    const asignatura = parseInt(selectAsignatura.value);

    if (asignatura !== "Selecciona una asignatura") {
      const claseEncontrada = clasesCursadasYCursando.find(c => c.clase_id === asignatura);

      if (claseEncontrada) {
        const opcionRoja = document.createElement("option");
        opcionRoja.textContent = "Ya cursaste o estas cursando esta clase.";
        opcionRoja.disabled = true;
        opcionRoja.selected = true;
        opcionRoja.style.backgroundColor = "red";
        opcionRoja.style.color = "white";

        selectHorario.appendChild(opcionRoja);
      } else {
        const horarios = await obtenerHorariosPorAsignatura(asignatura);
        llenarSelectHorarios(selectHorario, horarios, "codigo_seccion", "dias", "hora_inicio", "hora_fin", "seccion_id");
      }
    }
  });

  btnMatricular?.addEventListener("click", async () => {
    const estudiante = '20201003849';
    const horario = selectHorario.value;
    const hayConflictoHorario = await verificarConflictoHorario(idEstudiante, horario);

    console.log(hayConflictoHorario);

    if(hayConflictoHorario === 1){
      modal.show("Ya tiene una clase matriculada en ese horario");
      return;
    }

    if (!horario || horario.includes("Selecciona")) {
      modal.show("Debe seleccionar una sección");
      return;
    }

    const datos = { estudiante, horario };
    const respuesta = await matricularSeccion(datos);

    if (respuesta.success) {
      modal.show("¡Matrícula realizada con éxito!", () => location.reload());
    } else {
      modal.show(respuesta.mensaje || "No se pudo realizar la matrícula.");
    }
  });

  btnCancelar?.addEventListener("click", async () => {
    const estudiante = '20201003849';
    const checkboxes = tablaCancelacion.querySelectorAll("input[type='checkbox']:checked");
    const ids = Array.from(checkboxes).map(c => c.value);

    if (ids.length === 0) {
      modal.show("Selecciona al menos una asignatura para cancelar.");
      return;
    }

    // Confirmación con callback
    modal.confirm("¿Estás seguro de cancelar las secciones seleccionadas?", async () => {
      const respuesta = await cancelarSecciones(ids, estudiante);

      if (respuesta.success) {
        modal.show("Secciones canceladas correctamente.", () => {
          mostrarSeccionesCancelables();
          location.reload();
        });
      } else {
        modal.show(respuesta.mensaje || "No se pudo cancelar.");
      }
    });
  });

  checkboxSelectAll?.addEventListener("change", (e) => {
    const checkboxes = tablaCancelacion.querySelectorAll("input[type='checkbox']");
    checkboxes.forEach(cb => cb.checked = e.target.checked);
  });

  mostrarSeccionesCancelables();
  generarHorarioEjemplo(datosHorario, tablaHorario);
};

const inicializarVistaCertificado = async () => {
  const matriculaEstudiante = sessionStorage.getItem('matricula') || '20201003849';
  const btnDescargarCertificado = document.getElementById('btnDescargarCertificado');

  btnDescargarCertificado.addEventListener("click", () => {
    const url = `cert.php?cuenta=${encodeURIComponent(matriculaEstudiante)}`;
    const nuevaVentana = window.open(url, '_blank');

    nuevaVentana.onload = () => {
      nuevaVentana.print();
    };
  });
};
