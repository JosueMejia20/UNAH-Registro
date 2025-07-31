// -------- Controlador del Chat --------
import {
    cargarTipoRecurso,
    subirRecurso,
    cargarClasesDocente,
    cargarRecursos,
    recursoDetalle,
    recursoPortadaArchivo,
    editarRecurso,
    eliminarRecurso,
    validarCredenciales
} from '../../../components/Biblioteca/biblioteca_Controller.mjs';


const idDocente = sessionStorage.getItem('idDocente') || '1002';

function separarTags(cadena) {
    if (!cadena) return [];

    return cadena
        .split(',')
        .map(tag => tag.trim())
        .filter(tag => tag.length > 0);
}


const btnSubirRecurso = document.getElementById('subirRecursoModalBtn');
const formSubirRecurso = document.getElementById('formSubirRecurso');
btnSubirRecurso?.addEventListener('click', () => {
    const modal = new bootstrap.Modal(document.getElementById('subirRecursoModal'));
    modal.show();
    cargarTipoRecurso();
    cargarClasesDocente(idDocente);
});

const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = reject;
});

formSubirRecurso?.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(formSubirRecurso);
    const datosJSON = {};

    //Comentado porque ya se inserta la foto cuando se hace newFormData. Descongelar cuando sea necesario
    //const archivo = document.getElementById('foto_perfil')?.files[0];
    //if (archivo) formData.append('foto_perfil', archivo);

    formData.append('idDocente', idDocente);

    console.log(formData);


    for (const [key, value] of formData.entries()) {
        if (value instanceof File && value.name) {
            datosJSON[key] = await toBase64(value);
        } else {
            if ((key == 'autores') || (key == 'tags')) {
                datosJSON[key] = separarTags(value);
            } else {
                datosJSON[key] = value;
            }
        }
    }

    console.log(datosJSON);

    try {
        const response = await subirRecurso(datosJSON);
        //const resultado = await response.json();

        if (response.success) {
            alert('Recurso subido correctamente');
            //const nuevoPerfil = await obtenerPerfilEstudiante(matriculaEstudiante);
            //mostrarPerfilEnVista(nuevoPerfil);
            bootstrap.Modal.getInstance(document.getElementById('subirRecursoModal'))?.hide();
            location.reload();
        } else {
            alert('Error al actualizar perfil');
        }
    } catch (error) {
        alert('Error de conexión al actualizar perfil.');
    }
});


// Función para confirmar eliminación de recurso
const confirmarEliminacion = async (id) => {
    const modal = new bootstrap.Modal(document.getElementById('confirmarEliminarModal'));
    modal.show();

    document.getElementById('confirmarEliminarBtn').addEventListener("click", async () => {
        const respuesta = await eliminarRecurso(id);
        
        if (respuesta.success) {
            alert("Recurso eliminado correctamente.");
            location.reload();
        } else {
            alert(respuesta.mensaje || "No se pudo eliminar.");
        }     
    });
}

// Función para cargar los recursos del docente
const cargarRecursosDetalle = async () => {
    const misRecursos = await cargarRecursos();
    //const misRecursos = document.querySelectorAll('.recurso-card[data-propietario="true"]');
    const gridMisRecursos = document.getElementById('gridRecursos');

    console.log(misRecursos);

    if (!misRecursos) return;
    if (misRecursos.length > 0) {
        gridMisRecursos.innerHTML = '';
        misRecursos.forEach(recurso => {
            //tagsString = recurso.tags;
            const tagsArray = separarTags(recurso.tags);
            console.log(tagsArray);

            const tagsHTML = tagsArray.map(tag => `<span class="badge badge-tag me-1">${tag}</span>`).join('');

            const html = `
                    <div id="colRecurso" class="col">
                        <div class="card h-100 shadow-sm recurso-card" data-cursos="1, 3" data-busqueda="${recurso.titulo}, ${recurso.tags}" data-categoria="${recurso.tipo_recurso}">
                            <div class="portada-container">
                                <img src="data:image/jpeg;base64,${recurso.portada}">
                                <div class="position-absolute top-0 end-0 p-2 d-flex gap-1">
                                    <button class="btn btn-warning btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center editar-btn" style="width: 30px; height: 30px;" data-id-editar="${recurso.id}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center eliminar-btn" style="width: 30px; height: 30px;" data-id-eliminar="${recurso.id}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">${recurso.titulo}</h5>
                                <p class="card-text small text-muted">${recurso.autores}</p>
                                <p class="small text-muted"><i class="bi bi-calendar me-1"></i>${recurso.anio}</p>
                                
                                <p class="card-text small text-truncate">${recurso.descripcion}</p>
                                
                                <div class="border-top pt-2 mt-2">
                                    <div class="mb-2">
                                        ${tagsHTML}
                                    </div>
                                    <button class="btn btn-outline-unah-blue btn-sm w-100 ver-recurso" data-id="${recurso.id}">
                                        <i class="bi bi-eye me-1"></i> Ver documento
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
            //const clone = recurso.cloneNode(true);
            //gridMisRecursos.appendChild(clone);
            gridMisRecursos.innerHTML += html;
        });
        document.querySelectorAll('.ver-recurso').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                verRecurso(id);
            });
        });
        document.querySelectorAll('.eliminar-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id-eliminar');
                confirmarEliminacion(id);
            });
        });

        document.querySelectorAll('.editar-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id-editar');
                cargarDatosEdicion(id);
            });
        });

    } else {
        gridMisRecursos.innerHTML = '';
    }
}

// Función para ver un recurso
const verRecurso = async (id) => {
    const recurso = await recursoDetalle(id);
    console.log(recurso);
    document.getElementById('visorPdfModalTitle').textContent = recurso[0].titulo;
    document.getElementById('pdfMetadata').textContent = `Autores: ${recurso[0].autores}`;
    document.getElementById('pdfViewer').src = `data:application/pdf;base64,${recurso[0].archivo}`;

    // Mostrar el modal
    const modal = new bootstrap.Modal(document.getElementById('visorPdfModal'));
    modal.show();
}

const editarFormulario = async(form,id) => {
    form?.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const datosJSON = {};
    formData.append('idDocente', idDocente);

    const idRecurso = id;
    const portadaArchivo = await recursoPortadaArchivo(idRecurso);
    //console.log(portadaArchivo);

    const portada = formData.get('edit_portada');
    const archivo = formData.get('edit_archivo');

    //console.log(portada);
    if(portada.size === 0 ){
        formData.set('edit_portada',portadaArchivo[0].portada);
    }
    if(archivo.size === 0 ){
        formData.set('edit_archivo',portadaArchivo[0].archivo);
    }

    //console.log(formData);

    


    for (const [key, value] of formData.entries()) {
        if (value instanceof File && value.name) {
            datosJSON[key] = await toBase64(value);
        } else {
            if ((key == 'edit_autores') || (key == 'edit_tags')) {
                datosJSON[key] = separarTags(value);
            } else {
                datosJSON[key] = value;
            }
        }
    }

    console.log(datosJSON);

    try {
        const response = await editarRecurso(datosJSON);

        if (response.success) {
            alert('Recurso actualizado correctamente');
            bootstrap.Modal.getInstance(document.getElementById('editarRecursoModal'))?.hide();
            location.reload();
        } else {
            alert('Error al actualizar recurso');
        }
    } catch (error) {
        alert('Error de conexión al actualizar recurso.');
    }
});
};

const cargarDatosEdicion = async (id) =>{
    const formEditarRecurso = document.getElementById('formEditarRecurso');
    const modal = new bootstrap.Modal(document.getElementById('editarRecursoModal'));
    modal.show();
    cargarTipoRecurso();
    cargarClasesDocente(idDocente);

    const recurso = await recursoDetalle(id);

    console.log(recurso)

    document.getElementById('edit_titulo').value = recurso[0].titulo;
    document.getElementById('edit_autores').value = recurso[0].autores;
    document.getElementById('edit_anio').value = recurso[0].anio;
    document.getElementById('edit_categoria').value = recurso[0].categoria;
    document.getElementById('edit_descripcion').value = recurso[0].descripcion;
    document.getElementById('edit_tags').value = recurso[0].tags;
    document.getElementById('recurso_id').value = id;

    editarFormulario(formEditarRecurso,id);
}

document.addEventListener('DOMContentLoaded', function () {
    // Cargar los recursos del docente al inicio
    cargarRecursosDetalle();
});





//login
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');
    const btnLogin = form.querySelector('.btn-login');
    const spinner = form.querySelector('.spinner-border');
    const btnText = form.querySelector('.btn-text');
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    // Mostrar u ocultar contraseña
    togglePassword.addEventListener('click', () => {
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;
        togglePassword.innerHTML = type === 'password'
            ? '<i class="bi bi-eye-fill"></i>'
            : '<i class="bi bi-eye-slash-fill"></i>';
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Validación del formulario Bootstrap
        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        // Activar spinner
        btnLogin.disabled = true;
        spinner.classList.remove('d-none');
        btnText.textContent = 'Validando...';

        const cuenta = document.getElementById('email').value.trim();
        const contrasena = document.getElementById('password').value;
        
        const resultado = await validarCredenciales(cuenta, contrasena);

        // Quitar spinner
        btnLogin.disabled = false;
        spinner.classList.add('d-none');
        btnText.textContent = 'Ingresar';

      /*  if (!resultado.success) {
            alert(resultado.message || 'Credenciales inválidas');
            return;
        }
*/
        if (resultado.success) {
            btnLogin.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i> Bienvenido';
            btnLogin.classList.add('btn-success');

            setTimeout(() => {
            alert("Acceso exitoso. Redirigiendo...");
            window.location.href = "../../../biblioteca/biblioteca.php";
        }, 1000);
      } else {
            btnText.textContent = "Ingresar";
            spinner.classList.add('d-none');
            btnLogin.disabled = false;
            alert("Credenciales incorrectas. Intente de nuevo.");
      }

    });
});