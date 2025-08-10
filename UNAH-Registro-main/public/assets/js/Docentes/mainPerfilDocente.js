// ==========================
// IMPORTACIÓN DE COMPONENTES Y CONTROLADORES
// ==========================
import { UnahNavbar } from "../../../components/navbar.mjs";
customElements.define("unah-navbar", UnahNavbar);

import { Cargando, loadingEvent } from "../../../components/loading.mjs";
customElements.define("pantalla-de-carga", Cargando);
loadingEvent();

import { UnahFooter } from "../../../components/footer.mjs";
customElements.define("unah-footer", UnahFooter);

import { UnahSidebar } from "../../../components/sidebar.mjs";
customElements.define("unah-sidebar", UnahSidebar);

// -------- Controlador del Perfil Docentes - Docentes --------
import {
    obtenerInfoDocente,
    subirFotoDocente,
    obtenerFotoDocente,
    validarCredenciales
} from '../../../../components/Docentes/perfilDocentes_Controller.mjs';

import {
    obtenerNumeroEmpleado
} from '../../../../components/Docentes/numeroEmpleado_Controller.mjs';

const idDocente = await obtenerNumeroEmpleado(usuarioId);

const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = reject;
});

const asignarImagenBase64 = (imgTag, base64String, mime = 'image/jpeg') => {
    imgTag.src = base64String
        ? `data:${mime};base64,${base64String}`
        : 'https://via.placeholder.com/300x400?text=Sin+Documento';
};



const cargarDatosDocente = async () => {
    const datos = await obtenerInfoDocente(idDocente);
    const foto = await obtenerFotoDocente(idDocente);

    console.log(foto);

    const fotoPerfil = document.getElementById('foto-perfil-docente');
    const numeroEmpleado = document.getElementById('numero-empleado');
    const correoInstitucional = document.getElementById('correo-institucional');
    const cargos = document.getElementById('cargos');
    const centroRegional = document.getElementById('centro-regional');
    const nombreDocente = document.getElementById('nombre-docente');
    const facultad = document.getElementById('facultad');
    const departamento = document.getElementById('departamento');

    console.log(datos);

    numeroEmpleado.innerHTML = `<span class="label">ID de docente:</span> ${datos[0].numero_empleado}`;
    correoInstitucional.innerHTML = `<span class="label">Correo:</span> ${datos[0].correo_institucional}`;
    cargos.innerHTML = `<span class="label">Cargo:</span> ${datos[0].cargos}`;
    centroRegional.innerHTML = `<span class="label">Centro universitario:</span> ${datos[0].centro_regional}`;
    nombreDocente.innerHTML = `${datos[0].nombre_completo}`;
    facultad.innerHTML = `<span class="label">Facultad:</span>${datos[0].nombre_facultad}`;
    departamento.innerHTML = `<span class="label">Nivel Academico:</span>${datos[0].nombre_departamento}`;


    if (foto != null) {
        asignarImagenBase64(fotoPerfil, foto[0].foto_perfil);
    }
}

const btnSubirFoto = document.getElementById('btn-subir-foto');
const form = document.getElementById('formSubirFoto');

window.onload = function(){
    // Cargar los recursos del docente al inicio
    cargarDatosDocente();

    btnSubirFoto?.addEventListener('click', () => {
        const modal = new bootstrap.Modal(document.getElementById('modalSubirFoto'));
        modal.show();
    });

    form?.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        const datosJSON = {};

        formData.append('idDocente', idDocente);

        console.log(formData);


        for (const [key, value] of formData.entries()) {
            if (value instanceof File && value.name) {
                datosJSON[key] = await toBase64(value);
            } else {
                datosJSON[key] = value;
            }
        }

        console.log(datosJSON);

        try {
            const response = await subirFotoDocente(datosJSON);
            //const resultado = await response.json();

            if (response.success) {
                alert('Foto subida correctamente');
                bootstrap.Modal.getInstance(document.getElementById('modalSubirFoto'))?.hide();
                location.reload();
            } else {
                alert('Error al subir foto');
            }
        } catch (error) {
            alert('Error de conexión al subir foto.');
        }
    });
}


//document.addEventListener('DOMContentLoaded', function () {
    
//});
