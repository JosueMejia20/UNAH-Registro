const BASE_URL = '/api/admisiones';
let listaCarrerasActuales = [];

// Limpiar opciones de un <select>
const limpiarOpciones = (select) => {
  while (select.firstChild) {
    select.removeChild(select.firstChild);
  }
};

// Cargar estado civil
export const cargarEstadoCivil = async () => {
  try {
    const response = await fetch(`${BASE_URL}/get/estadoCivil`);
    const data = await response.json();
    const select = document.getElementById('estado-civil');

    limpiarOpciones(select);
    select.appendChild(new Option('Seleccionar...', ''));

    data.forEach(item => {
      select.appendChild(new Option(item.nombre_estado_civil, item.estado_civil_id));
    });
  } catch (err) {
    console.error('Error al cargar estado civil:', err);
  }
};

// Cargar departamentos
export const cargarDepartamentos = async () => {
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
};

// Cargar países
export const cargarPaises = async () => {
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
};

// Cargar centros regionales
export const cargarCentroRegional = async () => {
  try {
    const response = await fetch(`${BASE_URL}/get/centroRegional`);
    const data = await response.json();
    const select = document.getElementById('centro-regional');

    limpiarOpciones(select);
    select.appendChild(new Option('Seleccionar centro regional...', ''));

    data.forEach(item => {
      select.appendChild(new Option(item.nombre_centro, item.centro_regional_id));
    });

    select.disabled = false;
  } catch (err) {
    console.error('Error al cargar centros regionales:', err);
  }
};

// Cargar carreras por centro regional
export const cargarCarreras = async (centroId) => {
  try {
    const response = await fetch(`${BASE_URL}/get/carrerasByCentro/${centroId}`);
    const data = await response.json();

    const selectPrimaria = document.getElementById('carrera-interes');
    const selectSecundaria = document.getElementById('carrera-secundaria');

    limpiarOpciones(selectPrimaria);
    limpiarOpciones(selectSecundaria);

    selectPrimaria.appendChild(new Option('Seleccionar carrera...', ''));
    selectSecundaria.appendChild(new Option('Seleccionar carrera secundaria...', ''));

    data.forEach(item => {
      selectPrimaria.appendChild(new Option(item.nombre_carrera, item.carrera_id));
    });

    listaCarrerasActuales = data;

    selectPrimaria.disabled = false;
    selectSecundaria.disabled = false;
  } catch (err) {
    console.error('Error al cargar carreras:', err);
  }
};

// Filtrar carrera secundaria para no repetir la principal
export const filtrarCarreraSecundaria = () => {
  const selectCarreraPrincipal = document.getElementById('carrera-interes');
  const selectCarreraSecundaria = document.getElementById('carrera-secundaria');
  const carreraSeleccionada = selectCarreraPrincipal.value;

  limpiarOpciones(selectCarreraSecundaria);
  selectCarreraSecundaria.appendChild(new Option('Seleccionar carrera secundaria...', ''));

  listaCarrerasActuales.forEach(item => {
    if (String(item.carrera_id) !== String(carreraSeleccionada)) {
      selectCarreraSecundaria.appendChild(new Option(item.nombre_carrera, item.carrera_id));
    }
  });
};
