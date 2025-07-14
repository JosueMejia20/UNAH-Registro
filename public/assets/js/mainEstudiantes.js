import { UnahNavbar } from "/../../components/navbar.mjs";
customElements.define("unah-navbar", UnahNavbar);

import { Cargando, loadingEvent } from "../../components/loading.mjs";
customElements.define("pantalla-de-carga", Cargando);
loadingEvent();

import { UnahFooter } from "../../components/footer.mjs";
customElements.define("unah-footer", UnahFooter);

import { UnahSidebar } from "../../components/sidebar.mjs";
customElements.define("unah-sidebar", UnahSidebar);

import {
  obtenerPerfilEstudiante,
  mostrarPerfilEnVista,
  cargarFormularioEdicion,
  obtenerMateriasActuales,
  mostrarMateriasEnTabla
} from '../../components/Estudiantes/perfil_Controller.mjs';

let perfilGlobal = null;

document.addEventListener('DOMContentLoaded', async () => {
  // Esperar a que el contenedor principal tenga la vista cargada
  const observer = new MutationObserver(async (mutations, obs) => {
    const btnEditar = document.getElementById('btn-editar-perfil');
    const form = document.getElementById('formEditarPerfil');

    if (btnEditar && form) {
      obs.disconnect(); // Ya está cargado

      const matriculaEstudiante = obtenerMatriculaDesdeSesion();
      perfilGlobal = await obtenerPerfilEstudiante(matriculaEstudiante);
      if (perfilGlobal) {
        mostrarPerfilEnVista(perfilGlobal);
      }

      const materias = await obtenerMateriasActuales(matriculaEstudiante);
      mostrarMateriasEnTabla(materias);

      // Botón para abrir modal
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
  });

  // Observar cambios en el contenedor de vistas
  const contenedor = document.getElementById('main-content');
  observer.observe(contenedor, { childList: true, subtree: true });
});

// Utiliza sessionStorage si está disponible
function obtenerMatriculaDesdeSesion() {
  return sessionStorage.getItem('matricula') || '20201003849';
}
