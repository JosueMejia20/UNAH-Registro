const BASE_URL = '/api/docentes';

export const obtenerIntroduccionPorDocente = async (idDocente) => {
  try {
    const response = await fetch(`${BASE_URL}/get/introduccionesPorDocente/index.php?idDocente=${idDocente}`);
    //const data = await response.json();

    if (!response.ok) throw new Error('Error al obtener contactos');
    return await response.json();
  } catch (error) {
    console.error('Error al cargar contactos:', error);
    return [];
  }
};

export const insertarIntroduccionClase = async (datosJson) => {
  try {
    const response = await fetch(`${BASE_URL}/post/RecursosSeccionBienvenida/index.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(datosJson),
    });
    if (!response.ok) throw new Error('No se registrar su recurso');
    return await response.json();
  } catch (error) {
    console.error('Error al insertar recurso:', error);
    return null;
  }
};