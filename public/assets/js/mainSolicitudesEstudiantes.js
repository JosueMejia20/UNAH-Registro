// ==========================
// IMPORTACIÓN DE COMPONENTES Y CONTROLADORES
// ==========================
import { UnahNavbar } from "/../../components/navbar.mjs";
customElements.define("unah-navbar", UnahNavbar);

import { Cargando, loadingEvent } from "../../components/loading.mjs";
customElements.define("pantalla-de-carga", Cargando);
loadingEvent();

import { UnahFooter } from "/../../components/footer.mjs";
customElements.define("unah-footer", UnahFooter);

import { UnahSidebar } from "/../../components/sidebar.mjs";
customElements.define("unah-sidebar", UnahSidebar);

// -------- Controlador de la Solicitud --------
import {
    cargarCarreraSinActual,
    cargarCentroRegionalSinActual,
    guardarSolicitudCambioCarrera,
    guardarSolicitudCambioCentro,
    guardarSolicitudPagoRepo,
    cargarSolicitudes,
    cargarSeccionesCancelacion,
    guardarSolicitudCancelacion
} from '../../components/Estudiantes/solicitudes_Controller.mjs';

// -------- Controlador del PERFIL --------
import {
  obtenerMateriasActuales
} from '../../components/Estudiantes/perfil_Controller.mjs';

// INICIALIZACION DE VARIABLES Y FUNCIONES
//let perfilGlobal = null;

function obtenerMatriculaDesdeSesion() {
  return sessionStorage.getItem('matricula') || '20201003849';
}
const matriculaEstudiante = sessionStorage.getItem('matricula') || '20201003849';

const mostrarSolicitudesRecientes = async (idEstudiante,tablaSolicitudes) => {
    const solicitudes = await cargarSolicitudes(idEstudiante);
    if (!tablaSolicitudes) return;
    console.log(solicitudes);
    tablaSolicitudes.innerHTML = "";
    solicitudes.forEach(solicitud => {
      const fila = document.createElement("tr");
      fila.innerHTML = `
        <td>#${solicitud.id}</td>
        <td>${solicitud.tipo_solicitud}</td>
        <td>${solicitud.fecha_solicitud}</td>
        <td><span class="badge bg-warning">${solicitud.estado}</span></td>
        <td>
            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
            <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-print"></i></button>
        </td>
      `;
      tablaSolicitudes.appendChild(fila);
    });
  };

const toBase64 = file => new Promise((resolve, reject) => {
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = () => resolve(reader.result);
      reader.onerror = reject;
    });

document.addEventListener('DOMContentLoaded', async () => {
    
    
    const tablaBodySolicitudes = document.querySelector("#tablaBodySolicitudes");

    const selectCarreraNueva = document.querySelector("#carreraNueva");
    const selectCentroNuevo = document.querySelector("#centroNuevo");


    mostrarSolicitudesRecientes(matriculaEstudiante, tablaBodySolicitudes);



    /**
     * Cambio de Carrera
     */
    const cambioCarreraBtn = document.querySelector("#cambioCarreraBtn");
    const formCambioCarrera = document.querySelector("#formCambioCarrera");
    const modalCambioDeCarrera = document.querySelector("#modalCambioDeCarrera");
    cambioCarreraBtn?.addEventListener('click', () => {
        cargarCarreraSinActual(matriculaEstudiante, selectCarreraNueva);
        const modal = new bootstrap.Modal(modalCambioDeCarrera);
        modal.show();
    });

    formCambioCarrera?.addEventListener('submit', async (e) => {
          e.preventDefault();
          const formData = new FormData(formCambioCarrera);
          const datosJSON = {};
    
          formData.append('matricula', matriculaEstudiante);
    
          console.log(formData);
    
    
        for (const [key, value] of formData.entries()) {
            datosJSON[key] = value;
        }
    
        console.log(datosJSON);
    
          try {
            const response = await guardarSolicitudCambioCarrera(datosJSON);
    
            if (response.success) {
              alert('Solicitud registrada correctamente');
              bootstrap.Modal.getInstance(modalCambioDeCarrera)?.hide();
              location.reload();
            } else {
              alert('Error al enviar solicitud');
            }
          } catch (error) {
            alert('Error de conexión al enviar solicitud');
          }
        });

    /**
    * Cambio Centro
    */
   const cambioCentroBtn = document.querySelector("#cambioCentroBtn");
   const formCambioCentro = document.querySelector("#formCambioCentro");
    const modalCambioCentro = document.querySelector("#modalCambioCentro");
   cambioCentroBtn?.addEventListener('click', () => {
        cargarCentroRegionalSinActual(matriculaEstudiante, selectCentroNuevo);
        const modal = new bootstrap.Modal(modalCambioCentro);
        modal.show();
    });

    formCambioCentro?.addEventListener('submit', async (e) => {
          e.preventDefault();
          const formData = new FormData(formCambioCentro);
          const datosJSON = {};
          formData.append('matricula', matriculaEstudiante);
          console.log(formData);
    
    
        for (const [key, value] of formData.entries()) {
            datosJSON[key] = value;
        }
    
        console.log(datosJSON);
    
          try {
            const response = await guardarSolicitudCambioCentro(datosJSON);
            //const resultado = await response.json();
    
            if (response.success) {
              alert('Solicitud registrada correctamente');
              bootstrap.Modal.getInstance(modalCambioCentro)?.hide();
              location.reload();
            } else {
              alert('Error al enviar solicitud');
            }
          } catch (error) {
            alert('Error de conexión al enviar solicitud');
          }
        });



    /**
     * Pago de Reposicion
     */
    const pagoReposicionBtn = document.querySelector("#pagoReposicionBtn");
    const formPagoRepo = document.querySelector("#formPagoRepo");
    const modalPagoRepo = document.querySelector("#modalPagoRepo");
   pagoReposicionBtn?.addEventListener('click', () => {
       // No necesita cargar datos.
        const modal = new bootstrap.Modal(modalPagoRepo);
        modal.show();
    });

    formPagoRepo?.addEventListener('submit', async (e) => {
          e.preventDefault();
          const formData = new FormData(formPagoRepo);
          const datosJSON = {};
    
          formData.append('matricula', matriculaEstudiante);
    
          console.log(formData);
    
    
        for (const [key, value] of formData.entries()) {
            datosJSON[key] = value;
        }
    
        console.log(datosJSON);
    
          try {
            const response = await guardarSolicitudPagoRepo(datosJSON);
            //const resultado = await response.json();
    
            if (response.success) {
              alert('Solicitud registada correctamente');
              bootstrap.Modal.getInstance(modalPagoRepo)?.hide();
              location.reload();
            } else {
              alert('Error al enviar solicitud');
            }
          } catch (error) {
            alert('Error de conexión al enviar solicitud');
          }
        });


    /**
     * Cancelacion Excepcional
     */
    const cancelacionExcepcionalBtn = document.querySelector("#cancelacionExcepcionalBtn");
    const formCancelacionExcep = document.querySelector("#formCancelacionExcep");
    const modalCancelacionExcep = document.querySelector("#modalCancelacionExcep");
    const datosSecciones = await obtenerMateriasActuales(matriculaEstudiante);
    const selectSecciones = document.querySelector("#selectSeccionesCancelar");
   cancelacionExcepcionalBtn?.addEventListener('click', () => {
        cargarSeccionesCancelacion(datosSecciones,selectSecciones);
       console.log(datosSecciones);
        const modal = new bootstrap.Modal(modalCancelacionExcep);
        modal.show();
    });

    formCancelacionExcep?.addEventListener('submit', async (e) => {
          e.preventDefault();
          const formData = new FormData(formCancelacionExcep);
          const datosJSON = {};
          formData.append('matricula', matriculaEstudiante);
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
            const response = await guardarSolicitudCancelacion(datosJSON);
            //const resultado = await response.json();
    
            console.log(response);

            if (response.success) {
              alert('Solicitud registrada correctamente');
              //const nuevoPerfil = await obtenerPerfilEstudiante(matriculaEstudiante);
              //mostrarPerfilEnVista(nuevoPerfil);
              bootstrap.Modal.getInstance(modalCancelacionExcep)?.hide();
              location.reload();
            } else {
              alert('Error al enviar solicitud');
            }
          } catch (error) {
            alert('Error de conexión al enviar solicitud');
          }
        });






});