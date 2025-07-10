const BASE_URL = '/api/admisiones';

// Obtener todas las solicitudes de admisión
export const obtenerSolicitudes = async () => {
  try {
    const response = await fetch(`${BASE_URL}/get/solicitudes`);
    if (!response.ok) throw new Error('Error al obtener las solicitudes');
    return await response.json();
  } catch (error) {
    console.error('Error al obtener solicitudes:', error);
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

// Aprobar una solicitud por ID
export const aprobarSolicitud = async (id) => {
  try {
    const response = await fetch(`${BASE_URL}/post/aprobarSolicitud`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id })
    });
    return await response.json();
  } catch (error) {
    console.error(`Error al aprobar solicitud ${id}:`, error);
    return null;
  }
};

// Rechazar una solicitud con ID y razón
export const rechazarSolicitud = async (id, razon) => {
  try {
    const response = await fetch(`${BASE_URL}/post/rechazarSolicitud`, {
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
