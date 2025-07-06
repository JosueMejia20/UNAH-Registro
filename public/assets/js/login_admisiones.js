document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const btnLogin = document.querySelector('.btn-login');
            const btnText = document.querySelector('.btn-text');
            const spinner = document.querySelector('.spinner-border');
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            // Mostrar/ocultar contraseña
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.querySelector('i').classList.toggle('bi-eye-fill');
                this.querySelector('i').classList.toggle('bi-eye-slash-fill');
            });

            // Validación y envío
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (!loginForm.checkValidity()) {
                    e.stopPropagation();
                    loginForm.classList.add('was-validated');
                    return;
                }

                btnText.textContent = "Verificando...";
                spinner.classList.remove('d-none');
                btnLogin.disabled = true;

                setTimeout(() => {
                    btnLogin.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i> Bienvenido';
                    btnLogin.classList.add('btn-success');
                    
                    setTimeout(() => {
                        // Redirigir al dashboard (simulado)
                        alert("Acceso exitoso. Redirigiendo...");
                        window.location.href = "../admisiones/revisores.php"; 
                    }, 1000);
                }, 2000);
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