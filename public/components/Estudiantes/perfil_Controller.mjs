const BASE_URL = "/api/estudiantes";

/**
 * Obtener perfil de estudiante por matrícula
 */
export const obtenerPerfilEstudiante = async (matricula) => {
  try {
    const response = await fetch(`${BASE_URL}/perfil?matricula=${matricula}`);
    if (!response.ok) throw new Error("No se pudo obtener el perfil del estudiante");
    return await response.json();
  } catch (error) {
    console.error("Error al obtener perfil:", error);
    return null;
  }
};

/**
 * Renderizar perfil en la vista
 */
export const renderPerfilEstudiante = ({ datosPersonales, datosAcademicos, materias }) => {
  // Datos personales
  document.querySelector("h2").textContent = datosPersonales.nombre_completo;
  document.querySelector(".info-value[data-field='correo']").textContent = datosPersonales.correo;
  document.querySelector(".info-value[data-field='telefono']").textContent = datosPersonales.telefono;
  document.querySelector(".info-value[data-field='direccion']").textContent = datosPersonales.direccion;
  document.querySelector(".info-value[data-field='fecha_nacimiento']").textContent = datosPersonales.fecha_nacimiento;
  document.querySelector(".info-value[data-field='identidad']").textContent = datosPersonales.identidad;

  // Datos académicos
  document.querySelector(".info-value[data-field='carrera']").textContent = datosAcademicos.carrera;
  document.querySelector(".info-value[data-field='centro']").textContent = datosAcademicos.centro_universitario;
  document.querySelector(".info-value[data-field='facultad']").textContent = datosAcademicos.facultad;
  document.querySelector(".info-value[data-field='ingreso']").textContent = datosAcademicos.anio_ingreso;
  document.querySelector(".info-value[data-field='estado']").innerHTML = `<span class="badge bg-success">${datosAcademicos.estado}</span>`;
  document.querySelector(".info-value[data-field='tipo']").textContent = datosAcademicos.tipo_estudiante;

  // Materias actuales
  const tbody = document.querySelector("#tabla-materias tbody");
  tbody.innerHTML = "";

  materias.forEach((m) => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${m.codigo}</td>
      <td>${m.asignatura}</td>
      <td>${m.seccion}</td>
      <td>${m.horario}</td>
      <td>${m.docente}</td>
    `;
    tbody.appendChild(tr);
  });
};
