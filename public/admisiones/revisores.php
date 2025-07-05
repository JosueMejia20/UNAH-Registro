<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisión de Admisiones - UNAH</title>
    <link rel="icon" href="https://lepidopterahonduras.wordpress.com/wp-content/uploads/2015/04/cropped-escudo-unah-22.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/../../assets/css/principal_components.css">
    <link rel="stylesheet" href="/../../assets/css/revisores_style.css">
</head>
<body>
    <pantalla-de-carga></pantalla-de-carga>
    <unah-navbar></unah-navbar>

    <!-- Contenido principal -->
    <header>
        <div class="container header-content">
            <img src="https://via.placeholder.com/200x50/FFFFFF/005F87?text=UNAH+Admisiones" alt="Logo UNAH" class="logo">
            <div class="user-info">
                <span>Bienvenido, Revisor</span>
                <div class="user-avatar">R</div>
            </div>
        </div>
    </header>

    <div class="container">
        <h1 class="main-title">Revisión de Solicitudes de Admisión</h1>

        <!-- Filtros -->
        <div class="filters">
            <div class="filter-group">
                <label for="filter-carrera">Carrera</label>
                <select id="filter-carrera">
                    <option value="">Todas las carreras</option>
                    <option value="medicina">Medicina</option>
                    <option value="derecho">Derecho</option>
                    <option value="ingenieria">Ingeniería</option>
                    <option value="administracion">Administración</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="filter-status">Estado</label>
                <select id="filter-status">
                    <option value="">Todos los estados</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="aprobado">Aprobado</option>
                    <option value="rechazado">Rechazado</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="filter-search">Buscar</label>
                <input type="text" id="filter-search" placeholder="Nombre o número de solicitud">
            </div>
            <div class="filter-group" style="align-self: flex-end;">
                <button class="btn btn-primary">Aplicar filtros</button>
            </div>
        </div>

        <!-- Tabla de solicitudes -->
        <table class="requests-table">
            <thead>
                <tr>
                    <th>N° Solicitud</th>
                    <th>Nombre del Estudiante</th>
                    <th>Carrera</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2023-001</td>
                    <td>Juan Pérez López</td>
                    <td>Medicina</td>
                    <td>15/05/2023</td>
                    <td class="status-pending">Pendiente</td>
                    <td>
                        <button class="action-btn btn-view">Ver</button>
                        <button class="action-btn btn-approve" onclick="showConfirmationModal('approve', '2023-001')">Aprobar</button>
                        <button class="action-btn btn-reject" onclick="showConfirmationModal('reject', '2023-001')">Rechazar</button>
                    </td>
                </tr>
                <tr>
                    <td>2023-002</td>
                    <td>María González Ramírez</td>
                    <td>Derecho</td>
                    <td>16/05/2023</td>
                    <td class="status-pending">Pendiente</td>
                    <td>
                        <button class="action-btn btn-view">Ver</button>
                        <button class="action-btn btn-approve" onclick="showConfirmationModal('approve', '2023-002')">Aprobar</button>
                        <button class="action-btn btn-reject" onclick="showConfirmationModal('reject', '2023-002')">Rechazar</button>
                    </td>
                </tr>
                <tr>
                    <td>2023-003</td>
                    <td>Carlos Martínez Flores</td>
                    <td>Ingeniería</td>
                    <td>17/05/2023</td>
                    <td class="status-approved">Aprobado</td>
                    <td>
                        <button class="action-btn btn-view">Ver</button>
                    </td>
                </tr>
                <tr>
                    <td>2023-004</td>
                    <td>Ana Rodríguez Sánchez</td>
                    <td>Administración</td>
                    <td>18/05/2023</td>
                    <td class="status-rejected">Rechazado</td>
                    <td>
                        <button class="action-btn btn-view">Ver</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal de confirmación -->
    <div class="modal" id="confirmationModal">
        <div class="modal-content">
            <h3 class="modal-title" id="modalTitle">Confirmar acción</h3>
            <div class="modal-body">
                <p id="modalMessage">¿Está seguro que desea aprobar la solicitud 2023-001?</p>
                <div id="rejectionReason" style="display: none;">
                    <div class="form-group">
                        <label for="reasonText">Razón de rechazo:</label>
                        <textarea id="reasonText" placeholder="Describa la razón por la cual rechaza esta solicitud..."></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" onclick="closeModal()">Cancelar</button>
                <button class="btn btn-primary" id="confirmActionBtn">Confirmar</button>
            </div>
        </div>
    </div>
    <unah-footer></unah-footer>

    <script src="/../../assets/js/revisores.js"></script>
    <script type="module" src="../../assets/js/main.js"></script>
</body>
</html>