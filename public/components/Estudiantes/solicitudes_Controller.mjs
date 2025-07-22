const BASE_URL = '/api/estudiantes';

const limpiarOpciones = (select) => {
  while (select.firstChild) {
    select.removeChild(select.firstChild);
  }
};


/**
 *  Vista en General
 */
export const cargarSolicitudes = async (matricula) => {
  try {
    const response = await fetch(`${BASE_URL}/get/solicitudesRecientes?matricula=${matricula}`);
    //const data = await response.json();

    if (!response.ok) throw new Error('Error al obtener materias');
    return await response.json();
  } catch (error) {
    console.error('Error al cargar materias:', error);
    return [];
  }
};


/**
 * Cambio Carrera
 */
export const cargarCarreraSinActual = async (matricula, selectCarrera) => {
  try {
    const response = await fetch(`${BASE_URL}/get/carrerasSinActual/index.php?matricula=${matricula}`);
    const data = await response.json();

    limpiarOpciones(selectCarrera);
    selectCarrera.appendChild(new Option('Seleccionar carrera...', ''));

    data.forEach(item => {
      selectCarrera.appendChild(new Option(item.carrera_nombre, item.carrera_id));
    });

    selectCarrera.disabled = false;
  } catch (err) {
    console.error('Error al cargar las carreras:', err);
  }
};

export const guardarSolicitudCambioCarrera = async (datosJson) => {
  try {
    const response = await fetch(`${BASE_URL}/post/insertCambioCarrera/index.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(datosJson),
    });
    if (!response.ok) throw new Error('No se registrar su cambio de carrera');
    return await response.json();
  } catch (error) {
    console.error('Error al insertar cambio de carrera:', error);
    return null;
  }
};

/**
 * Cambio de Centro
 */
export const cargarCentroRegionalSinActual = async (matricula, selectCentros) => {
  try {
    const response = await fetch(`${BASE_URL}/get/centrosSinActual/index.php?matricula=${matricula}`);
    const data = await response.json();

    limpiarOpciones(selectCentros);
    selectCentros.appendChild(new Option('Seleccionar centro regional...', ''));

    data.forEach(item => {
      selectCentros.appendChild(new Option(item.centro_nombre, item.centro_regional_id));
    });

    selectCentros.disabled = false;
  } catch (err) {
    console.error('Error al cargar centros regionales:', err);
  }
};

export const guardarSolicitudCambioCentro = async (datosJson) => {
  try {
    const response = await fetch(`${BASE_URL}/post/insertCambioCentro/index.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(datosJson),
    });
    if (!response.ok) throw new Error('No se registrar su cambio de centro regional');
    return await response.json();
  } catch (error) {
    console.error('Error al insertar cambio de centro regional:', error);
    return null;
  }
};

/**
 * Pago de reposicion
 */
export const guardarSolicitudPagoRepo = async (datosJson) => {
  try {
    const response = await fetch(`${BASE_URL}/post/insertPagoReposicion/index.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(datosJson),
    });
    if (!response.ok) throw new Error('No se registrar su pago de reposicion');
    return await response.json();
  } catch (error) {
    console.error('Error al insertar pago de reposicion:', error);
    return null;
  }
};

/**
 * Cancelacion Excepcional
 */
export const cargarSeccionesCancelacion = async (datosSecciones, selectSecciones) => {
  try {
    limpiarOpciones(selectSecciones);
    selectSecciones.appendChild(new Option('Seleccionar seccion...', ''));

    datosSecciones.forEach(item => {
      selectSecciones.appendChild(new Option(`${item.codigo_clase} - ${item.codigo_seccion} - ${item.nombre_clase}`, item.seccion_id));
    });

    selectSecciones.disabled = false;
  } catch (err) {
    console.error('Error al cargar las secciones:', err);
  }
};

export const guardarSolicitudCancelacion = async (datosJson) => {
  try {
    const response = await fetch(`${BASE_URL}/post/insertCancelacionExcepcional/index.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(datosJson),
    });
    if (!response.ok) throw new Error('No se registrar su cancelacion excepcional');
    return await response.json();
  } catch (error) {
    console.error('Error al insertar cancelacion excepcional:', error);
    return null;
  }
};