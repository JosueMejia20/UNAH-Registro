import {
    validarCredenciales
} from '../../../components/Biblioteca/biblioteca_Controller.mjs';

import { UnahModal } from '../../components/modal.mjs';
customElements.define("unah-modal", UnahModal);

// ==================== LOGIN ====================
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');
    const btnLogin = form.querySelector('.btn-login');
    const spinner = form.querySelector('.spinner-border');
    const btnText = form.querySelector('.btn-text');
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const overlayCarga = document.getElementById('overlayCarga');

    // Obtener referencia al modal componentizado
    const modal = document.querySelector('unah-modal');

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

        // ====== MOSTRAR OVERLAY Y BLOQUEAR BOTÓN ======
        overlayCarga.style.display = 'flex';
        btnLogin.disabled = true;
        btnLogin.style.pointerEvents = 'none';
        spinner.classList.remove('d-none');
        btnText.textContent = 'Validando...';

        const cuenta = document.getElementById('email').value.trim();
        const contrasena = document.getElementById('password').value;

        try {
            const resultado = await validarCredenciales(cuenta, contrasena);

            // Botón vuelve a su estado normal
            btnLogin.disabled = false;
            btnLogin.style.pointerEvents = 'auto';
            spinner.classList.add('d-none');
            btnText.textContent = 'Ingresar';

            if (resultado.success) {
                btnLogin.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i> Bienvenido';
                btnLogin.classList.add('btn-success');

                // Mantener overlay visible hasta mostrar modal
                setTimeout(() => {
                    overlayCarga.style.display = 'none'; // Ocultamos overlay justo al mostrar modal
                    modal.show("Acceso exitoso. Redirigiendo...", () => {
                        window.location.href = "../../../biblioteca/biblioteca.php";
                    });
                }, 500); // Pequeño delay para dar sensación fluida

            } else {
                // Ocultar overlay y mostrar modal de error
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
