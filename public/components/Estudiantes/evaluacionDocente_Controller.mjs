const BASE_URL = '/api/estudiantes';

export const subirEvaluacion = async (datosJson) => {
    try {
        const response = await fetch(`${BASE_URL}/post/evaluacionDocente/index.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(datosJson)
        });
        return await response.json();
    } catch (error) {
        console.error('Error al insertar en evaluacion docente:', error);
        return { success: false, mensaje: 'Error en la solicitud' };
    }
};
