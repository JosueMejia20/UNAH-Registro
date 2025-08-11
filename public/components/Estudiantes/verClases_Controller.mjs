const BASE_URL = '/api/estudiantes';

export const cargarIntroduccionClase = async (idSeccion) => {
  try {
    const response = await fetch(`${BASE_URL}/get/getIntroduccionClaseInfo/index.php?idSeccion=${idSeccion}`);
    //const data = await response.json();

    if (!response.ok) throw new Error('Error al obtener contactos');
    return await response.json();
  } catch (error) {
    console.error('Error al cargar contactos:', error);
    return [];
  }
};


export const cargarPdfIntroduccion = async (idSeccion) => {
  try {
    const response = await fetch(`${BASE_URL}/get/getPdfIntroduccion/index.php?idSeccion=${idSeccion}`);
    //const data = await response.json();

    if (!response.ok) throw new Error('Error al obtener contactos');
    return await response.json();
  } catch (error) {
    console.error('Error al cargar contactos:', error);
    return [];
  }
};



