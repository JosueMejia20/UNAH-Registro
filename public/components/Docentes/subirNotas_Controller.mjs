const BASE_URL = '/api/docentes';

export const cargarSeccionPorId = async (idSeccion) => {
  try {
    const response = await fetch(`${BASE_URL}/get/getClaseSeccion/index.php?idSeccion=${idSeccion}`);
    //const data = await response.json();

    if (!response.ok) throw new Error('Error al obtener contactos');
    return await response.json();
  } catch (error) {
    console.error('Error al cargar contactos:', error);
    return [];
  }
};

export const subirNota = async (datosJson) => {
  try {
    const response = await fetch(`${BASE_URL}/post/subirNota/index.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(datosJson),
    });
    if (!response.ok) throw new Error('No se subio la nota');
    return await response.json();
  } catch (error) {
    console.error('Error al insertar nota:', error);
    return null;
  }
};