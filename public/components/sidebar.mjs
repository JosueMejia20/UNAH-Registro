class UnahSidebar extends HTMLElement {
    connectedCallback() {
        // Obtener los elementos del menú desde el atributo
        const menu = JSON.parse(this.getAttribute("menu-items") || "[]");

        this.innerHTML = `
            <div class="sidebar d-flex flex-column flex-shrink-0 p-3">
                <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <img src="https://www.unah.edu.hn/themes/portalunah/assets/images/logo-unah.png" alt="UNAH Logo" style="height: 40px;">
                    <span class="fs-5 ms-2">Portal Estudiantil</span>
                </div>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    ${menu.map((item, i) => `
                        <li class="nav-item">
                            <a href="#" class="nav-link ${i === 0 ? 'active' : ''}" data-view="${item.view}">
                                ${item.label}
                            </a>
                        </li>
                    `).join("")}
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://via.placeholder.com/40" alt="Usuario" width="32" height="32" class="rounded-circle me-2">
                        <strong>Estudiante UNAH</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Configuración</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
        `;
    }
}

export { UnahSidebar };
