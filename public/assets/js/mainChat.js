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

// Importar modal
import { UnahModal } from "../../components/modal.mjs";
customElements.define("unah-modal", UnahModal);
const modal = document.querySelector("unah-modal");

// document.body.appendChild(modal);

// -------- Controlador del Chat --------
import {
    cargarContactos,
    cargarMensajes,
    cargarSolicitudesContacto,
    aceptarSolicitudContacto,
    rechazarSolicitudContacto,
    insertMensaje,
    enviarSolicitudContacto
} from '../../components/Estudiantes/chat_Controller.mjs';

// INICIALIZACION DE VARIABLES Y FUNCIONES
function obtenerMatriculaDesdeSesion() {
  return sessionStorage.getItem('matricula') || '20201003849';
}
const matriculaEstudiante = sessionStorage.getItem('matricula') || '20201003849';
let contactoSeleccionadoId = null;

// ==========================
// EVENTO - ABRIR MODAL AGREGAR AMIGO
// ==========================
const btnAgregarAmigo = document.getElementById('agregarAmigoBtn');
const formAgregarAmigo = document.getElementById('formAgregarAmigo');
btnAgregarAmigo?.addEventListener('click', () => {
  const modalBootstrap = new bootstrap.Modal(document.getElementById('modalAgregarAmigo'));
  modalBootstrap.show();
});

formAgregarAmigo?.addEventListener('submit', async (e) => {
  e.preventDefault();
  const formData = new FormData(formAgregarAmigo);
  const datosJSON = {};

  formData.append('emisor_id', matriculaEstudiante);

  for (const [key, value] of formData.entries()) {
      datosJSON[key] = value;
  }

  try {
    const response = await enviarSolicitudContacto(datosJSON);

    if (response.success) {
      modal.show('Solicitud enviada correctamente', () => {
        bootstrap.Modal.getInstance(document.getElementById('modalAgregarAmigo'))?.hide();
        location.reload();
      });
    } else {
      modal.show('Error al enviar solicitud');
    }
  } catch (error) {
    modal.show('Error de conexión al enviar solicitud.');
  }
});

// ==========================
// MOSTRAR CONTACTOS
// ==========================
const mostrarContactos = async (idEstudiante,listaContactos) => {
    const contactos = await cargarContactos(idEstudiante);
    if (!listaContactos) return;

    listaContactos.innerHTML = "";
    contactos.forEach(contacto => {
        const item = document.createElement("a");
        item.href = "#";
        item.className = "list-group-item list-group-item-action";

        item.innerHTML = `
            <div class="d-flex align-items-center">
                
                <div>
                    <h6 class="mb-0">${contacto.nombre_completo}</h6>
                    <small></small>
                </div>
                <span class="badge bg-white text-dark ms-auto"></span>
            </div>
        `;

        item.addEventListener("click", () => {
            mostrarMensajes(idEstudiante, contacto.contacto_id);
            contactoSeleccionadoId = contacto.contacto_id;
        });

        listaContactos.appendChild(item);
    });
};

// ==========================
// MOSTRAR MENSAJES
// ==========================
const mostrarMensajes = async (idEstudiante, contactoId) => {
  const chatContainer = document.querySelector("#contenedorChat");
  const headerNombre = document.querySelector("#headerMensaje");

  const mensajes = await cargarMensajes(idEstudiante, contactoId);

  // Para encontrar el nombre del contacto
  const mensaje = mensajes.find(m => m.receptor_id === contactoId);
  const nombreContacto = mensaje ? mensaje.nombre_receptor : '';

  // Actualiza encabezado
  headerNombre.textContent = nombreContacto;

  // Limpia chat
  chatContainer.innerHTML = "";

  // Renderiza mensajes
  mensajes.forEach(mensaje => {
    const esEmisor = mensaje.emisor_id === idEstudiante;

    const mensajeHTML = `
      <div class="chat-message mb-3">
        <div class="d-flex ${esEmisor ? 'justify-content-end' : 'justify-content-start'}">
          ${!esEmisor ? `<div></div>` : ""}
          <div>
            <div class="${esEmisor ? 'bg-primary text-white' : 'bg-white'} p-3 rounded" style="max-width: 100%;">
              <p class="mb-0">${mensaje.contenido}</p>
            </div>
            <small class="text-muted ${esEmisor ? 'd-block text-end' : ''}">${formatearHora(mensaje.fecha_envio)}</small>
          </div>
        </div>
      </div>
    `;

    chatContainer.innerHTML+=mensajeHTML;
  });
};

// Función para formatear hora
function formatearHora(fechaCompleta) {
  const fecha = new Date(fechaCompleta);
  return fecha.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
}

// ==========================
// MOSTRAR SOLICITUDES CONTACTO
// ==========================
const mostrarSolicitudesContacto = async (idEstudiante, listaSolicitudes) => {
    const solicitudes = await cargarSolicitudesContacto(idEstudiante);

    listaSolicitudes.innerHTML='';

    solicitudes.forEach(solicitud => {
        const li = document.createElement('li');
        li.className = 'list-group-item d-flex justify-content-between align-items-center';
        
        li.innerHTML = `
            <div>
              <strong>#${solicitud.nombre_completo_emisor}</strong><br>
              <small>${solicitud.correo_institucional_emisor}</small>
            </div>
            <div>
              <button class="btn btn-sm btn-success btn-aceptar" data-id="${solicitud.solicitud_id}">Aceptar</button>
              <button class="btn btn-sm btn-danger btn-rechazar" data-id="${solicitud.solicitud_id}">Rechazar</button>
            </div>
        `;

        listaSolicitudes.appendChild(li);

        // Eventos para aceptar o rechazar solicitud
        const btnAceptar = li.querySelector('.btn-aceptar');
        const btnRechazar = li.querySelector('.btn-rechazar');

        btnAceptar.addEventListener('click', async () => {
            const solicitudId = btnAceptar.getAttribute('data-id');
            const response = await aceptarSolicitudContacto(solicitudId);

            if(response.success){
                modal.show('Solicitud aceptada correctamente', () => location.reload());
            } else{
                modal.show('Error al aceptar solicitud');
            }
        });

        btnRechazar.addEventListener('click', async () => {
            const solicitudId = btnRechazar.getAttribute('data-id');
            const response = await rechazarSolicitudContacto(solicitudId);

            if(response.success){
                modal.show('Solicitud rechazada correctamente', () => location.reload());
            } else{
                modal.show('Error al rechazar solicitud');
            }
        });
    });
};

// ==========================
// ENVIAR MENSAJE
// ==========================
const enviarMensaje = async(idEstudiante) => {
    document.getElementById('enviarMensajeBtn').addEventListener('click', async()=>{
        const mensaje = document.getElementById('inputMensaje').value.trim();

        const response = await insertMensaje(mensaje, idEstudiante, contactoSeleccionadoId);

        if(response.success){
            document.getElementById('inputMensaje').value='';
            await mostrarMensajes(idEstudiante, contactoSeleccionadoId);
        } else{
            modal.show('Error al enviar mensaje.');
        }
    });
}

// ==========================
// INICIALIZAR VISTA
// ==========================
document.addEventListener('DOMContentLoaded', async () => {
    const listaContactos = document.querySelector("#listaContactos");
    const contenedorChat = document.querySelector("#contenedorChat");
    const listaSolicitudes = document.querySelector("#listaSolicitudes");

    mostrarContactos(matriculaEstudiante, listaContactos);
    mostrarSolicitudesContacto(matriculaEstudiante, listaSolicitudes);
    enviarMensaje(matriculaEstudiante);
});
