const BASE_URL = "/api/Admisiones";

// Buscar solicitud por ID
export const buscarSolicitudPorId = async (id) => {
    try {
        const response = await fetch(`${BASE_URL}/buscarSolicitud/${id}`);
        if (!response.ok) throw new Error("Solicitud no encontrada");
        return await response.json();
    } catch (error) {
        console.error("Error al buscar solicitud:", error.message);
        return null;
    }
};

// Actualizar solicitud
export const actualizarSolicitud = async (id, datos) => {
    try {
        const response = await fetch(`${BASE_URL}/actualizarSolicitud/${id}`, {
            method: "PUT",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(datos)
        });

        return response.ok;
    } catch (error) {
        console.error("Error al actualizar solicitud:", error.message);
        return false;
    }
};

// Renderizar la solicitud completa en la vista
export const renderizarSolicitud = (data) => {
    const setTexto = (id, valor) => {
        const el = document.getElementById(id);
        if (el) el.textContent = valor;
    };

    // Información general
    setTexto("solicitudNumber", data.numero);
    setTexto("fechaSolicitud", data.fecha_solicitud);
    setTexto("statusBadge", data.estado);

    // Información personal
    setTexto("nombreCompleto", data.nombre);
    setTexto("numeroIdentificacion", data.identidad);
    setTexto("fechaNacimiento", data.fecha_nacimiento);
    setTexto("genero", data.genero);

    // Contacto
    setTexto("telefono", data.telefono);
    setTexto("email", data.email);
    setTexto("direccion", data.direccion);

    // Académica
    setTexto("centroRegional", data.centro);
    setTexto("carreraInteres", data.carrera);
    setTexto("institutoEducacion", data.instituto);
    setTexto("anioGraduacion", data.anio_graduacion);

    // Documentos (si también vienen)
    if (data.documentos && Array.isArray(data.documentos)) {
        const lista = document.getElementById("documentosList");
        lista.innerHTML = "";

        data.documentos.forEach(doc => {
            const li = document.createElement("li");
            li.innerHTML = `
                <a href="${doc.url}" target="_blank" class="document-link">
                    <i class="bi bi-file-earmark"></i> ${doc.nombre} (${doc.tipo}, ${doc.peso})
                </a>`;
            lista.appendChild(li);
        });
    }

    // Timeline de estado (si viene)
    if (data.historial && Array.isArray(data.historial)) {
        const timeline = document.querySelector(".timeline");
        timeline.innerHTML = "";

        data.historial.forEach(item => {
            const nodo = document.createElement("div");
            nodo.className = "timeline-item";
            nodo.innerHTML = `
                <div class="timeline-point"></div>
                <div class="timeline-content">
                    <h5>${item.titulo}</h5>
                    <p class="text-muted">${item.fecha}</p>
                    <p>${item.descripcion}</p>
                </div>`;
            timeline.appendChild(nodo);
        });
    }
};
