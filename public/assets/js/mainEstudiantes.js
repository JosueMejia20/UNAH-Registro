import {
  obtenerPerfilEstudiante,
  mostrarPerfilEnVista,
  cargarFormularioEdicion,
  actualizarPerfil,
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

  // 4. Formulario de actualización
  const form = document.getElementById('formEditarPerfil');
  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = {
      identidad: document.getElementById('identidad').value,
      correo: document.getElementById('correo').value,
      telefono: document.getElementById('telefono').value,
      direccion: document.getElementById('direccion').value,
      fecha_nacimiento: document.getElementById('fecha_nacimiento').value
    };

    const resultado = await actualizarPerfil(formData);
    if (resultado && resultado.success) {
      alert('Perfil actualizado correctamente');
      const nuevoPerfil = await obtenerPerfilEstudiante(matriculaEstudiante);
      mostrarPerfilEnVista(nuevoPerfil);
      bootstrap.Modal.getInstance(document.getElementById('modalEditarPerfil')).hide();
    } else {
      alert('Error al actualizar el perfil');
    }
  });
});

// Puedes adaptar esta función a como guardas la sesión (localStorage, variable global, etc.)
function obtenerMatriculaDesdeSesion() {
  // Por ahora, valor fijo para pruebas
  return '201810010001';
}
