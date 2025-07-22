// Obtiene una referencia al botón y al cuadro de mensaje
        const myButton = document.getElementById('myButton');
        const messageBox = document.getElementById('messageBox');
        const messageText = document.getElementById('messageText');

        // Agrega un "event listener" al botón
        myButton.addEventListener('click', () => {
            // Muestra un mensaje en el cuadro de mensaje
            messageText.textContent = '¡Has hecho clic en el botón!';
            messageBox.classList.remove('hidden'); // Hace visible el cuadro de mensaje
        });

        // Asegura que la página sea responsiva ajustando el viewport
        window.addEventListener('resize', () => {
            // No se necesita lógica específica aquí para este ejemplo simple,
            // ya que Tailwind CSS maneja la mayor parte de la responsividad.
            console.log('Ventana redimensionada');
        });