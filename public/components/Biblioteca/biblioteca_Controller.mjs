const BASE_URL = '/api/biblioteca';

const limpiarOpciones = (select) => {
  while (select.firstChild) {
    select.removeChild(select.firstChild);
  }
};

/**
 *  Vista en General
 */
export const cargarTipoRecurso = async () => {
  try {
    const response = await fetch(`${BASE_URL}/get/tipoRecurso`);
    const data = await response.json();
    const select = document.getElementById('categoria');

    limpiarOpciones(select);
    select.appendChild(new Option('Seleccionar...', ''));

    console.log(data);
    data.forEach(item => {
      select.appendChild(new Option(item.nombre, item.id));
    });

    const selectEdit = document.getElementById('edit_categoria');

    limpiarOpciones(selectEdit);
    selectEdit.appendChild(new Option('Seleccionar...', ''));

    console.log(data);
    data.forEach(item => {
      selectEdit.appendChild(new Option(item.nombre, item.id));
    });
  } catch (err) {
    console.error('Error al cargar tipo recurso:', err);
  }
};

export const cargarClasesDocente = async (idDocente) => {
  try {
    const response = await fetch(`${BASE_URL}/get/clasesDocente/${idDocente}`);
    const data = await response.json();
    const select = document.getElementById('cursos');

    limpiarOpciones(select);
    select.appendChild(new Option('Seleccionar...', ''));

    console.log(data);
    data.forEach(item => {
      select.appendChild(new Option(item.nombre_clase, item.clase_id));
    });

    const selectEdit = document.getElementById('edit_cursos');

    limpiarOpciones(selectEdit);
    selectEdit.appendChild(new Option('Seleccionar...', ''));

    console.log(data);
    data.forEach(item => {
      selectEdit.appendChild(new Option(item.nombre_clase, item.clase_id));
    });
  } catch (err) {
    console.error('Error al cargar tipo recurso:', err);
  }
};

export const subirRecurso = async (datosJson) => {
  try {
    const response = await fetch(`${BASE_URL}/post/subirRecurso/index.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(datosJson),
    });
    if (!response.ok) throw new Error('No se registrar su recurso');
    return await response.json();
  } catch (error) {
    console.error('Error al insertar recurso:', error);
    return null;
  }
};

export const cargarRecursos = async () => {
  try {
    const response = await fetch(`${BASE_URL}/get/recursos`);
    return await response.json();

  } catch (err) {
    console.error('Error al cargar tipo recurso:', err);
  }
};

export const recursoDetalle = async (id) => {
  try {
    const response = await fetch(`${BASE_URL}/get/verRecurso/${id}`);
    return await response.json();

  } catch (err) {
    console.error('Error al cargar tipo recurso:', err);
  }

};

export const recursoPortadaArchivo = async (id) => {
  try {
    const response = await fetch(`${BASE_URL}/get/portadaArchivo/${id}`);
    return await response.json();

  } catch (err) {
    console.error('Error al cargar tipo recurso:', err);
  }

};

export const editarRecurso = async (datosJson) => {
  try {
    const response = await fetch(`${BASE_URL}/put/updateRecurso`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(datosJson),
    });
    if (!response.ok) throw new Error('No se pudo actualizar el recurso');
    return await response.json();
  } catch (error) {
    console.error('Error al actualizar recurso:', error);
    return null;
  }
};

export const eliminarRecurso = async (idRecurso) => {
    try {
        const response = await fetch(`${BASE_URL}/delete/eliminarRecurso/index.php`, {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ idRecurso: idRecurso})
        });
        return await response.json();
    } catch (error) {
        console.error('Error al cancelar:', error);
        return { success: false, mensaje: 'Error en la cancelación' };
    }
};

export const validarCredenciales = async (cuenta, contrasena) => {
    try {
        const res = await fetch(`${BASE_URL}/loginBiblioteca/index.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                username: cuenta,
                password: contrasena
            }),
        });

        if (!res.ok) throw new Error('Error de red');

        const data = await res.json();
        return data;
    } catch (error) {
        console.error('Error en login:', error);
        return { success: false, message: 'Error de conexión' };
    }
};

export const obtenerIdEstudiante = async (usuarioId) => {
  try {
    const response = await fetch(`${BASE_URL}/get/obtenerIdEstudiante/${usuarioId}`);
    return await response.json();

  } catch (err) {
    console.error('Error al cargar id de estudiante:', err);
  }
};

export const obtenerIdDocente = async (usuarioId) => {
  try {
    const response = await fetch(`${BASE_URL}/get/obtenerIdDocente/${usuarioId}`);
    return await response.json();

  } catch (err) {
    console.error('Error al cargar id de docente:', err);
  }
};


