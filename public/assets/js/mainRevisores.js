const BASE_URL = '/api/admisiones';
import { UnahNavbar } from "/../../components/navbar.mjs";
customElements.define("unah-navbar", UnahNavbar);

import { UnahFooter } from "../../components/footer.mjs";
customElements.define("unah-footer", UnahFooter);

import { Cargando, loadingEvent } from "../../components/loading.mjs";
customElements.define("pantalla-de-carga", Cargando);
loadingEvent();

import { UnahModal } from '../../components/modal.mjs'; 
customElements.define("unah-modal", UnahModal);

// Instancias modal y overlay
const modal = document.querySelector('unah-modal');
const overlayCarga = document.getElementById('overlayCarga');

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

/**
 * Renderiza los datos de la solicitud actual
 */
const renderizarSolicitud = async () => {
    const contenedor = document.getElementById('card-body');
    if (indexActual >= solicitudes.length) {
        contenedor.innerHTML = '<p class="text-center my-5">No hay más solicitudes.</p>';
        return;
    }

    const solicitud = solicitudes[indexActual];
    const detalle = await obtenerDetalleSolicitud(solicitud.inscripcion_id);

    if (!detalle) return;

    document.querySelector('#numeroSolicitud').innerHTML = `<i class="bi bi-file-earmark-text"></i> Solicitud #${detalle[0].numero_solicitud}`;
    document.querySelector('.status-badge').textContent = "Pendiente de revisión";
    document.querySelector('#pendingCount').textContent = solicitudes.length - indexActual;

    // Llenado dinámico
    document.querySelector('#nombrePostulante').innerHTML = detalle[0].nombre_postulante;
    document.querySelector('#identidadPostulante').textContent = detalle[0].identidad_postulante;
    document.querySelector('#fechaNacimientoPostulante').textContent = detalle[0].fecha_nacimiento;
    document.querySelector('#generoPostulante').textContent = detalle[0].genero;
    document.querySelector('#estadoCivilPostulante').textContent = detalle[0].estado_civil;
    document.querySelector('#direccionPostulante').textContent = detalle[0].direccion;
    document.querySelector('#telefonoPostulante').textContent = detalle[0].telefono;
    document.querySelector('#correoPostulante').textContent = detalle[0].correo_personal;
    document.querySelector('#institutoPostulante').textContent = detalle[0].instituto_educacion_media;
    document.querySelector('#anioGraduacionPostulante').textContent = detalle[0].anio_graduacion;
    document.querySelector('#centroRegionalPostulante').textContent = detalle[0].centro_regional;
    document.querySelector('#carreraPrimariaPostulante').textContent = detalle[0].carrera_primaria;
    document.querySelector('#carreraSecundariaPostulante').textContent = detalle[0].carrera_secundaria;

    // Documento
    const documentImg = document.getElementById('documentImage');
    documentImg.src = detalle[0].documento_adjunto
        ? `data:image/jpeg;base64,${detalle[0].documento_adjunto}`
        : 'https://via.placeholder.com/300x400?text=Sin+Documento';
};

const siguienteSolicitud = () => {
    indexActual++;
    renderizarSolicitud();
};

const manejarAprobacion = async (inscripcion, valor, justificacion, correo) => {
    await aprobarSolicitud(inscripcion, valor, justificacion, correo);
    siguienteSolicitud();
};

const manejarRechazo = async (inscripcion, valor, justificacion, correo) => {
    await rechazarSolicitud(inscripcion, valor, justificacion, correo);
    siguienteSolicitud();
};

// ---------------------------
// Vista revisor
// ---------------------------
document.addEventListener('DOMContentLoaded', async () => {
    solicitudes = await obtenerSolicitudesPorRevisor(idRevisor);
    renderizarSolicitud();

    // Validación de checkboxes
    document.querySelectorAll('.field-validation').forEach(container => {
        const checkboxes = container.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    const groupName = this.name;
                    checkboxes.forEach(cb => {
                        if (cb !== this && cb.name === groupName) {
                            cb.checked = false;
                        }
                    });
                }
            });
        });
    });

    // Botón aprobar
    document.getElementById('acceptBtn').addEventListener('click', async () => {
        const solicitud = solicitudes[indexActual];
        const detalle = await obtenerDetalleSolicitud(solicitud.inscripcion_id);

        // Validar campos
        const allValidated = Array.from(document.querySelectorAll('.field-validation')).every(container => {
            return container.querySelector('input[type="checkbox"]:checked') !== null;
        });

        if (!allValidated) {
            modal.show('Por favor, valide todos los campos antes de aprobar la solicitud.');
            return;
        }

        // Mostrar cargando y bloquear botón
        overlayCarga.style.display = 'flex';
        document.getElementById('acceptBtn').disabled = true;

        try {
            await manejarAprobacion(solicitud.inscripcion_id, 'Aprobada', "", detalle[0].correo_personal);

            overlayCarga.style.display = 'none';
            document.getElementById('acceptBtn').disabled = false;

            modal.show('Solicitud aprobada correctamente.', () => {
                siguienteSolicitud();
            });

        } catch (error) {
            overlayCarga.style.display = 'none';
            document.getElementById('acceptBtn').disabled = false;
            modal.show('Error al aprobar la solicitud.');
        }
    });

    // Botón rechazar
    document.getElementById('rejectBtn').addEventListener('click', async () => {
        const solicitud = solicitudes[indexActual];
        const detalle = await obtenerDetalleSolicitud(solicitud.inscripcion_id);

        const comentariosGenerales = document.getElementById("comentarios-generales").value.trim();
        const comentariosDocumento = document.getElementById("comentarios-documento").value.trim();
        const razon = `${comentariosGenerales}\n\n${comentariosDocumento}\n\n`;

        const hasIncorrectFields = Array.from(document.querySelectorAll('.field-validation')).some(container => {
            return container.querySelector('input[value="incorrecto"]:checked') !== null;
        });

        if (!hasIncorrectFields) {
            modal.show('Por favor, marque al menos un campo como incorrecto para rechazar la solicitud.');
            return;
        }
        if (!razon) {
            modal.show("Debe ingresar una razón.");
            return;
        }

        overlayCarga.style.display = 'flex';
        document.getElementById('rejectBtn').disabled = true;

        try {
            await manejarRechazo(solicitud.inscripcion_id, 'Rechazada', razon, detalle[0].correo_personal);

            overlayCarga.style.display = 'none';
            document.getElementById('rejectBtn').disabled = false;

            modal.show('Solicitud rechazada correctamente.', () => {
                siguienteSolicitud();
            });

        } catch (error) {
            overlayCarga.style.display = 'none';
            document.getElementById('rejectBtn').disabled = false;
            modal.show('Error al rechazar la solicitud.');
        }
    });
});

// ---------------------------
// Login revisores
// ---------------------------
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');
    const btnLogin = form.querySelector('.btn-login');
    const spinner = form.querySelector('.spinner-border');
    const btnText = form.querySelector('.btn-text');
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    // Mostrar/ocultar contraseña
    togglePassword.addEventListener('click', () => {
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;
        togglePassword.innerHTML = type === 'password'
            ? '<i class="bi bi-eye-fill"></i>'
            : '<i class="bi bi-eye-slash-fill"></i>';
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        // Mostrar overlay
        overlayCarga.style.display = 'flex';
        btnLogin.disabled = true;
        btnLogin.style.pointerEvents = 'none';
        spinner.classList.remove('d-none');
        btnText.textContent = 'Validando...';

        const cuenta = document.getElementById('email').value.trim();
        const contrasena = document.getElementById('password').value;

        try {
            const resultado = await validarCredenciales(cuenta, contrasena);

            btnLogin.disabled = false;
            btnLogin.style.pointerEvents = 'auto';
            spinner.classList.add('d-none');
            btnText.textContent = 'Ingresar';

            if (resultado.success) {
                btnLogin.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i> Bienvenido';
                btnLogin.classList.add('btn-success');

                setTimeout(() => {
                    overlayCarga.style.display = 'none';
                    modal.show("Acceso exitoso. Redirigiendo...", () => {
                        window.location.href = "../../../admisiones/revisores.php";
                    });
                }, 500);

                localStorage.setItem('idRevisor', resultado.idRevisor);

            } else {
                overlayCarga.style.display = 'none';
                modal.show("Credenciales incorrectas. Intente de nuevo.");
            }

        } catch (error) {
            overlayCarga.style.display = 'none';
            btnLogin.disabled = false;
            btnLogin.style.pointerEvents = 'auto';
            spinner.classList.add('d-none');
            btnText.textContent = 'Ingresar';

            modal.show("Error al conectar con el servidor. Intente más tarde.");
        }
    });
});
