
        //Animaciones al hacer scroll sin librerías de terceros
        document.addEventListener('DOMContentLoaded', function() {
            // Animación para navbar al hacer scroll
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar-unah');
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
            
            // Animación para elementos al hacer scroll
            const animateElements = document.querySelectorAll('.animate-on-scroll');
            
            function checkScroll() {
                animateElements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;
                    
                    if (elementTop < windowHeight - 100) {
                        element.classList.add('animated');
                    }
                });
            }
            
            // Verificar al cargar la página
            checkScroll();
            
            // Verificar al hacer scroll
            window.addEventListener('scroll', checkScroll);
        });
