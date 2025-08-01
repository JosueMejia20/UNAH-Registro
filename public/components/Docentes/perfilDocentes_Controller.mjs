const BASE_URL = '/api/docentes';

export const obtenerInfoDocente = async (idDocente) => {
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

export const subirFotoDocente = async (datosJson) => {
  try {
    const response = await fetch(`${BASE_URL}/put/subirFotoDocente`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(datosJson),
    });
    if (!response.ok) throw new Error('No se pudo subir la foto');
    return await response.json();
  } catch (error) {
    console.error('Error al subir foto:', error);
    return null;
  }
};

export const obtenerFotoDocente = async (idDocente) => {
  try {
    const response = await fetch(`${BASE_URL}/get/fotoPerfilDocente/index.php?idDocente=${idDocente}`);
    //const data = await response.json();

    if (!response.ok) throw new Error('Error al obtener contactos');
    return await response.json();
  } catch (error) {
    console.error('Error al cargar contactos:', error);
    return [];
  }
};



