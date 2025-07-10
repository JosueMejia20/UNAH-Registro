import { obtenerSolicitudesPorRevisor } from '../../revisores_controller.mjs';

export const initRevisores = async () => {
  let currentPage = 1;
  const itemsPerPage = 5;
  let solicitudes = [];
  let currentRequestId = '';
  const idRevisor = 1; // dinámicamente con sesión

  const tbody = document.getElementById('requests-body');
  const pagination = document.getElementById('pagination');
  const pendingCount = document.getElementById('pending-count');

  solicitudes = await obtenerSolicitudesPorRevisor(idRevisor);
  renderTable();
  updatePagination();
  updatePendingCount();

  function renderTable() {
    tbody.innerHTML = '';
    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const pageItems = solicitudes.slice(start, end);

    for (const request of pageItems) {
      const tr = document.createElement('tr');
      const statusClass = {
        Aprobado: 'status-approved',
        Rechazado: 'status-rejected',
        Pendiente: 'status-pending'
      }[request.status] || '';

      tr.innerHTML = `
        <td>${request.id}</td>
        <td>${request.name}</td>
        <td>${request.career}</td>
        <td>${request.date}</td>
        <td class="${statusClass}">${request.status}</td>
        <td><button class="action-btn btn-view" data-id="${request.id}">Ver</button></td>
      `;
      tbody.appendChild(tr);
    }

    tbody.querySelectorAll('.btn-view').forEach(btn => {
      btn.addEventListener('click', () => showDetailsModal(btn.dataset.id));
    });
  }

  function updatePagination() {
    pagination.innerHTML = '';
    const totalPages = Math.ceil(solicitudes.length / itemsPerPage);

    const createBtn = (text, page) => {
      const btn = document.createElement('button');
      btn.className = `page-btn${page === currentPage ? ' active' : ''}`;
      btn.textContent = text;
      btn.disabled = page === currentPage;
      btn.addEventListener('click', () => {
        currentPage = page;
        renderTable();
        updatePagination();
      });
      return btn;
    };

    if (currentPage > 1) pagination.appendChild(createBtn('Anterior', currentPage - 1));
    for (let i = 1; i <= totalPages; i++) pagination.appendChild(createBtn(i, i));
    if (currentPage < totalPages) pagination.appendChild(createBtn('Siguiente', currentPage + 1));
  }

  function updatePendingCount() {
    const count = solicitudes.filter(r => r.status === 'Pendiente').length;
    pendingCount.textContent = count;
  }

  function showDetailsModal(id) {
    currentRequestId = id;
    const request = solicitudes.find(r => r.id == id);
    if (!request) return;

    document.getElementById('modal-request-id').textContent = request.id;
    document.getElementById('info-name').textContent = request.name;
    document.getElementById('info-career').textContent = request.career;
    document.getElementById('info-date').textContent = request.date;
    document.getElementById('info-email').textContent = request.email;
    document.getElementById('info-phone').textContent = request.phone;
    document.getElementById('info-notes').textContent = request.notes;
    document.getElementById('request-document').src = request.document;

    const status = document.getElementById('info-status');
    status.textContent = request.status;
    status.className = '';
    status.classList.add(
      request.status === 'Aprobado' ? 'status-approved' :
      request.status === 'Rechazado' ? 'status-rejected' :
      'status-pending'
    );

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

    approveBtn.onclick = () => {
      if (confirm(`¿Aprobar solicitud ${id}?`)) {
        request.status = 'Aprobado';
        renderTable();
        updatePendingCount();
        closeModal();
        alert('Solicitud aprobada');
      }
    };

    rejectBtn.onclick = () => {
      rejectionSection.style.display = 'block';

      const confirmBtn = document.createElement('button');
      confirmBtn.className = 'btn btn-reject';
      confirmBtn.textContent = 'Confirmar Rechazo';
      confirmBtn.onclick = () => {
        const reason = document.getElementById('reasonText').value.trim();
        if (!reason) return alert('Ingrese la razón del rechazo');
        if (confirm(`¿Rechazar solicitud ${id}?`)) {
          request.status = 'Rechazado';
          request.notes = `Rechazado: ${reason}`;
          renderTable();
          updatePendingCount();
          closeModal();
          alert('Solicitud rechazada');
        }
      };

      const modalFooter = document.querySelector('.modal-footer');
      modalFooter.insertBefore(confirmBtn, rejectBtn);
      approveBtn.style.display = 'none';
      rejectBtn.style.display = 'none';
    };
  }

  function closeModal() {
    document.getElementById('detailsModal').style.display = 'none';
    document.getElementById('rejection-section').style.display = 'none';
    document.getElementById('reasonText').value = '';
  }

  document.getElementById('logout-btn').addEventListener('click', () => {
    // Puedes añadir lógica de logout real aquí
    alert('Sesión cerrada');
  });

  // Cerrar modal
  window.closeModal = closeModal;
};