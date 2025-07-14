const BASE_URL = '/api/estudiantes/get';
const PERFIL_URL = `${BASE_URL}/getinfoEstudiante`;
const ACTUALIZAR_URL = '/api/estudiantes/post/updatePerfil'; // Ajusta esto si tienes un nombre diferente
const MATERIAS_URL = '/api/estudiantes/get/materiasActuales'; // Suponiendo este nombre, confírmame si es otro

export const obtenerPerfilEstudiante = async (matricula) => {
  try {
    const response = await fetch(`${PERFIL_URL}?matricula=${encodeURIComponent(matricula)}`);
    if (!response.ok) throw new Error('Error al obtener perfil del estudiante');
    return await response.json();
  } catch (error) {
    console.error('Error al obtener perfil:', error);
    return null;
  }
};

export const mostrarPerfilEnVista = (datos) => {
  if (!datos) return;

  document.querySelector('[data-field="nombre_completo"]').textContent = datos.nombre_completo;
  document.querySelector('[data-field="carrera_resumen"]').textContent = datos.carrera_resumen;
  document.querySelector('[data-field="matricula"]').textContent = datos.matricula;
  document.querySelector('[data-field="correo"]').textContent = datos.correo;
  document.querySelector('[data-field="telefono"]').textContent = datos.telefono;
  document.querySelector('[data-field="direccion"]').textContent = datos.direccion;
  document.querySelector('[data-field="fecha_nacimiento"]').textContent = datos.fecha_nacimiento;
  document.querySelector('[data-field="identidad"]').textContent = datos.identidad;

  document.querySelector('[data-field="carrera"]').textContent = datos.carrera;
  document.querySelector('[data-field="centro"]').textContent = datos.centro;
  document.querySelector('[data-field="facultad"]').textContent = datos.facultad;
  document.querySelector('[data-field="ingreso"]').textContent = datos.ingreso;
  document.querySelector('[data-field="estado"]').innerHTML = `<span class="badge bg-${datos.estado === 'Activo' ? 'success' : 'secondary'}">${datos.estado}</span>`;
  document.querySelector('[data-field="tipo"]').textContent = datos.tipo;
};

export const cargarFormularioEdicion = (datos) => {
  document.getElementById('correo').value = datos.correo;
  document.getElementById('telefono').value = datos.telefono;
  document.getElementById('direccion').value = datos.direccion;
  document.getElementById('fecha_nacimiento').value = datos.fecha_nacimiento;
  document.getElementById('identidad').value = datos.identidad;
};

export const actualizarPerfil = async (formData) => {
  try {
    const response = await fetch(ACTUALIZAR_URL, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(formData),
    });
    if (!response.ok) throw new Error('No se pudo actualizar el perfil');
    return await response.json();
  } catch (error) {
    console.error('Error al actualizar perfil:', error);
    return null;
  }
};

export const obtenerMateriasActuales = async (matricula) => {
  try {
    const response = await fetch(`${MATERIAS_URL}?matricula=${encodeURIComponent(matricula)}`);
    if (!response.ok) throw new Error('Error al obtener materias');
    return await response.json();
  } catch (error) {
    console.error('Error al cargar materias:', error);
    return [];
  }
};

export const mostrarMateriasEnTabla = (materias) => {
  const tbody = document.querySelector('#tabla-materias tbody');
  tbody.innerHTML = '';
  materias.forEach(materia => {
    const fila = document.createElement('tr');
    fila.innerHTML = `
      <td>${materia.codigo}</td>
      <td>${materia.asignatura}</td>
      <td>${materia.seccion}</td>
      <td>${materia.horario}</td>
      <td>${materia.docente}</td>
    `;
    tbody.appendChild(fila);
  });
};
