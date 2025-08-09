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
    cargarSeccionPorId,
    subirNota
} from '../../../../components/Docentes/subirNotas_Controller.mjs';

import {
    cargarEstudiantesLista
} from '../../../../components/Docentes/listaEstudiantes_Controller.mjs';

const params = new URLSearchParams(window.location.search);
const idSeccion = params.get("idSeccion");

const obtenerEstudiantes = async (id) => {
    const datos = await cargarEstudiantesLista(id);
    const seccion = await cargarSeccionPorId(id);

    console.log(datos);

    const tablaEstudiantes = document.getElementById("listaEstudiantes")
    tablaEstudiantes.innerHTML = ""
    datos.forEach(estudiante => {

        const fila = document.createElement("tr");

        fila.innerHTML = `
        <td>${estudiante.numero_cuenta}</td>
        <td>${estudiante.nombre_estudiante}</td>
        <td>${seccion[0].nombre_clase}</td>
        <td><input name="nota" type="number" class="action-btn" placeholder="Ingresar nota"></td>
        <td><button class="action-btn subir-btn">Guardar</button></td>
`;

        const boton = fila.querySelector('.subir-btn');
        boton.addEventListener('click', async (event) => {
            const fila = event.target.closest('tr');
            const nota = fila.querySelector('input[name="nota"]').value;

            if (!nota) {
                alert('Coloca una nota. pedazo de mamahuevo. Cambiar esto por una modal');
                return;
            }

            console.log('ID Estudiante:', estudiante.numero_cuenta);
            console.log('Nota:', nota);

            //logica para subir nota

            const datosJSON = {};

            datosJSON["idSeccion"] = idSeccion;
            datosJSON["idEstudiante"] = estudiante.numero_cuenta;
            datosJSON["nota"] = nota;

            console.log(datosJSON);

            try {
                const response = await subirNota(datosJSON);
                //const resultado = await response.json();

                if (response.success) {
                    alert('Recurso subido correctamente. Hacer modal aqui');
                    location.reload();
                } else {
                    alert('Error al subir recurso');
                }
            } catch (error) {
                alert('Error de conexión al subir recurso');
            }


        });

        tablaEstudiantes.appendChild(fila);
    })

};

document.addEventListener("DOMContentLoaded", function () {
    obtenerEstudiantes(idSeccion);
});
