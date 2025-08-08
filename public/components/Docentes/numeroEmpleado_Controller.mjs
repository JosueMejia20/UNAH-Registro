const BASE_URL = '/api/docentes';

export const obtenerNumeroEmpleado = async (idUsuario) => {
  try {
    const response = await fetch(`${BASE_URL}/get/numeroDocente/index.php?usuarioId=${idUsuario}`);
    //const data = await response.json();

    if (!response.ok) throw new Error('Error al numero de empleado');
    return await response.json();
  } catch (error) {
    console.error('Error al cargar numero de empleado:', error);
    return [];
  }
};