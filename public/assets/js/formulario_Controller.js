const BASE_URL = '/api/admisiones';

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

    const select = document.getElementById('centro-regional');
    const valorSelect = select.value;


    const response = await fetch(`${BASE_URL}/get/carrerasByCentro/index.php/${valorSelect}`);
    const data = await response.json();

    console.log(data);
    console.log(response);

    const selectPrimaria = document.getElementById('carrera-interes');
    const selectSecundaria = document.getElementById('carrera-secundaria');

    limpiarOpciones(selectPrimaria);
    limpiarOpciones(selectSecundaria);

    selectPrimaria.appendChild(new Option('Seleccionar carrera...', ''));
    selectSecundaria.appendChild(new Option('Seleccionar carrera...', ''));

    data.forEach(item => {
      const opt = new Option(item.nombre_carrera, item.carrera_id);
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


// Filtrar carrera secundaria para que no se repita la principal
function filtrarCarreraSecundaria(listaCarreras) {
  const carreraPrincipalSeleccionada = selectCarreraPrincipal.value;

  limpiarOpciones(selectCarreraSecundaria);
  selectCarreraSecundaria.appendChild(new Option('Seleccionar carrera secundaria...', ''));

  listaCarreras.forEach(item => {
    if (item.carrera_id !== carreraPrincipalSeleccionada) {
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