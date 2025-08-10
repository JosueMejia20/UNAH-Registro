<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clave</title>
  <link rel="icon" href="https://lepidopterahonduras.wordpress.com/wp-content/uploads/2015/04/cropped-escudo-unah-22.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/../../assets/css/principal_components.css">
  <link rel="stylesheet" href="/../../assets/css/docente_style.css">
</head>
<body>
  <unah-navbar></unah-navbar>    

    <unah-sidebar menu-items='[
      {"label": "Perfil", "href": "perfil_jefe.php"},
      {"label": "Asignaturas", "href": "asignaturas.php"},
      {"label": "Periodo", "href": "periodo.php"},
      {"label": "Docentes", "href": "docentes.php"},
      {"label": "Historial", "href": "historial.php"},
      {"label": "Notas", "href": "notas.php"},
      {"label": "Estadistica", "href": "estadistica.php"},
      {"label": "Listado", "href": "listado.php"},
      {"label": "Clave", "href": "clave.php"}
    ]'></unah-sidebar>

    <div class="container_principal">

        <div class="perfil-card">
          <div class="imagen-perfil">
            <img src="ruta-de-la-imagen.jpg" alt="Foto de perfil">
          </div>
          <div class="info-perfil">
            <p class="titulo">Gention de Clave</p>
            <p class="nombre">Mario Geron</p>
          </div>
        </div>

            <div class="container_secundario">

                    <div class="form-box">
                        <label>Seleccionar Docente:</label>
                        <select>
                        <option>Docente 1</option>
                        <option>Docente 2</option>
                        </select>

                        <label>Ingresar Clave:</label>
                            <input type="password" placeholder="Clave">

                        <label>Confirmar Clave:</label>
                            <input type="password" placeholder="Clave">

                        <button class="action-btn" onclick="alert('Correo enviado')">Enviar Correo</button>
                    </div>
            </div>


    </div>


    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>