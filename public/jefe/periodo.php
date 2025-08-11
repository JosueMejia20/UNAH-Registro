<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periodo</title>
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
      {"label": "Docentes", "href": "docentes.php"},
      {"label": "Historial", "href": "historial.php"},
      {"label": "Notas", "href": "notas.php"},
      {"label": "Estadistica", "href": "estadistica.php"},
      {"label": "Listado", "href": "listado.php"}
    ]'
    sidebar-title="Portal Jefe UNAH"
    user-name="Jefe"></unah-sidebar>

    <div class="container_principal">

        <div class="perfil-card">
          <div class="imagen-perfil">
            <img src="ruta-de-la-imagen.jpg" alt="Foto de perfil">
          </div>
          <div class="info-perfil">
            <p class="titulo">Periodo</p>
            <p class="nombre">Mario Geron</p>
          </div>
        </div>

        <div class="contenedor_infor">


            <div class="izquierdar">
                    <div class="izquierdar-header">
                      <h2>Crear Seccion</h2>
                    </div>

                        <div class="form-box">
                            <label>Clase:</label>
                            <select>
                            <option>Matemáticas I</option>
                            <option>Física General</option>
                            <option>Programación Básica</option>
                            </select>

                            <label>Docente:</label>
                            <select>
                            <option>Juan Pérez</option>
                            <option>María López</option>
                            </select>

                            <label>Aula:</label>
                            <input type="text" placeholder="B2-210">

                            <label>Hora:</label>
                            <input type="time">

                            <label>Días:</label>
                            <input type="text" placeholder="Lunes, Martes, Miercoles, Jueves, Viernes">

                            <label>Cantidad de cupos:</label>
                            <input type="number" min="1">

                            <button class="action-btn" onclick="alert('Sección creada (simulado). Verificar traslapes en backend.')">Crear Sección</button>
                        </div>
            </div>

            <div class="derechar">
                        <div class="derechar-header">
                          <h2>Aumento de Cupos</h2>
                        </div>

                            <div class="form-box">
                                <label>Clase:</label>
                                <select>
                                <option>Matemáticas I</option>
                                <option>Física General</option>
                                </select>

                                <label>Cantidad adicional:</label>
                                <input type="number" min="1">

                                <button class="action-btn" onclick="alert('Cupos aumentados (simulado)')">Aumentar</button>
                            </div>

            </div>


            <div class="izquierdar">
                        <div class="izquierdar-header">
                          <h2>Registros de Infraestructura</h2>
                        </div>

                            <div class="form-box">
                                <label>Nombre del Edificio:</label>
                                <input type="text" placeholder="Edificio B2">

                                <label>Aula:</label>
                                <input type="text" placeholder="B2-209">

                                <button class="action-btn" onclick="alert('Aula registrada (simulado)')">Registrar</button>
                            </div>
            </div>


            <div class="derechar">
                    <div class="derechar-header">
                      <h2>Cancelacion de Seccion</h2>
                    </div>

                            <div class="form-box">
                                <label>Clase:</label>
                                <select>
                                <option>Física General</option>
                                <option>Programación Básica</option>
                                </select>

                                <label>Justificación:</label>
                                <textarea placeholder="Escriba la razón de la cancelación..."></textarea>

                                <button class="action-btn" onclick="alert('Sección cancelada (simulado)')">Cancelar Sección</button>
                            </div>
            </div>

            <div class="izquierdar">
                    <div class="izquierdar-header">
                      <h2>Verificar Lista de Esperan</h2>
                    </div>
                  

                        <div class="form-box">
                            <label>Clase:</label>
                            <select>
                            <option>Matemáticas I</option>
                            <option>Física General</option>
                            </select>

                            <button class="action-btn" onclick="alert('Mostrando lista de espera (simulado)')">Ver lista</button>
                        </div>
            </div>

        </div>

    </div>



    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>