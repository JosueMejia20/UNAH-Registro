const BASE_URL = '/api/estudiantes';

/**
 *  Vista en General
 */
export const cargarDocentesSeccionesMatriculadas = async (matricula) => {
  try {
    const response = await fetch(`${BASE_URL}/get/docentesSeccionMatriculada/index.php?matricula=${matricula}`);
    //const data = await response.json();

    if (!response.ok) throw new Error('Error al obtener contactos');
    return await response.json();
  } catch (error) {
    console.error('Error al cargar contactos:', error);
    return [];
  }
};

export const cargarInfoDocente = async (idDocente) => {
  try {
    const response = await fetch(`${BASE_URL}/get/infoDocente/index.php?idDocente=${idDocente}`);
    //const data = await response.json();

    if (!response.ok) throw new Error('Error al obtener contactos');
    return await response.json();
  } catch (error) {
    console.error('Error al cargar contactos:', error);
    return [];
  }
};

export const cargarAsignaturasDocente = async (idDocente) => {
  try {
    const response = await fetch(`${BASE_URL}/get/asignaturasDocente/index.php?idDocente=${idDocente}`);
    //const data = await response.json();

    if (!response.ok) throw new Error('Error al obtener contactos');
    return await response.json();
  } catch (error) {
    console.error('Error al cargar contactos:', error);
    return [];
  }
};

