const BASE_URL = '/api/Admisiones/index.php';

document.addEventListener('DOMContentLoaded', async () => {
  await cargarEstadoCivil();
  await cargarDepartamentos();
  await cargarPaises();
  await cargarCentroRegional();

  // Eventos dependientes
  document.getElementById('centro-regional').addEventListener('change', async (e) => {
    const centroId = e.target.value;
    await cargarCarreras(centroId);
  });

  document.getElementById('carrera-interes').addEventListener('change', () => {
    filtrarCarreraSecundaria();
  });
});

/**
 * Cargar Estado Civil en el select correspondiente
 */
async function cargarEstadoCivil() {
  try {
    const response = await fetch(`${BASE_URL}/estadoCivil`);
    const data = await response.json();
    const select = document.getElementById('estado-civil');

    limpiarOpciones(select);
    select.appendChild(new Option('Seleccionar...', ''));

    data.forEach(item => {
      select.appendChild(new Option(item.nombre_estado_civil, item.id_estado_civil));
    });
  } catch (err) {
    console.error('Error al cargar estado civil:', err);
  }
}

/**
 * Cargar Departamentos
 */
async function cargarDepartamentos() {
  try {
    const response = await fetch(`${BASE_URL}/departamentoPais`);
    const data = await response.json();
    const select = document.getElementById('departamento');

    limpiarOpciones(select);
    select.appendChild(new Option('Seleccionar...', ''));

    data.forEach(item => {
      select.appendChild(new Option(item.nombre_departamento, item.id_departamento));
    });
  } catch (err) {
    console.error('Error al cargar departamentos:', err);
  }
}

/**
 * Cargar Países
 */
async function cargarPaises() {
  try {
    const response = await fetch(`${BASE_URL}/pais`);
    const data = await response.json();
    const select = document.getElementById('pais-estudio');

    limpiarOpciones(select);
    select.appendChild(new Option('Seleccionar...', ''));

    data.forEach(item => {
      select.appendChild(new Option(item.nombre_pais, item.id_pais));
    });
  } catch (err) {
    console.error('Error al cargar países:', err);
  }
}

/**
 * Cargar Centros Regionales
 */
async function cargarCentroRegional() {
  try {
    const response = await fetch(`${BASE_URL}/centroRegional`);
    const data = await response.json();
    const select = document.getElementById('centro-regional');

    limpiarOpciones(select);
    select.appendChild(new Option('Seleccionar centro regional...', ''));

    data.forEach(item => {
      select.appendChild(new Option(item.nombre_centro, item.id_centro));
    });

    // Habilitar el select
    select.disabled = false;
  } catch (err) {
    console.error('Error al cargar centros regionales:', err);
  }
}

/**
 * Cargar Carreras según centro regional
 */
async function cargarCarreras(centroId) {
  try {
    const response = await fetch(`${BASE_URL}/carreras`);
    const data = await response.json();

    // Filtrar carreras por centro si aplica en tu backend
    const carreras = data.filter(item => item.id_centro === centroId || centroId === '');

    const selectPrimaria = document.getElementById('carrera-interes');
    const selectSecundaria = document.getElementById('carrera-secundaria');

    limpiarOpciones(selectPrimaria);
    limpiarOpciones(selectSecundaria);

    selectPrimaria.appendChild(new Option('Seleccionar carrera...', ''));
    selectSecundaria.appendChild(new Option('Seleccionar carrera...', ''));

    carreras.forEach(item => {
      const opt = new Option(item.nombre_carrera, item.id_carrera);
      selectPrimaria.appendChild(opt.cloneNode(true));
      selectSecundaria.appendChild(opt.cloneNode(true));
    });

    // Habilitar ambos
    selectPrimaria.disabled = false;
    selectSecundaria.disabled = false;

    // Aplicar filtro de carrera secundaria si ya hay una seleccionada
    filtrarCarreraSecundaria();
  } catch (err) {
    console.error('Error al cargar carreras:', err);
  }
}

/**
 * Evita que la carrera primaria se repita como secundaria
 */
function filtrarCarreraSecundaria() {
  const carreraPrimaria = document.getElementById('carrera-interes').value;
  const selectSecundaria = document.getElementById('carrera-secundaria');

  Array.from(selectSecundaria.options).forEach(opt => {
    opt.hidden = (opt.value !== '' && opt.value === carreraPrimaria);
  });

  // Si la secundaria está seleccionada igual que la primaria, la reseteamos
  if (selectSecundaria.value === carreraPrimaria) {
    selectSecundaria.value = '';
  }
}

/**
 * Elimina todas las opciones previas de un select
 */
function limpiarOpciones(selectElement) {
  while (selectElement.options.length > 0) {
    selectElement.remove(0);
  }
}
