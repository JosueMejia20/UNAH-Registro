<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso UNAH</title>
    <!-- Bootstrap 5 + Íconos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/../../assets/css/login_style.css">
</head>
<body>
    
  <unah-login></unah-login>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../../assets/js/main.js">
        // Leer parámetro de rol desde la URL
        const params = new URLSearchParams(window.location.search);
        const rol = params.get("rol") || "estudiante";
        document.querySelector("login-form").setAttribute("tipo-usuario", rol);
    </script>

</body>
</html>