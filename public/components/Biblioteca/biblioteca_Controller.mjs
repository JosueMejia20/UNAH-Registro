const BASE_URL = '/api/biblioteca';

/**
 *  Vista en General
 */
export const cargarRecursosDocente = async (idDocente) => {
  try {
    const response = await fetch(`${BASE_URL}/get/recursosDocente?idDocente=${idDocente}`);
    //const data = await response.json();

    if (!response.ok) throw new Error('Error al obtener recursos');
    return await response.json();
  } catch (error) {
    console.error('Error al cargar recursos:', error);
    return [];
  }
};


