<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registro UNAH</title>
    <link rel="icon" href="https://biologia.unah.edu.hn/dmsdocument/1433-unah-logo-texto">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/../../assets/css/landing_style.css">
    <link rel="stylesheet" href="/../../assets/css/loading.css">

</head>
<body>
    <pantalla-de-carga></pantalla-de-carga>
    <unah-navbar></unah-navbar>

    <!-- Hero section -->
    <section class="hero">
        <div class="unah-badge">#1 en Honduras</div>
        <div class="hero-bg"></div>
        <div class="container hero-content">
            <h1 class="hero-title">Bienvenidos a la UNAH</h1>
            <p class="hero-subtitle">La institución de educación superior más importante de Honduras, formando profesionales de excelencia desde 1847</p>
            <div class="btn-group">
                <a href="index.php?page=formulario" class="btn btn-unah-primary">Admisiones 2025</a>
                <a href="/Proyecto/views/revisores.php" class="btn btn-unah-secondary">Conoce nuestras carreras</a>
            </div>
        </div>
    </section>

    <!-- Sección de números destacados -->
    <section class="stats-section">
        <div class="container">
            <div class="section-header animate-on-scroll">
                <h2 class="section-title">La UNAH en números</h2>
                <p class="section-subtitle">Gracias a nuestra sólida trayectoria y al impacto de nuestra formación, nos consolidamos como la universidad líder del país.</p>
            </div>
            <div class="stats-grid">
                <div class="stat-card animate-on-scroll" style="transition-delay: 0.1s">
                    <div class="stat-number">175+</div>
                    <div class="stat-title">Años de historia</div>
                </div>
                <div class="stat-card animate-on-scroll" style="transition-delay: 0.2s">
                    <div class="stat-number">80+</div>
                    <div class="stat-title">Programas académicos</div>
                </div>
                <div class="stat-card animate-on-scroll" style="transition-delay: 0.3s">
                    <div class="stat-number">7</div>
                    <div class="stat-title">Centros regionales</div>
                </div>
                <div class="stat-card animate-on-scroll" style="transition-delay: 0.4s">
                    <div class="stat-number">50,000+</div>
                    <div class="stat-title">Estudiantes activos</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de carreras mejorada -->
    <section class="carreras-section">
        <div class="pattern-bg"></div>
        <div class="container">
            <div class="section-header animate-on-scroll">
                <h2 class="section-title">Nuestras Facultades</h2>
                <p class="section-subtitle">Conoce las facultades y escuelas que componen nuestra universidad</p>
            </div>
            <div class="logos-grid">
                <div class="logo-card animate-on-scroll" style="transition-delay: 0.1s">
                    <img src="https://ingenieria.unah.edu.hn/assets/Ingenieria/paginas/resena-historica/_resampled/CroppedFocusedImageWyIyMDAiLCIyMDAiLCJ4IiwzXQ/F.I.-LOGO.png" alt="Ingeniería" class="facultad-logo">
                    <div class="facultad-name">Facultad de Ingeniería</div>
                </div>
                
                <div class="logo-card animate-on-scroll" style="transition-delay: 0.15s">
                    <img src="https://fcm.unah.edu.hn/assets/Uploads/_resampled/CroppedFocusedImageWyIxMTAiLCIxMTAiLGZhbHNlLDBd/FCM-LOGO.png" alt="Medicina" class="facultad-logo">
                    <div class="facultad-name">Facultad de Ciencias Médicas</div>
                </div>
                
                <div class="logo-card animate-on-scroll" style="transition-delay: 0.2s">
                    <img src="https://cienciasespaciales.unah.edu.hn/assets/Uploads/_resampled/CroppedFocusedImageWyIxMTAiLCIxMTAiLCJ4IiwxXQ/logofaces-sinfondo.png" alt="Ciencias Espaciales" class="facultad-logo">
                    <div class="facultad-name">Facultad de Ciencias Espaciales</div>
                </div>
                
                <div class="logo-card animate-on-scroll" style="transition-delay: 0.25s">
                    <img src="https://ciencias.unah.edu.hn/assets/Uploads/_resampled/CroppedFocusedImageWyIxMTAiLCIxMTAiLGZhbHNlLDBd/logo-ciencias.png" alt="Ciencias" class="facultad-logo">
                    <div class="facultad-name">Facultad de Ciencias</div>
                </div>
                
                <div class="logo-card animate-on-scroll" style="transition-delay: 0.3s">
                    <img src="https://th.bing.com/th/id/R.94d7bd08dc84b6dfe9a112818eaeb7e5?rik=UU%2fuEpw%2fgMaY%2fw&riu=http%3a%2f%2f3.bp.blogspot.com%2f-Sw97PhpS7ro%2fVB3UlHnNnjI%2fAAAAAAAAAB4%2fwHblrRmdJrk%2fs1600%2flogo-cienciaseconomicas.png&ehk=4OZ05ggzyc0Yni2t73VYPAqIvtixZ%2b95%2bLSnvudPylw%3d&risl=&pid=ImgRaw&r=0" alt="Ciencias Económicas" class="facultad-logo">
                    <div class="facultad-name">Facultad de Ciencias Económicas</div>
                </div>
                
                <div class="logo-card animate-on-scroll" style="transition-delay: 0.35s">
                    <img src="https://cienciasjuridicas.unah.edu.hn/assets/Uploads/_resampled/CroppedFocusedImageWyIxMTAiLCIxMTAiLGZhbHNlLDBd/FCJ.png" alt="Derecho" class="facultad-logo">
                    <div class="facultad-name">Facultad de Ciencias Jurídicas</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de noticias -->
    <section class="news-section">
        <div class="container">
            <div class="section-header animate-on-scroll">
                <h2 class="section-title">Noticias y Eventos</h2>
                <p class="section-subtitle">Mantente informado sobre lo que acontece en nuestra universidad</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4 animate-on-scroll" style="transition-delay: 0.1s">
                    <div class="news-card">
                        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" class="news-img" alt="Estudiantes universitarios">
                        <div class="news-body">
                            <div class="news-date">15 JUNIO 2023</div>
                            <h3 class="news-title">UNAH inaugura nuevo centro de investigación tecnológica</h3>
                            <p class="news-excerpt">El centro contará con laboratorios de última generación para impulsar la innovación en el país.</p>
                            <a href="#" class="facultad-link">Leer más <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 animate-on-scroll" style="transition-delay: 0.2s">
                    <div class="news-card">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" class="news-img" alt="Grupo de estudiantes">
                        <div class="news-body">
                            <div class="news-date">10 JUNIO 2023</div>
                            <h3 class="news-title">Convocatoria abierta para becas internacionales 2024</h3>
                            <p class="news-excerpt">Oportunidades de estudio en prestigiosas universidades de Europa y América Latina.</p>
                            <a href="#" class="facultad-link">Leer más <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 animate-on-scroll" style="transition-delay: 0.3s">
                    <div class="news-card">
                        <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" class="news-img" alt="Conferencia universitaria">
                        <div class="news-body">
                            <div class="news-date">5 JUNIO 2023</div>
                            <h3 class="news-title">Foro internacional sobre desarrollo sostenible</h3>
                            <p class="news-excerpt">Expertos discutirán los desafíos del desarrollo sostenible en Honduras y la región.</p>
                            <a href="#" class="facultad-link">Leer más <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <unah-footer></unah-footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/../../assets/js/landing_script.js"></script>
    <script src="/../../assets/js/loading.js"></script>
    <script type="module" src="../../assets/js/main.js"></script>
</body>
</html>