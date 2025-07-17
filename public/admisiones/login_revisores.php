<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso UNAH</title>
    <link rel="icon" href="https://biologia.unah.edu.hn/dmsdocument/1433-unah-logo-texto">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/login_style.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <!-- Tarjeta de Login -->
                <div class="card login-card bg-blur">
                    <div class="card-body p-4 p-sm-5">
                        <!-- Encabezado -->
                        <div class="text-center mb-4">
                            <div class="logo-container mb-3">
                                <img src="https://biologia.unah.edu.hn/dmsdocument/1433-unah-logo-texto" 
                                     alt="Logo UNAH" 
                                     class="logo-unah">
                            </div>
                            <h3 class="fw-bold text-gradient">Acceso UNAH</h3>
                            <p class="text-muted">Ingresa tus credenciales institucionales</p>
                        </div>

                        <!-- Formulario -->
                        <form id="loginForm" class="needs-validation" novalidate>
                            <div class="mb-3 input-group">
                                <span class="input-group-text bg-transparent">
                                    <i class="bi bi-person-fill text-primary"></i>
                                </span>
                                <input type="text" 
                                       class="form-control input-animate" 
                                       id="email" 
                                       placeholder="Número de cuenta" 
                                       required>
                                <div class="invalid-feedback">
                                    Ejemplo: 20202000001
                                </div>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text bg-transparent">
                                    <i class="bi bi-lock-fill text-primary"></i>
                                </span>
                                <input type="password" 
                                       class="form-control input-animate" 
                                       id="password" 
                                       placeholder="Contraseña" 
                                       required>
                                <button type="button" class="btn btn-sm btn-transparent" id="togglePassword">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                                <div class="invalid-feedback">
                                    Requerido
                                </div>
                            </div>
                            <div class="d-grid mb-3">
                                <button class="btn btn-primary btn-login" type="submit">
                                    <span class="btn-text">Ingresar</span>
                                    <span class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                                </button>
                            </div>
                            <div class="separator my-4">
                                <span class="bg-blur px-2">¿Problemas?</span>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../../assets/js/mainRevisores.js"></script>
</body>
</html>
