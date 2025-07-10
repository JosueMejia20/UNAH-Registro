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
  const preview = document.getElementById('previewDatos');
  const submitBtn = document.getElementById('submitBtn');

  if (form && submitBtn && preview) {
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

      preview.style.display = 'block';
      preview.textContent = JSON.stringify(datosJSON, null, 2);

      const response = await fetch(`${BASE_URL}/post/insertPostulanteInscripcion/index.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(datosJSON)
      });
    });
  }

  // 📦 Carga dinámica del módulo de revisores si detecta elementos
  if (document.getElementById('requests-body')) {
    const { initRevisores } = await import('/Admisiones/revisores.js');
    initRevisores();
  }
});

import { verDetalles,
  responderSolicitud,
  cargarSolicitudesPaginadas } from "../../components/Admisiones/revisores_controller.mjs"; 

// Ejemplo: cargar solicitudes del revisor con ID 3
const idRevisor = 3;
cargarSolicitudesPaginadas(idRevisor);

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