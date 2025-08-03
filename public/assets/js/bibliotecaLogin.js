import {
    cargarTipoRecurso,
    subirRecurso,
    cargarClasesDocente,
    cargarRecursos,
    recursoDetalle,
    recursoPortadaArchivo,
    editarRecurso,
    eliminarRecurso,
    validarCredenciales
} from '../../../components/Biblioteca/biblioteca_Controller.mjs';


//login
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

        /*  if (!resultado.success) {
              alert(resultado.message || 'Credenciales inválidas');
              return;
          }
   */
        if (resultado.success) {
            btnLogin.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i> Bienvenido';
            btnLogin.classList.add('btn-success');

            setTimeout(() => {
                alert("Acceso exitoso. Redirigiendo...");
                window.location.href = "../../../biblioteca/biblioteca.php";
            }, 1000);
        } else {
            btnText.textContent = "Ingresar";
            spinner.classList.add('d-none');
            btnLogin.disabled = false;
            alert("Credenciales incorrectas. Intente de nuevo.");
        }

    });
});