const BASE_URL = '/api/estudiantes';

/**
 *  Vista en General
 */
export const cargarContactos = async (matricula) => {
  try {
    const response = await fetch(`${BASE_URL}/get/contactos/index.php?matricula=${matricula}`);
    //const data = await response.json();

    if (!response.ok) throw new Error('Error al obtener contactos');
    return await response.json();
  } catch (error) {
    console.error('Error al cargar contactos:', error);
    return [];
  }
};


export const cargarMensajes = async (idEstudiante, contactoId) => {
  try {
    //const response = await fetch(`${BASE_URL}/get/contactos?matricula=${matricula}`);
    const response = await fetch(`${BASE_URL}/get/mensajes/index.php?estudiante_id=${idEstudiante}&contacto_id=${contactoId}`);
    //const data = await response.json();

    if (!response.ok) throw new Error('Error al obtener contactos');
    return await response.json();
  } catch (error) {
    console.error('Error al cargar contactos:', error);
    return [];
  }
};

export const cargarSolicitudesContacto = async(idEstudiante)=>{
    try {
    //const response = await fetch(`${BASE_URL}/get/contactos?matricula=${matricula}`);
    const response = await fetch(`${BASE_URL}/get/solicitudesContacto/index.php?idEstudiante=${idEstudiante}`);
    //const data = await response.json();

    if (!response.ok) throw new Error('Error al obtener contactos');
    return await response.json();
  } catch (error) {
    console.error('Error al cargar contactos:', error);
    return [];
  }
}

export const aceptarSolicitudContacto = async(idSolicitud)=>{
    try {
    const response = await fetch(`${BASE_URL}/put/aceptarSolicitudContacto/index.php`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        "idSolicitud": idSolicitud
      }),
    });
    if (!response.ok) throw new Error('No se aceptar la solicitud');
    return await response.json();
  } catch (error) {
    console.error('Error al aceptar la solicitud:', error);
    return null;
  }
}

export const rechazarSolicitudContacto = async(idSolicitud)=>{
    try {
    const response = await fetch(`${BASE_URL}/put/rechazarSolicitudContacto/index.php`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        "idSolicitud": idSolicitud
      }),
    });
    if (!response.ok) throw new Error('No se rechazo la solicitud');
    return await response.json();
  } catch (error) {
    console.error('Error al rechazar la solicitud:', error);
    return null;
  }
}

export const insertMensaje = async (mensaje, idEstudiante, idContacto) =>{
    try {
    const response = await fetch(`${BASE_URL}/post/enviarMensaje/index.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        "mensaje": mensaje,
        "emisor_id": idEstudiante,
        "receptor_id": idContacto
      }),
    });
    if (!response.ok) throw new Error('No se rechazo la solicitud');
    return await response.json();
  } catch (error) {
    console.error('Error al rechazar la solicitud:', error);
    return null;
  }
}

export const enviarSolicitudContacto = async (datosJson) => {
  try {
    const response = await fetch(`${BASE_URL}/post/insertSolicitudContacto/index.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(datosJson),
    });
    if (!response.ok) throw new Error('No se pudo enviar la solicitud de contacto');
    return await response.json();
  } catch (error) {
    console.error('Error al enviar solicitud de contacto:', error);
    return null;
  }
};




