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
      {"label": "Periodo", "href": "periodo.php"},
      {"label": "Docentes", "href": "docentes.php"},
      {"label": "Historial", "href": "historial.php"},
      {"label": "Notas", "href": "notas.php"},
      {"label": "Estadistica", "href": "estadistica.php"},
      {"label": "Listado", "href": "listado.php"},
      {"label": "Clave", "href": "clave.php"}
    ]'></unah-sidebar>

    <div class="container_principal">

            <div class="container_secundario">
                    <h1 class="main-title">Crear Seccion</h1>

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

                <div class="container_secundario">
                    <h1 class="main-title">Aumento de Cupos</h1>

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

                <div class="container_secundario">
                    <h1 class="main-title">Registros de Infraestructura</h1>

                        <div class="form-box">
                            <label>Nombre del Edificio:</label>
                            <input type="text" placeholder="Edificio B2">

                            <label>Aula:</label>
                            <input type="text" placeholder="B2-209">

                            <button class="action-btn" onclick="alert('Aula registrada (simulado)')">Registrar</button>
                        </div>

                </div>

                <div class="container_secundario">
                    <h1 class="main-title">Cancelacion de Seccion</h1>

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

                <div class="container_secundario">
                    <h1 class="main-title">Verificar Lista de Espera</h1>

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


    <script type="module" src="../../assets/js/mainEstudiantes.js"></script>
</body>
</html>