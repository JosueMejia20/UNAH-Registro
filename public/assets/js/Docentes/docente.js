    // Datos simulados de clases asignadas
    const clases = [
      { id: 1, nombre: "Programacion 2" },
      { id: 2, nombre: "Bases de Datos" },
      { id: 3, nombre: "Lenguajes de Programacion" }
    ];

    const tabla = document.getElementById('tabla-clases');

    clases.forEach(clase => {
      const fila = document.createElement('tr');

      fila.innerHTML = `
        <td>${clase.nombre}</td>
        <td><a href="/descargar-estudiantes/${clase.id}">Descargar Lista</a></td>
        <td>
          <form class="subir-form" onsubmit="subirArchivo(event, ${clase.id}, 'video')">
            <input type="file" accept="video/*" required>
            <button class="action-btn btn-approve" type="submit">Subir</button>
          </form>
        </td>
        <td>
          <form class="subir-form" onsubmit="subirArchivo(event, ${clase.id}, 'pdf')">
            <input type="file" accept="application/pdf" required>
            <button class="action-btn btn-approve" type="submit">Subir</button>
          </form>
        </td>
      `;

      tabla.appendChild(fila);
    });

    function subirArchivo(e, claseId, tipo) {
      e.preventDefault();
      const archivo = e.target.querySelector('input[type="file"]').files[0];
      if (!archivo) return alert("Selecciona un archivo");

      // Aquí iría el envío al backend con FormData si tuvieras un servidor
      alert(`Archivo ${archivo.name} (${tipo}) subido para clase ID ${claseId}`);
      e.target.reset();
    }

    // Manejador de registro de docente
    document.getElementById("form-docente").addEventListener("submit", function (e) {
      e.preventDefault();
      alert("Docente registrado (simulado)");
      this.reset();
    });