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



  
  // Agregado: lógica para capturar y mostrar el JSON antes de enviar
  const form = document.getElementById('admissionForm');
  const preview = document.getElementById('previewDatos');
  const submitBtn = document.getElementById('submitBtn');

  if (form && submitBtn && preview) {
    submitBtn.addEventListener('click', async (e) => {
      e.preventDefault();
    
      const formData = new FormData(form);
      const datosJSON = {};
    
      // Función para convertir a base64
      const toBase64 = file => new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = reject;
      });
    
      for (const [key, value] of formData.entries()) {
        if (value instanceof File && value.name) {
          // Solo si hay archivo seleccionado
          datosJSON[key] = await toBase64(value);
        } else {
          datosJSON[key] = value;
        }
      }
    
      preview.style.display = 'block';
      preview.textContent = JSON.stringify(datosJSON, null, 2);
    
      // Puedes enviar este JSON si así lo deseas
      // const response = await fetch(${BASE_URL}/Admisiones/submit, {
      //   method: 'POST',
      //   headers: {
      //     'Content-Type': 'application/json'
      //   },
      //   body: JSON.stringify(datosJSON)
      // });
    });
  }
});
