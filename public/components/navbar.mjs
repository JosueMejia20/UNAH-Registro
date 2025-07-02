// Navbar azul 
import { call } from "../api/Utilities.mjs";

class UnahNavbar extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
        <!-- Navbar azul -->
        <nav class="navbar navbar-expand-lg navbar-unah fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="https://biologia.unah.edu.hn/dmsdocument/1433-unah-logo-texto" alt="UNAH">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="/">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Musica</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Biblioteca Virtual</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="admisionesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Sistema de Pregrado
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="admisionesDropdown">
                                <li><a class="dropdown-item" href="?page=login&rol=estudiante">Estudiantes</a></li>
                                <li><a class="dropdown-item" href="?page=login&rol=docente">Docentes</a></li>
                                <li><a class="dropdown-item" href="?page=login&rol=coordinador">Coordinador</a></li>
                                <li><a class="dropdown-item" href="?page=login&rol=JefeDeDepartamento">Jefe de Departamento</a></li>
                                <li><a class="dropdown-item" href="?page=login&rol=revisor">Revisores</a></li>
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
