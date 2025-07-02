class LoginForm extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: "open" });
  }

  connectedCallback() {
    const tipo = this.getAttribute("tipo-usuario") || "estudiante";

    // Definir textos y destino según el rol
    let cuentaPlaceholder = "Número de cuenta";
    let validacion = "numeric";
    let redireccion = "estudiantes.php";

    if (["docente", "coordinador", "jefe"].includes(tipo)) {
      cuentaPlaceholder = "Correo institucional";
      validacion = "email";
      redireccion = `${tipo}.php`;
    } else if (tipo === "revisor") {
      cuentaPlaceholder = "Usuario";
      validacion = "text";
      redireccion = "revisor.php";
    }

    // Estilos + HTML
    this.shadowRoot.innerHTML = `
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
      <style>
        .logo-unah { width: 80px; }
      </style>

      <div class="container-fluid">
        <div class="row justify-content-center align-items-center min-vh-100">
          <div class="col-md-6 col-lg-4">
            <div class="card login-card bg-blur">
              <div class="card-body p-4 p-sm-5">
                <div class="text-center mb-4">
                  <div class="logo-container mb-3">
                    <img src="https://biologia.unah.edu.hn/dmsdocument/1433-unah-logo-texto"
                         alt="Logo UNAH"
                         class="logo-unah">
                  </div>
                  <h3 class="fw-bold text-gradient">Acceso UNAH</h3>
                  <p class="text-muted">Ingresa tus credenciales institucionales</p>
                </div>

                <form id="loginForm" novalidate>
                  <div class="mb-3 input-group">
                    <span class="input-group-text bg-transparent">
                      <i class="bi bi-person-fill text-primary"></i>
                    </span>
                    <input type="text" id="usuario" class="form-control" placeholder="${cuentaPlaceholder}" required>
                    <div class="invalid-feedback">Campo requerido</div>
                  </div>
                  <div class="mb-3 input-group">
                    <span class="input-group-text bg-transparent">
                      <i class="bi bi-lock-fill text-primary"></i>
                    </span>
                    <input type="password" id="password" class="form-control" placeholder="Contraseña" required>
                    <button type="button" class="btn btn-sm btn-transparent" id="togglePassword">
                      <i class="bi bi-eye-fill"></i>
                    </button>
                    <div class="invalid-feedback">Campo requerido</div>
                  </div>
                  <div class="d-grid mb-3">
                    <button class="btn btn-primary" type="submit">Ingresar</button>
                  </div>
                  <div class="text-center">
                    <a href="#" class="text-decoration-none small">Recuperar contraseña</a>
                    <p class="mt-3 small text-muted">© 2023 UNAH - Todos los derechos reservados</p>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    `;

    this.setupEvents(validacion, redireccion);
  }

  setupEvents(validacion, redireccion) {
    const form = this.shadowRoot.querySelector("#loginForm");
    const usuario = this.shadowRoot.querySelector("#usuario");
    const password = this.shadowRoot.querySelector("#password");

    // Mostrar/ocultar contraseña
    const toggle = this.shadowRoot.querySelector("#togglePassword");
    toggle.addEventListener("click", () => {
      const isPass = password.type === "password";
      password.type = isPass ? "text" : "password";
      toggle.querySelector("i").classList.toggle("bi-eye-fill");
      toggle.querySelector("i").classList.toggle("bi-eye-slash-fill");
    });

    // Validación y redirección
    form.addEventListener("submit", (e) => {
      e.preventDefault();

      let valido = true;

      if (validacion === "numeric" && !/^\d{11}$/.test(usuario.value.trim())) {
        usuario.classList.add("is-invalid");
        valido = false;
      } else if (validacion === "email" && !/\S+@\S+\.\S+/.test(usuario.value.trim())) {
        usuario.classList.add("is-invalid");
        valido = false;
      } else if (validacion === "text" && usuario.value.trim() === "") {
        usuario.classList.add("is-invalid");
        valido = false;
      } else {
        usuario.classList.remove("is-invalid");
      }

      if (password.value.trim() === "") {
        password.classList.add("is-invalid");
        valido = false;
      } else {
        password.classList.remove("is-invalid");
      }

      if (valido) {
        // Redirigir a la vista correspondiente
        window.location.href = `views/${redireccion}`;
      }
    });
  }
}

const loginevent = ()=>{

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
                            window.location.href = "#"; // Reemplaza con tu URL
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
}

export{
    LoginForm,
    loginevent
}