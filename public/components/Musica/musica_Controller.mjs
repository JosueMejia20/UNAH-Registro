const BASE_URL = '/api/musica';

const limpiarOpciones = (select) => {
  while (select.firstChild) {
    select.removeChild(select.firstChild);
  }
};

export const validarCredenciales = async (cuenta, contrasena) => {
  try {
    const res = await fetch(`${BASE_URL}/loginMusica/index.php`, {
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

export const obtenerNombreUsuario = async (idUsuario) => {
  try {
    const response = await fetch(`/api/biblioteca/get/nombreUsuario/index.php/${idUsuario}`);
    if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);
    return await response.json();
  } catch (error) {
    console.error(`Error obteniendo ${tipo}:`, error);
    return [];
  }
};
