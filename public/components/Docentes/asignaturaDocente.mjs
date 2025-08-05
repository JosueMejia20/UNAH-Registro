const BASE_URL = '/api/docentes';

export const obtenerInfoAsignatura = async (idDocente) => {
  try {
    const response = await fetch(`${BASE_URL}/get/infoAsignaturaDocente/index.php?idDocente=${idDocente}`);
    //const data = await response.json();

    if (!response.ok) throw new Error('Error al obtener contactos');
    return await response.json();
  } catch (error) {
    console.error('Error al cargar contactos:', error);
    return [];
  }
};