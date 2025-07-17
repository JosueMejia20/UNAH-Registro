// assets/js/controllers/revisoresController.mjs
const BASE_URL = '/api/admisiones';

// Obtener solicitudes por ID del revisor
export const obtenerSolicitudesPorRevisor = async (idRevisor) => {
    try {
        const res = await fetch(`${BASE_URL}/get/solicitudesByRevisor/index.php/${idRevisor}`);
        const data = await res.json();
        return data;
    } catch (error) {
        console.error('Error al obtener solicitudes:', error);
        return [];
    }
};

// Obtener detalle de una solicitud por ID
export const obtenerDetalleSolicitud = async (inscripcion_id) => {
    try {
        const res = await fetch(`${BASE_URL}/get/solicitudDetalle/index.php/${inscripcion_id}`);
        const data = await res.json();
        return data;
    } catch (error) {
        console.error('Error al obtener detalle de solicitud:', error);
        return null;
    }
};

// Aprobar solicitud
export const aprobarSolicitud = async (inscripcion_id) => {
    try {
        const res = await fetch(`${BASE_URL}/post/aprobarSolicitud/index.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ inscripcion_id })
        });
        return await res.json();
    } catch (error) {
        console.error('Error al aprobar solicitud:', error);
    }
};

// Rechazar solicitud
export const rechazarSolicitud = async (inscripcion_id, razon) => {
    try {
        const res = await fetch(`${BASE_URL}/post/rechazarSolicitud/index.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ inscripcion_id, razon })
        });
        return await res.json();
    } catch (error) {
        console.error('Error al rechazar solicitud:', error);
    }
};

export const validarCredenciales = async (cuenta, contrasena) => {
    try {
        const res = await fetch(`/api/admisiones/post/loginRevisor/index.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                username: user,
        password: password
            })
        });

        if (!res.ok) throw new Error('Error de red');
        
        const data = await res.json();
        return data;
    } catch (error) {
        console.error('Error en login:', error);
        return { success: false, message: 'Error de conexión' };
    }
};