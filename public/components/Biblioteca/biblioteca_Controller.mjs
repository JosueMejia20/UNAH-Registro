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


