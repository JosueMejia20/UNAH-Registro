// revisoresController.mjs
const BASE_URL = '/api/admisiones';
let solicitudesGlobal = []; // Almacenamos todas las solicitudes
export let currentPage = 1;
export const itemsPerPage = 5; // Puedes cambiar este número

// Obtener todas las solicitudes y renderizar la tabla + paginación
export const cargarSolicitudesPaginadas = async (idRevisor) => {
  try {
    const response = await fetch(`${BASE_URL}/get/solicitudesByRevisor/${idRevisor}`);
    solicitudesGlobal = await response.json();
    currentPage = 1;

    renderTablaPagina(currentPage);
    actualizarPaginacion();
    
    // Actualizar contador total
    const contador = document.getElementById('pendingCount');
    if (contador) contador.textContent = solicitudesGlobal.length;

  } catch (error) {
    console.error('Error al cargar solicitudes:', error);
  }
};

// Renderizar tabla solo con las solicitudes visibles en la página actual
export const renderTablaPagina = (pageNumber) => {
  const tabla = document.getElementById('requestsTableBody');
  tabla.innerHTML = '';

  const startIndex = (pageNumber - 1) * itemsPerPage;
  const endIndex = Math.min(startIndex + itemsPerPage, solicitudesGlobal.length);

  for (let i = startIndex; i < endIndex; i++) {
    const soli = solicitudesGlobal[i];
    const fila = document.createElement('tr');

    fila.innerHTML = `
      <td>${soli.inscripcion_id}</td>
        <td>${soli.nombre_postulante}</td>
        <td>${soli.carrera_primaria}</td>
        <td>${soli.fecha_inscripcion}</td>
        <td><span class="badge bg-warning text-dark">${soli.estado_revision}</span></td>
        <td>
          <button class="btn btn-outline-primary btn-sm me-1" onclick="verDetalles(${soli.inscripcion_id})">
            <i class="bi bi-eye"></i> Ver
          </button>
        </td>

    `;

    tabla.appendChild(fila);
  }
  
};


//Creacion botones de la paginacion
export const actualizarPaginacion = () => {
  const pagination = document.getElementById('pagination');
  pagination.innerHTML = ''; // Limpiar paginación

  const totalPages = Math.ceil(solicitudesGlobal.length / itemsPerPage);

  if (totalPages <= 1) return; // No mostrar paginación si solo hay una página

  // Botón anterior
  const prevBtn = document.createElement('button');
  prevBtn.textContent = '«';
  prevBtn.className = 'btn btn-outline-primary btn-sm me-1';
  prevBtn.disabled = currentPage === 1;
  prevBtn.addEventListener('click', () => {
    if (currentPage > 1) {
      currentPage--;
      renderTablaPagina(currentPage);
      actualizarPaginacion();
    }
  });
  pagination.appendChild(prevBtn);

  // Botones de número
  for (let i = 1; i <= totalPages; i++) {
    const pageBtn = document.createElement('button');
    pageBtn.textContent = i;
    pageBtn.className = `btn btn-sm ${i === currentPage ? 'btn-primary' : 'btn-outline-primary'} me-1`;
    pageBtn.addEventListener('click', () => {
      currentPage = i;
      renderTablaPagina(currentPage);
      actualizarPaginacion();
    });
    pagination.appendChild(pageBtn);
  }

  // Botón siguiente
  const nextBtn = document.createElement('button');
  nextBtn.textContent = '»';
  nextBtn.className = 'btn btn-outline-primary btn-sm';
  nextBtn.disabled = currentPage === totalPages;
  nextBtn.addEventListener('click', () => {
    if (currentPage < totalPages) {
      currentPage++;
      renderTablaPagina(currentPage);
      actualizarPaginacion();
    }
  });
  pagination.appendChild(nextBtn);
};

//Ver Detalles
export const verDetalles = async (inscripcion_id) => {
  try {
    const response = await fetch(`/api/Admisiones/get/solicitudDetalle/${inscripcion_id}`);
    if (!response.ok) throw new Error('No se pudo obtener la solicitud');

    const datos = await response.json();

    // Llenar modal
    document.getElementById('modalRequestId').textContent = datos.inscripcion_id;
    document.getElementById('studentName').textContent = datos.nombre_postulante;
    document.getElementById('studentCareer').textContent = datos.carrera_primaria;
    document.getElementById('requestDate').textContent = datos.fecha_inscripcion;
    document.getElementById('requestStatus').textContent = datos.estado_revision;

    // Documento (si hay)
    const documentImg = document.getElementById('documentImage');
    documentImg.src = datos.documento_adjunto
      ? datos.documento_adjunto
      : 'https://via.placeholder.com/300x400?text=Sin+Documento';

    // Mostrar modal
    document.getElementById('requestModal').style.display = 'block';

    // Ocultar sección de rechazo por defecto
    document.getElementById('reasonText').value = '';
    document.getElementById('rejectionReason').style.display = 'none';
    document.getElementById('confirmRejectBtn').style.display = 'none';

    // Guardar ID global para usar en aprobación/rechazo
    window.idSolicitudActual = datos.inscripcion_id;

  } catch (error) {
    console.error('Error al cargar detalles:', error);
    alert('Ocurrió un error al mostrar los detalles de la solicitud.');
  }
};

export const responderSolicitud = async (estado) => {
  try {
    const id = window.idSolicitudActual;

    // Convertimos estado de texto a valor numérico esperado por el backend
    const valor = estado === 'Aprobada' ? 1 : 2; // Puedes cambiar esto si usas otros valores

    const response = await fetch(`/api/Admisiones/cambiarEstado/${id}/${valor}`, {
      method: 'PUT'
    });

    if (!response.ok) throw new Error('Error al actualizar estado');

    const resultado = await response.json();

    if (resultado.success) {
      alert(`Solicitud ${estado === 'Aprobada' ? 'aprobada' : 'rechazada'} correctamente`);
      document.getElementById('requestModal').style.display = 'none';

      const idRevisor = parseInt(localStorage.getItem('idRevisor'));
      await cargarSolicitudesPaginadas(idRevisor);
    } else {
      throw new Error(resultado.message || 'Error al actualizar');
    }

  } catch (error) {
    console.error('Error al responder solicitud:', error);
    alert('No se pudo actualizar el estado de la solicitud.');
  }
};

