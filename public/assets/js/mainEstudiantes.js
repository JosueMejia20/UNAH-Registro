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
      if (fotoPerfil != null) {
        asignarImagenBase64(imgTagFotoPerfil, fotoPerfil[0]["foto_perfil"]);
      } else {
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

  if (ruta.includes('certificado.php')) {
    inicializarVistaCertificado();
  }

  // De acuerdo se agreguen mas metodos para las demas vistas. Se deben agregar mas if en esta parte de aca
});


// ==========================
// FUNCIÓN - VISTA MATRÍCULA
// ==========================
const inicializarVistaMatricula = async () => {

  const matriculaEstudiante = sessionStorage.getItem('matricula') || '20201003849';

  const selectClasificacion = document.querySelector('#departamentosClases');
  console.log(selectClasificacion);

  const selectAsignatura = document.querySelector("#clasesDepartamentos");
  console.log(selectAsignatura);

  const selectHorario = document.querySelector("#horarios");
  console.log(selectHorario);

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
  //console.log(materiasActuales);
  const datosHorario = [];

  materiasActuales.forEach((materia) => {
    const diasSeparados = separarDias(materia.dias);


    diasSeparados.forEach((dia) => {
      datosHorario.push({
        dia: dia,
        hora: materia.horario,
        materia: materia.nombre_clase,
        aula: `${materia.edificio}-${materia.aula}`
      })
    });
  });

  console.log(datosHorario);

  const diasOrden = ["Lu", "Ma", "Mi", "Ju", "Vi"];
  const generarHorarioEjemplo = (datosHorario, tablaHorario) => {

    if (!tablaHorario) return;

    //Hacer un array del Set de datosHorario para obtener las horas unicas (propiedad del set)
    //uso de map para simplificar la iteracion sobre datosHorario (que es un arreglo de json)
    //datosHorario puede extenderse mucho, ya que guarda por dia y no por materia. Si dos materias
    //son de lunes a viernes, entonces serian 10 registros (2*5)
    const horasUnicas = [...new Set(datosHorario.map(d => d.hora))].sort();

    //Para almacenar hora > {dia>materia}
    const horarioMap = {};

    horasUnicas.forEach(hora => {
      horarioMap[hora] = {}; //Las filas de la tabla

      diasOrden.forEach(dia => {

        horarioMap[hora][dia] = null; //Se inicializa con null cada celda.

      });
    });


    datosHorario.forEach(({ dia, hora, materia, aula }) => {
      if (horarioMap[hora]) {
        //horarioMap["08:00 - 09:30"]["Lu"] = "Matemáticas<br>A1-103";
        horarioMap[hora][dia] = `${materia}<br>${aula}`; //Cada celda tiene la forma materia, salto linea, aula
      }
    });

    let stringBuilderHtml = ""

    horasUnicas.forEach(hora => {
      stringBuilderHtml += `<tr>`;
      stringBuilderHtml += `<td>${hora}</td>`; //Primera columna, la hora

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
      const asignaturas = await obtenerAsignaturasPorDepartamento('20201003849', clasificacion);
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
      //generarHorarioEjemplo(datosHorario, tablaHorario);
      // mostrarSeccionesCancelables();
      location.reload();
    } else {
      alert(respuesta.mensaje || "No se pudo realizar la matrícula.");
    }
  });

  btnCancelar?.addEventListener("click", async () => {
    const estudiante = '20201003849'; //SE DEBE HACER LOGICA PARA OBTENERLO DE SESION
    const checkboxes = tablaCancelacion.querySelectorAll("input[type='checkbox']:checked");
    console.log(checkboxes);
    const ids = Array.from(checkboxes).map(c => c.value);
    console.log(ids);

    if (ids.length === 0) {
      alert("Selecciona al menos una asignatura para cancelar.");
      return;
    }

    const confirmacion = confirm("¿Estás seguro de cancelar las secciones seleccionadas?");
    if (!confirmacion) return;

    const respuesta = await cancelarSecciones(ids, estudiante); //ids es un array

    if (respuesta.success) {
      alert("Secciones canceladas correctamente.");
      mostrarSeccionesCancelables();
      location.reload();
    } else {
      alert(respuesta.mensaje || "No se pudo cancelar.");
    }
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
}
/*
document.addEventListener('DOMContentLoaded', () => {
  inicializarVistaMatricula();
});*/