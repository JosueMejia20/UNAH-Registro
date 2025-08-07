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

// Referencias al modal y overlay (asegúrate de que existan en el DOM)
const modal = document.querySelector('unah-modal');
const overlayCarga = document.getElementById('overlayCarga');

// Aprobar solicitud
export const aprobarSolicitud = async (idInscripcion, valor, justificacion, correo) => {
  try {
    // Mostrar overlay
    overlayCarga.style.display = 'flex';

    const estado = valor === 'Aprobada' ? 1 : 0; // 1 aprobada, 0 rechazada

    const response = await fetch(`/api/admisiones/put/cambiarEstadoSolicitud/index.php/${idInscripcion}/${estado}`, {
      method: 'PUT',
      headers:{
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        idInscripcion: idInscripcion,
        valor: estado,
        justificacion: justificacion,
        correo: correo
      })
    });

    // Ocultar overlay
    overlayCarga.style.display = 'none';

    if (!response.ok) throw new Error('Error al actualizar estado');

    const resultado = await response.json();

    if (resultado.success) {
      modal.show(`Solicitud ${valor === 'Aprobada' ? 'aprobada' : 'rechazada'} correctamente`, () => {
        window.location.href = window.location.href;
      });
    } else {
      throw new Error(resultado.message || 'Error al actualizar');
    }

  } catch (error) {
    console.error('Error al responder solicitud:', error);
    overlayCarga.style.display = 'none';
    modal.show('No se pudo actualizar el estado de la solicitud.');
  }
};

// Rechazar solicitud
export const rechazarSolicitud = async (idInscripcion, valor, justificacion, correo) => {
  try {
    // Mostrar overlay
    overlayCarga.style.display = 'flex';

    const estado = valor === 'Rechazada' ? 0 : 1; // 0 rechazada, 1 aprobada

    const response = await fetch(`/api/admisiones/put/cambiarEstadoSolicitud/index.php/${idInscripcion}/${estado}`, {
      method: 'PUT',
      headers:{
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        idInscripcion: idInscripcion,
        valor: estado,
        justificacion: justificacion,
        correo: correo
      })
    });

    // Ocultar overlay
    overlayCarga.style.display = 'none';

    if (!response.ok) throw new Error('Error al actualizar estado');

    const resultado = await response.json();

    if (resultado.success) {
      modal.show(`Solicitud ${valor === 'Aprobada' ? 'aprobada' : 'rechazada'} correctamente`, () => {
        window.location.href = window.location.href;
      });
    } else {
      throw new Error(resultado.message || 'Error al actualizar');
    }

  } catch (error) {
    console.error('Error al responder solicitud:', error);
    overlayCarga.style.display = 'none';
    modal.show('No se pudo actualizar el estado de la solicitud.');
  }
};

export const validarCredenciales = async (cuenta, contrasena) => {
    try {
        const res = await fetch(`/api/admisiones/post/loginRevisor/index.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                username: cuenta,
                password: contrasena
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
