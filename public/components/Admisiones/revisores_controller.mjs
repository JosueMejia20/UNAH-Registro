const BASE_URL = '/api/admisiones';

export const obtenerSolicitudesPorRevisor = async (idRevisor) => {
  try {
    const response = await fetch(`${BASE_URL}/get/solicitudes/${idRevisor}`);
    if (!response.ok) throw new Error('Error al obtener las solicitudes');
    return await response.json();
  } catch (error) {
    console.error('Error al consumir solicitudes:', error);
    return [];
  }
};

// Obtener los detalles de una solicitud específica por ID
export const obtenerSolicitudPorId = async (id) => {
  try {
    const response = await fetch(`${BASE_URL}/get/solicitud/${id}`);
    if (!response.ok) throw new Error('Error al obtener la solicitud');
    return await response.json();
  } catch (error) {
    console.error(`Error al obtener solicitud ${id}:`, error);
    return null;
  }
};


// Rechazar una solicitud con ID y razón -CAMBIAR A PUT-
export const cambiarEstadoSolicitud = async (id, razon, valor) => {
  try {
    const response = await fetch(`${BASE_URL}/put/cambiarEstadoSolicitud/${id}/${valor}`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id, razon })
    });
    return await response.json();
  } catch (error) {
    console.error(`Error al rechazar solicitud ${id}:`, error);
    return null;
  }
};
