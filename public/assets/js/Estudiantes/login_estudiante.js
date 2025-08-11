import {
    validarCredenciales
} from '../../../../components/Estudiantes/loginEstudiantes_Controller.mjs';

import { UnahModal } from '../../../components/modal.mjs';
customElements.define("unah-modal", UnahModal);

// Obtener referencia al modal componentizado
    const modal = document.querySelector('unah-modal');

document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('loginForm');
    const btnLogin = document.querySelector('.btn-login');
    const btnText = document.querySelector('.btn-text');
    const spinner = document.querySelector('.spinner-border');
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    // Mostrar/ocultar contraseña
    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('bi-eye-fill');
        this.querySelector('i').classList.toggle('bi-eye-slash-fill');
    });

    // Validación y envío
    loginForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        if (!loginForm.checkValidity()) {
            e.stopPropagation();
            loginForm.classList.add('was-validated');
            return;
        }

        btnText.textContent = "Verificando...";
        spinner.classList.remove('d-none');
        btnLogin.disabled = true;

        const cuenta = document.getElementById('email').value.trim();
        const contrasena = document.getElementById('password').value;

        const resultado = await validarCredenciales(cuenta, contrasena);

        // Quitar spinner
        btnLogin.disabled = false;
        spinner.classList.add('d-none');
        btnText.textContent = 'Ingresar';

        /*  if (!resultado.success) {
              alert(resultado.message || 'Credenciales inválidas');
              return;
          }
  */

        if (resultado.success) {
            btnLogin.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i> Bienvenido';
            btnLogin.classList.add('btn-success');

            setTimeout(() => {
                overlayCarga.style.display = 'none'; 
                modal.show("Acceso exitoso. Redirigiendo...", () => {
                    window.location.href = "../../../estudiantes/estudiante.php";
                });
            }, 1000);
        } else {
            btnText.textContent = "Ingresar";
            spinner.classList.add('d-none');
            btnLogin.disabled = false;
            overlayCarga.style.display = 'none';
            modal.show("Credenciales incorrectas. Intente de nuevo.");
        }

    });

    // Efectos hover
    document.querySelectorAll('.input-animate').forEach(input => {
        input.addEventListener('mouseenter', () => {
            input.parentElement.querySelector('.input-group-text').style.transform = 'scale(1.1)';
        });
        input.addEventListener('mouseleave', () => {
            input.parentElement.querySelector('.input-group-text').style.transform = 'scale(1)';
        });
    });
}); 