// Navbar azul 

class UnahNavbar extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
        <!-- Navbar azul -->
        <nav class="navbar navbar-expand-lg navbar-unah fixed-top">
            <div class="container">
                <a class="navbar-brand" href="../index.php">
                    <img src="https://biologia.unah.edu.hn/dmsdocument/1433-unah-logo-texto" alt="UNAH">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="../index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../musica/index.php?vista=musica">Musica</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../biblioteca/index.php?vista=login_biblioteca">Biblioteca Virtual</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="admisionesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Sistema de Pregrado
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="admisionesDropdown">
                                <li><a class="dropdown-item" href="../estudiantes/index.php?vista=login_estudiantes">Estudiantes</a></li>
                                <li><a class="dropdown-item" href="../docentes/index.php?vista=loginDocente">Docentes</a></li>
                                <li><a class="dropdown-item" href="../coordinador/index.php?vista=perfil_coordinador">Coordinador</a></li>
                                <li><a class="dropdown-item" href="../jefe/index.php?vista=perfil_jefe">Jefe de Departamento</a></li>
                                <li><a class="dropdown-item" href="../admisiones/index.php?vista=login_revisores">Revisores</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <!-- Botones opcionales -->
                    </div>
                </div>
            </div>
        </nav>
        `;
    }
}

// customElements.define('unah-navbar', UnahNavbar);

export{
    UnahNavbar
}
