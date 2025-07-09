

import { UnahNavbar } from "/../../components/navbar.mjs";
customElements.define("unah-navbar", UnahNavbar);

import { UnahFooter } from "../../components/footer.mjs";
customElements.define("unah-footer", UnahFooter);

import {
  cargarEstadoCivil,
  cargarDepartamentos,
  cargarPaises,
  cargarCentroRegional,
  cargarCarreras,
  filtrarCarreraSecundaria
} from "/../../components/Admisiones/formulario_Controller.mjs";

import { capturarYPrevisualizarFormulario } from '/../../components/Admisiones/postForm.mjs';

document.addEventListener('DOMContentLoaded', () => {
  const submitBtn = document.getElementById('submitBtn');

  if (submitBtn) {
    submitBtn.addEventListener('click', async (e) => {
      e.preventDefault();
      await capturarYPrevisualizarFormulario('admissionForm', 'previewDatos');
    });
  }
});

document.addEventListener('DOMContentLoaded', async () => {
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
});
