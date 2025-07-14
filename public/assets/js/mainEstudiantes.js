import {
  obtenerPerfilEstudiante,
  renderPerfilEstudiante,
} from "/../../components/Estudiantes/perfil_Controller.mjs";

document.addEventListener("DOMContentLoaded", async () => {
  const matricula = "201810010001";
  const datos = await obtenerPerfilEstudiante(matricula);

  if (datos) {
    renderPerfilEstudiante(datos);
    guardarPerfilEnMemoria(datos); // para llenar el modal
  }

  document.querySelector("#btn-editar-perfil").addEventListener("click", () => {
    cargarDatosEnFormularioPerfil();
    const modal = new bootstrap.Modal(document.getElementById("modalEditarPerfil"));
    modal.show();
  });

  document.querySelector("#formEditarPerfil").addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const datosActualizados = Object.fromEntries(formData);

    // TODO: enviar al backend con fetch PUT o POST
    console.log("Datos a guardar:", datosActualizados);

    alert("Cambios guardados (simulado)");
    document.getElementById("modalEditarPerfil").classList.remove("show");
    document.body.classList.remove("modal-open");
    document.querySelector(".modal-backdrop")?.remove();
  });
});

let datosPerfilGlobal = null;

function guardarPerfilEnMemoria(data) {
  datosPerfilGlobal = data;
}

function cargarDatosEnFormularioPerfil() {
  const dp = datosPerfilGlobal.datosPersonales;
  if (!dp) return;

  document.getElementById("correo").value = dp.correo || "";
  document.getElementById("telefono").value = dp.telefono || "";
  document.getElementById("direccion").value = dp.direccion || "";
  document.getElementById("fecha_nacimiento").value = formatearFechaInput(dp.fecha_nacimiento);
  document.getElementById("identidad").value = dp.identidad || "";
}

function formatearFechaInput(fecha) {
  // Convierte "15/03/2000" -> "2000-03-15"
  const [dia, mes, anio] = fecha.split("/");
  return `${anio}-${mes}-${dia}`;
}
