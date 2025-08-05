class UnahSidebar extends HTMLElement {
    connectedCallback() {
        const menu = JSON.parse(this.getAttribute("menu-items") || "[]");

        // Obtener la página actual desde la URL
        const currentPage = window.location.pathname.split('/').pop();

        this.innerHTML = `
            <div class="sidebar d-flex flex-column flex-shrink-0">
                <div class="d-flex align-items-center mb-4 text-white text-decoration-none">
                    <span class="fs-5 ms-2">Portal Estudiantil</span>
                </div>
                <ul class="nav nav-pills flex-column mb-auto">
                    ${menu.map(item => {
                        const isActive = item.href === currentPage ? 'active' : '';
                        return `
                            <li class="nav-item">
                                <a href="${item.href}" class="nav-link ${isActive}">
                                    ${item.label}
                                </a>
                            </li>
                        `;
                    }).join("")}
                </ul>
                <div class="dropdown mt-auto">
                    <div class="d-flex align-items-center text-white text-decoration-none" id="dropdownUser1">
                        <strong>Estudiante UNAH</strong>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../../../index.php" id="cerrarSesionBtn">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
        `;
    }
}

export { UnahSidebar };
