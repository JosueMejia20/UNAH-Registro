const BASE_URL = '/api/admisiones';
import { UnahNavbar } from "/../../components/navbar.mjs";
customElements.define("unah-navbar", UnahNavbar);

import { UnahFooter } from "../../components/footer.mjs";
customElements.define("unah-footer", UnahFooter);

import { Cargando, loadingEvent } from "../../components/loading.mjs";
customElements.define("pantalla-de-carga", Cargando);
loadingEvent();

import {
  cargarEstadoCivil,
  cargarDepartamentos,
  cargarPaises,
  cargarCentroRegional,
  cargarCarreras,
  filtrarCarreraSecundaria
} from "/../../components/Admisiones/formulario_Controller.mjs";

import {
  verDetalles,
  responderSolicitud,
  cargarSolicitudesPaginadas,
  loginRevisor
} from "../../components/Admisiones/revisores_controller.mjs";

document.addEventListener('DOMContentLoaded', async () => {
  // Formulario de admisiones
  const selectCarreraInteres = document.getElementById('carrera-interes');
  const selectCarreraSecundaria = document.getElementById('carrera-secundaria');
  const selectCentroRegional = document.getElementById('centro-regional');

  if (selectCarreraInteres && selectCarreraSecundaria) {
    selectCarreraInteres.disabled = true;
    selectCarreraSecundaria.disabled = true;
  }

  if (
    document.getElementById('estado-civil') &&
    document.getElementById('departamento') &&
    document.getElementById('pais-estudio') &&
    selectCentroRegional
  ) {
    await cargarEstadoCivil();
    await cargarDepartamentos();
    await cargarPaises();
    await cargarCentroRegional();
  }

  if (selectCentroRegional) {
    selectCentroRegional.addEventListener('change', async (e) => {
      const centroId = e.target.value;
      if (centroId) {
        await cargarCarreras(centroId);
      }
    });
  }

  if (selectCarreraInteres) {
    selectCarreraInteres.addEventListener('change', () => {
      filtrarCarreraSecundaria();
    });
  }

  // Submit del formulario
  const form = document.getElementById('admissionForm');
  //const preview = document.getElementById('previewDatos');
  const submitBtn = document.getElementById('submitBtn');

  if (form && submitBtn) {
    submitBtn.addEventListener('click', async (e) => {
      e.preventDefault();

      const formData = new FormData(form);
      const datosJSON = {};

      const toBase64 = file => new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = reject;
      });

      for (const [key, value] of formData.entries()) {
        if (value instanceof File && value.name) {
          datosJSON[key] = await toBase64(value);
        } else {
          datosJSON[key] = value;
        }
      }

     // preview.style.display = 'block';
     // preview.textContent = JSON.stringify(datosJSON, null, 2);

      await fetch(`${BASE_URL}/post/insertPostulanteInscripcion/index.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(datosJSON)
      });
    });
  }


  const loginForm = document.getElementById('loginForm');
  const btnLogin = document.querySelector('.btn-login');
  const btnText = document.querySelector('.btn-text');
  const spinner = document.querySelector('.spinner-border');
  const togglePassword = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('password');

  if (loginForm) {
    // Mostrar/ocultar contraseña
    if (togglePassword && passwordInput) {
      togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('bi-eye-fill');
        this.querySelector('i').classList.toggle('bi-eye-slash-fill');
      });
    }

    // Validación y envío del login
    loginForm.addEventListener('submit', async function (e) {
      e.preventDefault();

      if (!loginForm.checkValidity()) {
        e.stopPropagation();
        loginForm.classList.add('was-validated');
        return;
      }

      btnText.textContent = "Verificando...";
      spinner.classList.remove('d-none');
      btnLogin.disabled = true;

      const exito = await loginRevisor();

      console.log(exito);

      if (exito) {
        btnLogin.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i> Bienvenido';
        btnLogin.classList.add('btn-success');

        setTimeout(() => {
          alert("Acceso exitoso. Redirigiendo...");
          window.location.href = "../../../admisiones/revisores.php";
        }, 1000);
      } else {
        btnText.textContent = "Ingresar";
        spinner.classList.add('d-none');
        btnLogin.disabled = false;
        alert("Credenciales incorrectas. Intente de nuevo.");
      }
    });

    // Efectos hover en inputs
    document.querySelectorAll('.input-animate').forEach(input => {
      input.addEventListener('mouseenter', () => {
        const groupText = input.parentElement.querySelector('.input-group-text');
        if (groupText) groupText.style.transform = 'scale(1.1)';
      });
      input.addEventListener('mouseleave', () => {
        const groupText = input.parentElement.querySelector('.input-group-text');
        if (groupText) groupText.style.transform = 'scale(1)';
      });
    });
  }


  if (document.getElementById('requestsTableBody')) {
    const idRevisor = localStorage.getItem('idRevisor');
    if (idRevisor) {
      await cargarSolicitudesPaginadas(parseInt(idRevisor));
    } else {
      alert("Debes iniciar sesión");
      window.location.href = "../login.php";
    }
  }

  if (document.getElementById('requests-body')) {
    const { initRevisores } = await import('/Admisiones/revisores.js');
    initRevisores();
  }

  // Funciones globales para manejar solicitudes
  window.verDetalles = verDetalles;

  window.showRejectionReason = () => {
    document.getElementById('rejectionReason').style.display = 'block';
    document.getElementById('confirmRejectBtn').style.display = 'inline-block';
  };

  window.approveRequest = () => responderSolicitud('Aprobada');

  window.rejectRequest = () => {
    const razon = document.getElementById('reasonText').value.trim();
    if (!razon) return alert('Debe ingresar una razón para rechazar.');
    responderSolicitud('Rechazada', razon);
  };

  window.closeModal = () => {
    document.getElementById('requestModal').style.display = 'none';
  };
});
/*

Mover esta logica a otro archivo y atarsela a la vista de Solicitud.

import {
    buscarSolicitudPorId,
    actualizarSolicitud,
    renderizarSolicitud
} from "./controllers/solicitudController.mjs";

// Elementos del DOM
const formBuscar = document.getElementById("searchForm");
const inputSolicitudId = document.getElementById("solicitudId");
const resultCard = document.getElementById("resultCard");
const spinner = document.getElementById("loadingSpinner");
const alertaNoEncontrado = document.getElementById("notFoundAlert");
const mensajeExito = document.getElementById("updateSuccess");
const mensajeError = document.getElementById("updateError");
const botonActualizar = document.getElementById("updateBtn");

// Evento de búsqueda
formBuscar.addEventListener("submit", async (e) => {
    e.preventDefault();

    const id = inputSolicitudId.value.trim();
    if (!id) return;

    mostrarSpinner(true);
    ocultarMensajes();

    const solicitud = await buscarSolicitudPorId(id);

    mostrarSpinner(false);

    if (solicitud) {
        renderizarSolicitud(solicitud);
        resultCard.style.display = "block";
    } else {
        alertaNoEncontrado.style.display = "block";
        resultCard.style.display = "none";
    }
});

// Función para habilitar edición de campos
window.enableEdit = (campoId, tipo = "text") => {
    const field = document.getElementById(campoId);

    if (tipo === "select") {
        const valorActual = field.innerText;
        const opciones = Array.from(new Set([valorActual])); // se puede reemplazar con valores desde BD si los traes
        const select = document.createElement("select");
        select.className = "form-control";

        opciones.forEach(op => {
            const option = document.createElement("option");
            option.value = op;
            option.textContent = op;
            if (op === valorActual) option.selected = true;
            select.appendChild(option);
        });

        select.id = campoId;
        field.replaceWith(select);
    } else {
        field.contentEditable = "true";
        field.focus();
    }
};

// Obtener campos editables actualizados
function obtenerDatosEditados() {
    const getValor = (id) => {
        const el = document.getElementById(id);
        return el?.tagName === "SELECT" ? el.value : el?.textContent.trim();
    };

    return {
        nombre: getValor("nombreCompleto"),
        fecha_nacimiento: getValor("fechaNacimiento"),
        genero: getValor("genero"),
        telefono: getValor("telefono"),
        email: getValor("email"),
        direccion: getValor("direccion"),
        centro: getValor("centroRegional"),
        carrera: getValor("carreraInteres"),
        instituto: getValor("institutoEducacion"),
        anio_graduacion: getValor("anioGraduacion"),
    };
}

// Evento para enviar actualización
botonActualizar.addEventListener("click", async () => {
    ocultarMensajes();

    const solicitudId = document.getElementById("solicitudNumber").textContent.trim();
    const datosActualizados = obtenerDatosEditados();

    const ok = await actualizarSolicitud(solicitudId, datosActualizados);

    if (ok) {
        mensajeExito.style.display = "block";
    } else {
        mensajeError.style.display = "block";
    }

    setTimeout(ocultarMensajes, 4000);
});

// Funciones auxiliares
function mostrarSpinner(mostrar) {
    spinner.style.display = mostrar ? "block" : "none";
}

function ocultarMensajes() {
    alertaNoEncontrado.style.display = "none";
    mensajeExito.style.display = "none";
    mensajeError.style.display = "none";
}*/
