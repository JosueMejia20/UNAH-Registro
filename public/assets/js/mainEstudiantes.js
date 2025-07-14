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

document.addEventListener('DOMContentLoaded', async () => {
  const matriculaEstudiante = obtenerMatriculaDesdeSesion();

  // 1. Cargar perfil
  const perfil = await obtenerPerfilEstudiante(matriculaEstudiante);
  if (perfil) {
    mostrarPerfilEnVista(perfil);
  }

  // 2. Cargar materias actuales
  const materias = await obtenerMateriasActuales(matriculaEstudiante);
  mostrarMateriasEnTabla(materias);

  // 3. Botón para abrir modal de edición
  const btnEditar = document.getElementById('btn-editar-perfil');
  btnEditar.addEventListener('click', () => {
    if (perfil) {
      cargarFormularioEdicion(perfil);
      const modal = new bootstrap.Modal(document.getElementById('modalEditarPerfil'));
      modal.show();
    }
  });

  // 4. Formulario de actualización (con imagen de perfil)
  const form = document.getElementById('formEditarPerfil');
  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData();
    formData.append('correo', document.getElementById('correo').value);
    formData.append('telefono', document.getElementById('telefono').value);
    formData.append('direccion', document.getElementById('direccion').value);
    formData.append('fecha_nacimiento', document.getElementById('fecha_nacimiento').value);

    const archivo = document.getElementById('foto_perfil').files[0];
    if (archivo) {
      formData.append('foto_perfil', archivo);
    }

    try {
      const response = await fetch('/api/estudiantes/post/updatePerfil', {
        method: 'POST',
        body: formData
      });

      const resultado = await response.json();
      if (resultado.success) {
        alert('Perfil actualizado correctamente');
        const nuevoPerfil = await obtenerPerfilEstudiante(matriculaEstudiante);
        mostrarPerfilEnVista(nuevoPerfil);
        bootstrap.Modal.getInstance(document.getElementById('modalEditarPerfil')).hide();
      } else {
        alert('Error al actualizar el perfil');
      }
    } catch (error) {
      console.error('Error al enviar perfil:', error);
      alert('Ocurrió un error en la conexión con el servidor.');
    }
  });
});

// Puedes adaptar esta función a como guardas la sesión (localStorage, variable global, etc.)
function obtenerMatriculaDesdeSesion() {
  // Por ahora, valor fijo para pruebas
  return '20201003849';
}
