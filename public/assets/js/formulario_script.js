// Variables globales
let currentSection = 1;
const totalSections = 5;
const form = document.getElementById('admissionForm');
const loadingOverlay = document.getElementById('loadingOverlay');
const initialLoading = document.getElementById('initialLoading');
const contentContainer = document.getElementById('contentContainer');
const initialProgressBar = document.getElementById('initialProgressBar');

// Mostrar pantalla de carga inicial
document.addEventListener('DOMContentLoaded', function () {
    simulateInitialLoading();

    // Aquí va la lógica del select de centro regional
    document.getElementById('centro-regional').addEventListener('change', function () {
        // Aquí va la lógica del select de carreras según el centro
    });

    // Validación tipo de identificación
    document.getElementById('tipo-identificacion').addEventListener('change', function () {
        const numeroIdentificacion = document.getElementById('numero-identificacion');
        const errorElement = document.getElementById('numero-identificacion-error');

        if (this.value === 'identidad') {
            numeroIdentificacion.pattern = '^\\d{4}-\\d{4}-\\d{5}$';
            numeroIdentificacion.title = 'Formato correcto: 0000-0000-00000';
            numeroIdentificacion.placeholder = '0000-0000-00000';
            errorElement.textContent = 'El formato debe ser 0000-0000-00000';
        } else if (this.value === 'pasaporte') {
            numeroIdentificacion.pattern = '^[A-Za-z0-9]{6,20}$';
            numeroIdentificacion.title = 'Ingrese su número de pasaporte (solo letras y números, sin caracteres especiales)';
            numeroIdentificacion.placeholder = 'Número de pasaporte';
            errorElement.textContent = 'Ingrese un número de pasaporte válido (solo letras y números, sin caracteres especiales)';
        }
    });

    // Validación en tiempo real para el teléfono
    document.getElementById('telefono').addEventListener('input', function () {
        const regex = /^[89]\d{3}-\d{4}$/;
        validateField(this, regex, 'telefono-error');
    });
});

// Simular carga inicial
function simulateInitialLoading() {
    let progress = 0;
    const interval = setInterval(function () {
        progress += Math.random() * 10;
        if (progress > 100) progress = 100;
        initialProgressBar.style.width = `${progress}%`;

        if (progress >= 100) {
            clearInterval(interval);
            setTimeout(function () {
                initialLoading.classList.add('hidden');
                contentContainer.classList.add('show');
                setupForm();
            }, 500);
        }
    }, 300);
}

// Configuración del formulario
function setupForm() {
    function showFiles(input) {
        const fileList = document.getElementById('fileList');
        fileList.innerHTML = '';

        if (input.files.length > 0) {
            for (let i = 0; i < input.files.length; i++) {
                const fileItem = document.createElement('div');
                fileItem.className = 'file-item';
                fileItem.innerHTML = `
                    <span class="file-name">${input.files[i].name}</span>
                    <span class="remove-file" onclick="removeFile(this, ${i})">×</span>
                `;
                fileList.appendChild(fileItem);
            }
        }
        checkSectionCompletion(4);
    }

    function removeFile(element, index) {
        const input = document.getElementById('documentos');
        const files = Array.from(input.files);
        files.splice(index, 1);
        const dataTransfer = new DataTransfer();
        files.forEach(file => dataTransfer.items.add(file));
        input.files = dataTransfer.files;
        showFiles(input);
    }

    function goToSection(sectionNumber) {
        if (sectionNumber > currentSection && !validarSeccion(`section${currentSection}`)) return;

        document.getElementById(`section${currentSection}`).classList.remove('active');
        document.getElementById(`step${currentSection}`).classList.remove('active');

        document.getElementById(`section${sectionNumber}`).classList.add('active');
        document.getElementById(`step${sectionNumber}`).classList.add('active');

        if (sectionNumber > currentSection) {
            document.getElementById(`section${currentSection}`).classList.add('completed');
            document.getElementById(`step${currentSection}`).classList.add('completed');
        }

        currentSection = sectionNumber;
        updateProgressBar();

        if (currentSection === totalSections) {
            const allComplete = checkFormCompletion();
            document.getElementById('completeMessage').style.display = allComplete ? 'block' : 'none';
        }

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function updateProgressBar() {
        const progress = ((currentSection - 1) / (totalSections - 1)) * 100;
        document.getElementById('progressBar').style.width = `${progress}%`;
    }

    function validarSeccion(seccionId) {
        let isValid = true;
        const seccion = document.getElementById(seccionId);
        const inputs = seccion.querySelectorAll('input[required], select[required], textarea[required]');

        inputs.forEach(input => {
            const errorElement = document.getElementById(`${input.id}-error`);

            if (input.id.includes('nombre') || input.id.includes('apellido')) {
                if (input.value && !/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/.test(input.value)) {
                    input.classList.add('invalid');
                    if (errorElement) errorElement.style.display = 'block';
                    isValid = false;
                    return;
                }
            }

            if (input.id === 'email-confirm') {
                const email = document.getElementById('email').value;
                if (input.value !== email) {
                    input.classList.add('invalid');
                    if (errorElement) errorElement.style.display = 'block';
                    isValid = false;
                    return;
                }
            }

            if (input.id === 'numero-identificacion') {
                const tipo = document.getElementById('tipo-identificacion').value;
                const regex = tipo === 'identidad'
                    ? /^\d{4}-\d{4}-\d{5}$/
                    : /^[A-Za-z0-9]{6,20}$/;

                if (!regex.test(input.value)) {
                    input.classList.add('invalid');
                    if (errorElement) errorElement.style.display = 'block';
                    isValid = false;
                    return;
                }
            }

            if (input.id === 'telefono' && !/^[89]\d{3}-\d{4}$/.test(input.value)) {
                input.classList.add('invalid');
                if (errorElement) errorElement.style.display = 'block';
                isValid = false;
                return;
            }

            if (input.id === 'email' && !/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i.test(input.value)) {
                input.classList.add('invalid');
                if (errorElement) errorElement.style.display = 'block';
                isValid = false;
                return;
            }

            if (input.id === 'graduacion') {
                const year = parseInt(input.value);
                const currentYear = new Date().getFullYear();
                if (isNaN(year) || year < 1950 || year > currentYear) {
                    input.classList.add('invalid');
                    if (errorElement) errorElement.style.display = 'block';
                    isValid = false;
                    return;
                }
            }

            if (!input.value) {
                input.classList.add('invalid');
                if (errorElement) errorElement.style.display = 'block';
                isValid = false;
            } else {
                input.classList.remove('invalid');
                input.classList.add('valid');
                if (errorElement) errorElement.style.display = 'none';
            }
        });

        if (seccionId === 'section4') {
            const fileInput = document.getElementById('documentos');
            const checkboxes = seccion.querySelectorAll('input[type="checkbox"][required]');
            if (fileInput.files.length === 0) {
                document.getElementById('fileError').textContent = 'Debe adjuntar al menos un archivo';
                isValid = false;
            } else if (!validateFiles(fileInput)) {
                isValid = false;
            }

            checkboxes.forEach(cb => {
                const err = document.getElementById(`${cb.id}-error`);
                if (!cb.checked) {
                    if (err) err.style.display = 'block';
                    isValid = false;
                } else {
                    if (err) err.style.display = 'none';
                }
            });
        }

        return isValid;
    }

    function checkSectionCompletion(sectionNumber) {
        const section = document.getElementById(`section${sectionNumber}`);
        const inputs = section.querySelectorAll('input[required], select[required], textarea[required]');
        let isComplete = true;

        inputs.forEach(input => {
            if (!input.value || (input.type === 'checkbox' && !input.checked)) {
                isComplete = false;
            }
        });

        if (sectionNumber === 4) {
            const fileInput = document.getElementById('documentos');
            if (fileInput.files.length === 0) {
                isComplete = false;
            }
        }

        return isComplete;
    }

    function checkFormCompletion() {
        for (let i = 1; i <= totalSections; i++) {
            if (!checkSectionCompletion(i)) return false;
        }

        if (currentSection === totalSections) {
            document.getElementById('completeMessage').style.display = 'block';
        }

        return true;
    }

    function validateFiles(input) {
        const fileError = document.getElementById('fileError');
        const fileList = document.getElementById('fileList');
        const maxSize = 5 * 1024 * 1024;
        const allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
        let isValid = true;

        fileError.textContent = '';
        fileList.innerHTML = '';

        Array.from(input.files).forEach(file => {
            const item = document.createElement('div');
            item.textContent = `${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;

            if (!allowedTypes.includes(file.type)) {
                item.textContent += ' - Formato no permitido';
                item.style.color = 'red';
                isValid = false;
            }

            if (file.size > maxSize) {
                item.textContent += ' - Archivo demasiado grande';
                item.style.color = 'red';
                isValid = false;
            }

            fileList.appendChild(item);
        });

        if (!isValid) {
            fileError.textContent = 'Algunos archivos no cumplen con los requisitos';
            input.value = '';
        }

        return isValid;
    }

    function validateField(field, regex, errorId) {
        const errorElement = document.getElementById(errorId);
        if (regex.test(field.value)) {
            field.classList.add('valid');
            field.classList.remove('invalid');
            errorElement.style.display = 'none';
        } else {
            field.classList.add('invalid');
            field.classList.remove('valid');
            errorElement.style.display = 'block';
        }
    }

    function validateEmailMatch() {
        const email = document.getElementById('email');
        const confirm = document.getElementById('email-confirm');
        const error = document.getElementById('email-confirm-error');

        if (email.value === confirm.value && email.value !== '') {
            confirm.classList.add('valid');
            confirm.classList.remove('invalid');
            error.style.display = 'none';
        } else {
            confirm.classList.add('invalid');
            confirm.classList.remove('valid');
            error.style.display = 'block';
        }
    }

    // Botones navegación
    document.getElementById('next1').onclick = () => validarSeccion('section1') && goToSection(2);
    document.getElementById('next2').onclick = () => validarSeccion('section2') && goToSection(3);
    document.getElementById('next3').onclick = () => validarSeccion('section3') && goToSection(4);
    document.getElementById('next4').onclick = () => validarSeccion('section4') && goToSection(5);

    document.getElementById('prev2').onclick = () => goToSection(1);
    document.getElementById('prev3').onclick = () => goToSection(2);
    document.getElementById('prev4').onclick = () => goToSection(3);
    document.getElementById('prev5').onclick = () => goToSection(4);

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        if (checkFormCompletion()) {
            showLoading();
            setTimeout(() => {
                hideLoading();
                alert('¡Formulario enviado con éxito!');
            }, 3000);
        } else {
            alert('Por favor complete todos los campos requeridos antes de enviar.');
        }
    });

    form.addEventListener('input', () => {
        if (currentSection === totalSections) {
            checkFormCompletion();
        }
    });

    document.getElementById('declaracion').addEventListener('change', () => {
        if (currentSection === totalSections) checkFormCompletion();
    });

    // Validaciones dinámicas
    document.getElementById('numero-identificacion').addEventListener('input', function () {
        const tipo = document.getElementById('tipo-identificacion').value;
        const regex = tipo === 'identidad' ? /^\d{4}-\d{4}-\d{5}$/ : /^[A-Za-z0-9]{6,20}$/;
        validateField(this, regex, 'numero-identificacion-error');
    });

    document.getElementById('telefono').addEventListener('input', function () {
        const regex = /^[89]\d{3}-\d{4}$/;
        validateField(this, regex, 'telefono-error');
    });

    document.getElementById('email').addEventListener('input', function () {
        const regex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
        validateField(this, regex, 'email-error');
        validateEmailMatch();
    });

    document.getElementById('email-confirm').addEventListener('input', validateEmailMatch);

    document.getElementById('graduacion').addEventListener('input', function () {
        const year = parseInt(this.value);
        const currentYear = new Date().getFullYear();
        const errorElement = document.getElementById('graduacion-error');

        if (!isNaN(year) && year >= 1950 && year <= currentYear) {
            this.classList.add('valid');
            this.classList.remove('invalid');
            errorElement.style.display = 'none';
        } else {
            this.classList.add('invalid');
            this.classList.remove('valid');
            errorElement.style.display = 'block';
        }
    });

    // Hacer funciones globales
    window.showFiles = showFiles;
    window.removeFile = removeFile;
    window.validateFiles = validateFiles;
    window.validateField = validateField;
}
