const BASE_URL = '/api/admisiones';

document.addEventListener('DOMContentLoaded', async () => {
  document.getElementById('carrera-interes').disabled = true;
  document.getElementById('carrera-secundaria').disabled = true;

  await cargarEstadoCivil();
  await cargarDepartamentos();
  await cargarPaises();
  await cargarCentroRegional();

  // Cuando seleccionan un centro, carga las carreras
  document.getElementById('centro-regional').addEventListener('change', async (e) => {
    const centroId = e.target.value;
    if (centroId) {
      await cargarCarreras(centroId);
    }
  });

  // Cuando seleccionan carrera principal, filtra secundaria
  document.getElementById('carrera-interes').addEventListener('change', () => {
    filtrarCarreraSecundaria();
  });
});


/**
 * Cargar Estado Civil en el select correspondiente
 */
async function cargarEstadoCivil() {
  try {
    const response = await fetch(`${BASE_URL}/get/estadoCivil`);
    const data = await response.json();
    const select = document.getElementById('estado-civil');

    limpiarOpciones(select);
    select.appendChild(new Option('Seleccionar...', ''));

    data.forEach(item => {
      //console.log(item)
      select.appendChild(new Option(item.nombre_estado_civil, item.estado_civil_id));
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
    const response = await fetch(`${BASE_URL}/get/departamentoPais`);
    const data = await response.json();
    const select = document.getElementById('departamento');

    limpiarOpciones(select);
    select.appendChild(new Option('Seleccionar...', ''));

    data.forEach(item => {
      select.appendChild(new Option(item.nombre_departamento, item.departamento_id));
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
    const response = await fetch(`${BASE_URL}/get/pais`);
    const data = await response.json();
    const select = document.getElementById('pais-estudio');

    limpiarOpciones(select);
    select.appendChild(new Option('Seleccionar...', ''));

    data.forEach(item => {
      select.appendChild(new Option(item.nombre_pais, item.pais_id));
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
    const response = await fetch(`${BASE_URL}/get/centroRegional`);
    const data = await response.json();
    const select = document.getElementById('centro-regional');

    limpiarOpciones(select);
    select.appendChild(new Option('Seleccionar centro regional...', ''));

    data.forEach(item => {
      select.appendChild(new Option(item.nombre_centro, item.centro_regional_id));
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
    const response = await fetch(`${BASE_URL}/get/carrerasByCentro/${centroId}`);
    const data = await response.json();

    const selectPrimaria = document.getElementById('carrera-interes');
    const selectSecundaria = document.getElementById('carrera-secundaria');

    // Limpiar ambos selects
    limpiarOpciones(selectPrimaria);
    limpiarOpciones(selectSecundaria);

    // Opción por defecto
    selectPrimaria.appendChild(new Option('Seleccionar carrera...', ''));
    selectSecundaria.appendChild(new Option('Seleccionar carrera secundaria...', ''));

    // Llenar solo el select principal
    data.forEach(item => {
      const opt = new Option(item.nombre_carrera, item.carrera_id);
      selectPrimaria.appendChild(opt);
    });

    // Guardar las carreras globalmente para luego filtrar
    window.listaCarrerasActuales = data;

    // Habilitar ambos selects
    selectPrimaria.disabled = false;
    selectSecundaria.disabled = false;
  } catch (err) {
    console.error('Error al cargar carreras:', err);
  }
}

// Filtrar carrera secundaria para que no se repita la principal
function filtrarCarreraSecundaria() {
  const selectCarreraPrincipal = document.getElementById('carrera-interes');
  const selectCarreraSecundaria = document.getElementById('carrera-secundaria');
  const carreraSeleccionada = selectCarreraPrincipal.value;

  limpiarOpciones(selectCarreraSecundaria);
  selectCarreraSecundaria.appendChild(new Option('Seleccionar carrera secundaria...', ''));

  if (!Array.isArray(window.listaCarrerasActuales)) return;

  window.listaCarrerasActuales.forEach(item => {
    // Solo incluir si no es la carrera principal
    if (String(item.carrera_id) !== String(carreraSeleccionada)) {
      const opt = new Option(item.nombre_carrera, item.carrera_id);
      selectCarreraSecundaria.appendChild(opt);
    }
  });
}

// Función para limpiar un <select>
function limpiarOpciones(select) {
  while (select.firstChild) {
    select.removeChild(select.firstChild);
  }
}