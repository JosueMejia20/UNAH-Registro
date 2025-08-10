const API_BASE = '/api/estudiantes';

// Obtener asignaturas según clasificación
export const obtenerDepartamentosPorClases = async (estudiante) => {
    try {
        const response = await fetch(`${API_BASE}/get/getDeptPorClaseCarrera/index.php?estudiante=${estudiante}`);
        if (!response.ok) throw new Error('Error al obtener asignaturas');
        return await response.json();
    } catch (error) {
        console.error('Error:', error);
        return [];
    }
};

export const obtenerDiasMatriculaEstudiante = async (idEstudiante) => {
    try {
        const response = await fetch(`${API_BASE}/get/diasMatricula/index.php?idEstudiante=${idEstudiante}`);
        if (!response.ok) throw new Error('Error al obtener asignaturas');
        return await response.json();
    } catch (error) {
        console.error('Error:', error);
        return [];
    }
};



export const obtenerAsignaturasPorDepartamento = async (estudiante,departamento) => {
    try {
        const response = await fetch(`${API_BASE}/get/getClasePorDeptEstudiante/index.php?estudiante=${estudiante}&departamento=${departamento}`);
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
        const response = await fetch(`${API_BASE}/get/getSeccionPeriodoActualPorClase/index.php?asignatura=${asignaturaId}`);
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
        const response = await fetch(`${API_BASE}/post/matricularSeccion/index.php`, {
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
export const obtenerSeccionesActuales = async (matricula) => {
    try {
        const response = await fetch(`${API_BASE}/get/materiasActuales/index.php?matricula=${matricula}`);
        if (!response.ok) throw new Error('Error al obtener materias');
        return await response.json();
  } catch (error) {
        console.error('Error al cargar materias:', error);
        return [];
  }
};

export const verificarConflictoHorario = async (idEstudiante, idSeccion) => {
    try {
        const response = await fetch(`${API_BASE}/get/verificarConflictoHorario/index.php?idEstudiante=${idEstudiante}&idSeccion=${idSeccion}`);
        if (!response.ok) throw new Error('Error al obtener materias');
        return await response.json();
  } catch (error) {
        console.error('Error al cargar materias:', error);
        return [];
  }
};



// Cancelar secciones seleccionadas
export const cancelarSecciones = async (idsSecciones, estudiante) => {
    try {
        const response = await fetch(`${API_BASE}/delete/cancelarSeccion/index.php`, {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ secciones: idsSecciones,
                estudiante: estudiante
             })
        });
        return await response.json();
    } catch (error) {
        console.error('Error al cancelar:', error);
        return { success: false, mensaje: 'Error en la cancelación' };
    }
};

//Obtener clases cursando y cursadas
export const obtenerClasesEstudiante = async (matricula) => {
    try {
        const response = await fetch(`${API_BASE}/get/clasesEstudiante/index.php?matricula=${matricula}`);
        if (!response.ok) throw new Error('Error al obtener materias');
        return await response.json();
  } catch (error) {
        console.error('Error al cargar materias:', error);
        return [];
  }
};
