const API_BASE = '/api/estudiantes/matricula';

// Obtener asignaturas según clasificación
export const obtenerAsignaturasPorClasificacion = async (clasificacion) => {
    try {
        const response = await fetch(`${API_BASE}/asignaturas?clasificacion=${encodeURIComponent(clasificacion)}`);
        if (!response.ok) throw new Error('Error al obtener asignaturas');
        return await response.json();
    } catch (error) {
        console.error('Error:', error);
        return [];
    }
};

// Obtener horarios por asignatura
export const obtenerHorariosPorAsignatura = async (asignaturaId) => {
    try {
        const response = await fetch(`${API_BASE}/horarios?asignatura=${encodeURIComponent(asignaturaId)}`);
        if (!response.ok) throw new Error('Error al obtener horarios');
        return await response.json();
    } catch (error) {
        console.error('Error:', error);
        return [];
    }
};

// Matricular estudiante
export const matricularSeccion = async (datosMatricula) => {
    try {
        const response = await fetch(`${API_BASE}/matricular`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(datosMatricula)
        });
        return await response.json();
    } catch (error) {
        console.error('Error al matricular:', error);
        return { success: false, mensaje: 'Error en la solicitud' };
    }
};

// Obtener secciones actuales del estudiante
export const obtenerSeccionesActuales = async () => {
    try {
        const response = await fetch(`${API_BASE}/secciones`);
        if (!response.ok) throw new Error('Error al obtener secciones actuales');
        return await response.json();
    } catch (error) {
        console.error('Error:', error);
        return [];
    }
};

// Cancelar secciones seleccionadas
export const cancelarSecciones = async (idsSecciones) => {
    try {
        const response = await fetch(`${API_BASE}/cancelar`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ secciones: idsSecciones })
        });
        return await response.json();
    } catch (error) {
        console.error('Error al cancelar:', error);
        return { success: false, mensaje: 'Error en la cancelación' };
    }
};
