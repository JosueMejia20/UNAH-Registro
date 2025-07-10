import {
    obtenerSolicitudes,
    obtenerSolicitudPorId,
    aprobarSolicitud,
    rechazarSolicitud
  } from './revisoresController.mjs';
  
  let currentPage = 1;
  const itemsPerPage = 5;
  let solicitudes = [];
  let currentRequestId = null;
  
  // Cargar solicitudes y renderizar tabla
  async function loadRequests() {
    solicitudes = await obtenerSolicitudes();
    renderTable();
    updatePagination();
    updatePendingCount();
  }
  
  // Renderizar tabla de solicitudes
  function renderTable() {
    const tbody = document.getElementById('requests-body');
    tbody.innerHTML = '';
  
    const startIndex = (currentPage - 1) * itemsPerPage;
    const paginatedData = solicitudes.slice(startIndex, startIndex + itemsPerPage);
  
    paginatedData.forEach(request => {
      const row = document.createElement('tr');
  
      row.innerHTML = `
        <td>${request.id}</td>
        <td>${request.name}</td>
        <td>${request.career}</td>
        <td>${request.date}</td>
        <td><span class="status-label ${request.status.toLowerCase()}">${request.status}</span></td>
        <td><button class="btn btn-sm btn-primary" onclick="showDetailsModal(${request.id})">Ver</button></td>
      `;
  
      tbody.appendChild(row);
    });
  }
  
  // Actualizar contador de solicitudes pendientes
  function updatePendingCount() {
    const count = solicitudes.filter(r => r.status === 'Pendiente').length;
    document.getElementById('pending-count').textContent = count;
  }
  
  // Actualizar paginación
  function updatePagination() {
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';
  
    const totalPages = Math.ceil(solicitudes.length / itemsPerPage);
  
    const prevBtn = document.createElement('button');
    prevBtn.className = 'page-btn';
    prevBtn.textContent = 'Anterior';
    prevBtn.disabled = currentPage === 1;
    prevBtn.addEventListener('click', () => {
      currentPage--;
      renderTable();
      updatePagination();
    });
    pagination.appendChild(prevBtn);
  
    for (let i = 1; i <= totalPages; i++) {
      const pageBtn = document.createElement('button');
      pageBtn.className = `page-btn ${i === currentPage ? 'active' : ''}`;
      pageBtn.textContent = i;
      pageBtn.addEventListener('click', () => {
        currentPage = i;
        renderTable();
        updatePagination();
      });
      pagination.appendChild(pageBtn);
    }
  
    const nextBtn = document.createElement('button');
    nextBtn.className = 'page-btn';
    nextBtn.textContent = 'Siguiente';
    nextBtn.disabled = currentPage === totalPages;
    nextBtn.addEventListener('click', () => {
      currentPage++;
      renderTable();
      updatePagination();
    });
    pagination.appendChild(nextBtn);
  }
  
  // Mostrar modal de detalles
  window.showDetailsModal = async function(requestId) {
    currentRequestId = requestId;
    const request = await obtenerSolicitudPorId(requestId);
    if (!request) return;
  
    document.getElementById('modal-request-id').textContent = request.id;
    document.getElementById('info-name').textContent = request.name;
    document.getElementById('info-career').textContent = request.career;
    document.getElementById('info-date').textContent = request.date;
    document.getElementById('info-email').textContent = request.email;
    document.getElementById('info-phone').textContent = request.phone;
    document.getElementById('info-notes').textContent = request.notes || 'Ninguna';
    document.getElementById('request-document').src = request.document;
  
    const statusElement = document.getElementById('info-status');
    statusElement.textContent = request.status;
    statusElement.className = '';
  
    if (request.status === 'Aprobado') statusElement.classList.add('status-approved');
    else if (request.status === 'Rechazado') statusElement.classList.add('status-rejected');
    else statusElement.classList.add('status-pending');
  
    const approveBtn = document.getElementById('approve-btn');
    const rejectBtn = document.getElementById('reject-btn');
    const rejectionSection = document.getElementById('rejection-section');
  
    if (request.status === 'Pendiente') {
      approveBtn.style.display = 'inline-block';
      rejectBtn.style.display = 'inline-block';
      rejectionSection.style.display = 'none';
    } else {
      approveBtn.style.display = 'none';
      rejectBtn.style.display = 'none';
      rejectionSection.style.display = 'none';
    }
  
    document.getElementById('detailsModal').style.display = 'flex';
  }
  
  // Cerrar modal
  window.closeModal = function () {
    document.getElementById('detailsModal').style.display = 'none';
    document.getElementById('rejection-section').style.display = 'none';
    document.getElementById('reasonText').value = '';
  
    const existingBtn = document.querySelector('#confirm-reject-btn');
    if (existingBtn) existingBtn.remove();
  }
  
  // Aprobar solicitud
  document.getElementById('approve-btn').addEventListener('click', async () => {
    if (confirm(`¿Está seguro que desea aprobar la solicitud ${currentRequestId}?`)) {
      const result = await aprobarSolicitud(currentRequestId);
      if (result?.success) {
        await loadRequests();
        closeModal();
        alert('Solicitud aprobada exitosamente');
      } else {
        alert('Error al aprobar la solicitud');
      }
    }
  });
  
  // Rechazar solicitud
  document.getElementById('reject-btn').addEventListener('click', () => {
    const rejectionSection = document.getElementById('rejection-section');
    rejectionSection.style.display = 'block';
  
    const existingBtn = document.querySelector('#confirm-reject-btn');
    if (existingBtn) return;
  
    const confirmRejectBtn = document.createElement('button');
    confirmRejectBtn.id = 'confirm-reject-btn';
    confirmRejectBtn.className = 'btn btn-reject';
    confirmRejectBtn.textContent = 'Confirmar Rechazo';
    confirmRejectBtn.style.marginLeft = '10px';
  
    confirmRejectBtn.addEventListener('click', async () => {
      const reason = document.getElementById('reasonText').value.trim();
      if (!reason) {
        alert('Por favor ingrese la razón del rechazo.');
        return;
      }
  
      if (confirm(`¿Está seguro que desea rechazar la solicitud ${currentRequestId}?`)) {
        const result = await rechazarSolicitud(currentRequestId, reason);
        if (result?.success) {
          await loadRequests();
          closeModal();
          alert('Solicitud rechazada exitosamente');
        } else {
          alert('Error al rechazar la solicitud');
        }
      }
    });
  
    const modalFooter = document.querySelector('.modal-footer');
    modalFooter.insertBefore(confirmRejectBtn, document.getElementById('reject-btn'));
    document.getElementById('approve-btn').style.display = 'none';
    document.getElementById('reject-btn').style.display = 'none';
  });
  
  // Cargar datos al iniciar
  window.addEventListener('DOMContentLoaded', loadRequests);
  