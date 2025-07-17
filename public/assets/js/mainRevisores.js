const BASE_URL = '/api/admisiones';
import { UnahNavbar } from "/../../components/navbar.mjs";
customElements.define("unah-navbar", UnahNavbar);

import { UnahFooter } from "../../components/footer.mjs";
customElements.define("unah-footer", UnahFooter);

import { Cargando, loadingEvent } from "../../components/loading.mjs";
customElements.define("pantalla-de-carga", Cargando);
loadingEvent();

// assets/js/mainRevisores.js
import {
    obtenerSolicitudesPorRevisor,
    obtenerDetalleSolicitud,
    aprobarSolicitud,
    rechazarSolicitud,
    validarCredenciales 
} from '../../components/Admisiones/revisores_controller.mjs';

const idRevisor = localStorage.getItem('idRevisor');
let solicitudes = [];
let indexActual = 0;

const renderizarSolicitud = async () => {
    const contenedor = document.getElementById('card-body');
    if (indexActual >= solicitudes.length) {
        contenedor.innerHTML = '<p class="text-center my-5">No hay más solicitudes.</p>';
        return;
    }

    const solicitud = solicitudes[indexActual];
    const detalle = await obtenerDetalleSolicitud(solicitud.inscripcion_id);

    if (!detalle) return;

    // Aquí puedes recorrer todos los campos del HTML y llenar con `detalle`
    document.querySelector('.card-header span').innerHTML = `<i class="bi bi-file-earmark-text"></i> Solicitud #${detalle.codigo}`;
    document.querySelector('.status-badge').textContent = "Pendiente de revisión";

    document.querySelector('#pendingCount').textContent = solicitudes.length - indexActual;

    // Ejemplo de llenado dinámico
    document.querySelector('.solicitud-info p:nth-of-type(1)').textContent = detalle.nombre_completo;
    document.querySelector('.solicitud-info p:nth-of-type(2)').textContent = detalle.identidad;
    document.querySelector('.solicitud-info p:nth-of-type(3)').textContent = detalle.fecha_nacimiento;
    // ... Y así sucesivamente con el resto
};

const siguienteSolicitud = () => {
    indexActual++;
    renderizarSolicitud();
};

const manejarAprobacion = async () => {
    const solicitud = solicitudes[indexActual];
    await aprobarSolicitud(solicitud.inscripcion_id);
    siguienteSolicitud();
};

const manejarRechazo = async () => {
    const solicitud = solicitudes[indexActual];
    const razon = prompt("Ingrese la razón del rechazo:");
    if (!razon) return alert("Debe ingresar una razón.");
    await rechazarSolicitud(solicitud.inscripcion_id, razon);
    siguienteSolicitud();
};

document.addEventListener('DOMContentLoaded', async () => {
    solicitudes = await obtenerSolicitudesPorRevisor(idRevisor);
    renderizarSolicitud();

    document.getElementById('acceptBtn').addEventListener('click', manejarAprobacion);
    document.getElementById('rejectBtn').addEventListener('click', manejarRechazo);
});

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');
    const btnLogin = form.querySelector('.btn-login');
    const spinner = form.querySelector('.spinner-border');
    const btnText = form.querySelector('.btn-text');
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    // Mostrar u ocultar contraseña
    togglePassword.addEventListener('click', () => {
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;
        togglePassword.innerHTML = type === 'password'
            ? '<i class="bi bi-eye-fill"></i>'
            : '<i class="bi bi-eye-slash-fill"></i>';
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Validación del formulario Bootstrap
        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        // Activar spinner
        btnLogin.disabled = true;
        spinner.classList.remove('d-none');
        btnText.textContent = 'Validando...';

        const cuenta = document.getElementById('email').value.trim();
        const contrasena = document.getElementById('password').value;

        const resultado = await validarCredenciales(cuenta, contrasena);

        // Quitar spinner
        btnLogin.disabled = false;
        spinner.classList.add('d-none');
        btnText.textContent = 'Ingresar';

        if (!resultado.success) {
            alert(resultado.message || 'Credenciales inválidas');
            return;
        }

        // Guardar datos relevantes en localStorage
        localStorage.setItem('usuario', resultado.usuario);
        localStorage.setItem('tipoUsuario', resultado.tipo);
        localStorage.setItem('idUsuario', resultado.id);

        // Redireccionar según tipo de usuario
        switch (resultado.tipo) {
            case 'revisor':
                localStorage.setItem('idRevisor', resultado.id);
                window.location.href = '../revisores/index.php';
                break;
            default:
                alert('Tipo de usuario no reconocido.');
        }
    });
});