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

import {
    obtenerInfoDocente,
    obtenerFotoDocente
} from '../../../../components/Docentes/perfilDocentes_Controller.mjs';

import {
    obtenerNumeroEmpleado
} from '../../../../components/Docentes/numeroEmpleado_Controller.mjs';

import {
    obtenerInfoAsignatura
} from '../../../../components/Docentes/asignaturaDocente.mjs';

import {
    obtenerIntroduccionPorDocente,
    insertarIntroduccionClase
} from '../../../../components/Docentes/introduccionClase_Controller.mjs';

const idDocente = await obtenerNumeroEmpleado(usuarioId);

const cargarDatosDocente = async () => {
    const datos = await obtenerInfoDocente(idDocente);
    const foto = await obtenerFotoDocente(idDocente);


    const nombreDocente = document.getElementById('nombreDocente');

    nombreDocente.innerHTML = `${datos[0].nombre_completo}`;
}


const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = reject;
});

function combinarJSONs(introducciones, secciones) {
    // Creacion de set con las introducciones
    const seccionesConIntroduccion = new Set(
        introducciones.map(item => item.seccion_id)
    );

    // Creacion del JSON, obtener el id de seccion y comparar con .has (para ello se uso el set y el map)
    //Para iterar cada item con el map y teniendo la seccion. Con el tipo set podemos acceder a metodos como has (tambien los tipo map)
    const resultado = secciones.map(seccion => ({
        id: seccion.id,
        subido: seccionesConIntroduccion.has(seccion.id)
    }));

    return resultado;
}

const cargarAsignaturaDocente = async () => {
    const datos = await obtenerInfoAsignatura(idDocente);
    const introducciones = await obtenerIntroduccionPorDocente(idDocente);
    //console.log(datos);
    const jsonRecursosSubidos = combinarJSONs(introducciones, datos);
    console.log(jsonRecursosSubidos);
    const tablaAsignaturas = document.getElementById("tabla-clases")
    tablaAsignaturas.innerHTML = ""
    datos.forEach(asignatura => {


        const fila = document.createElement("tr");

        const estadoSubida = jsonRecursosSubidos.find(item => item.id === asignatura.id);
        const yaSubido = estadoSubida ? estadoSubida.subido : false;

        let botonHTML = '';

        console.log(yaSubido);

        if (yaSubido) {
            //CONSIDERAR CAMBIARLO POR UN BOTON PARA EDITAR
            botonHTML = `<button class="action-btn" disabled style="background-color: gray; cursor: not-allowed;">Ya Subido</button>`;

        } else {
            botonHTML = `<button class="action-btn btn-approve subir-btn" data-asignatura="${asignatura.id}" type="button">Subir</button>`;
        }



        fila.innerHTML = `
            <td>${asignatura.nombre_clase}</td>
            <td>${asignatura.codigo_seccion}</td>
            <td>
                <input type="url" name="video" placeholder="Enlace de YouTube" data-asignatura="${asignatura.id}" required>
            </td>
            <td>
                <input type="file" name="pdf" accept="application/pdf" data-asignatura="${asignatura.id}" required>
            </td>
            <td>
                ${botonHTML}
            </td>
        `;

        if (!yaSubido) {
            const boton = fila.querySelector('.subir-btn');
            boton.addEventListener('click', async (event) => {
                const fila = event.target.closest('tr');
                const URLvideo = fila.querySelector('input[name="video"]').value.trim();
                const pdf = fila.querySelector('input[name="pdf"]').files[0];

                if (!URLvideo || !pdf) {
                    alert('Debes colocar la URL de un video y subir un archivo en formato PDF.');
                    return;
                }

                console.log('ID Asignatura:', asignatura.id);
                console.log('URL Video:', URLvideo);
                console.log('PDF:', pdf);

                //logica para subir archivos

                const datosJSON = {};

                const base64PDF = await toBase64(pdf);

                datosJSON["idSeccion"] = asignatura.id;
                datosJSON["linkVideo"] = URLvideo
                datosJSON["base64PDF"] = base64PDF;

                console.log(datosJSON);

                try {
                    const response = await insertarIntroduccionClase(datosJSON);
                    //const resultado = await response.json();

                    if (response.success) {
                        alert('Recurso subido correctamente.');
                        location.reload();
                    } else {
                        alert('Error al subir recurso');
                    }
                } catch (error) {
                    alert('Error de conexión al subir recurso');
                }


            });
        }


        tablaAsignaturas.appendChild(fila);


    })
}

window.onload = function () {
    cargarDatosDocente();
    cargarAsignaturaDocente();
}

