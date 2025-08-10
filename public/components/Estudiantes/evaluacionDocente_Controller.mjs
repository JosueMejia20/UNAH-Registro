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

export const verificarEvaluacionExistente = async (idEstudiante, idSeccion) => {
  try {
    const response = await fetch(`${BASE_URL}/get/verificarEvaluacionExistente/index.php?idEstudiante=${idEstudiante}&idSeccion=${idSeccion}`);
    if (!response.ok) throw new Error('Error al obtener materias');
    return await response.json();
  } catch (error) {
    console.error('Error al cargar materias:', error);
    return [];
  }
};

export const obtenerNotaEstudiante = async (idEstudiante, idSeccion) => {
  try {
    const response = await fetch(`${BASE_URL}/get/obtenerNotaEstudianteSeccion/index.php?idEstudiante=${idEstudiante}&idSeccion=${idSeccion}`);
    if (!response.ok) throw new Error('Error al obtener materias');
    return await response.json();
  } catch (error) {
    console.error('Error al cargar materias:', error);
    return [];
  }
};


