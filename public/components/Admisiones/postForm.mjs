const BASE_URL = '/api/admisiones';

// admisiones_controller.mjs

// Convierte un archivo a base64
const toBase64 = file => new Promise((resolve, reject) => {
  const reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = () => resolve(reader.result);
  reader.onerror = reject;
});

// Captura el formulario como JSON y lo muestra en un div de prueba
export const capturarYPrevisualizarFormulario = async (formId, previewId) => {
  const form = document.getElementById(formId);
  const preview = document.getElementById(previewId);

  if (!form || !preview) {
    console.error(`No se encontró el formulario (${formId}) o el contenedor de previsualización (${previewId})`);
    return;
  }

  const formData = new FormData(form);
  const datosJSON = {};

  for (const [key, value] of formData.entries()) {
    if (value instanceof File && value.name) {
      datosJSON[key] = await toBase64(value); // Archivo como base64
    } else {
      datosJSON[key] = value;
    }
  }

  preview.style.display = 'block';
  preview.textContent = JSON.stringify(datosJSON, null, 2);


  const response = await fetch(`${BASE_URL}/post/insertPostulanteInscripcion/index.php`, {
    method: "POST",
    headers:{
        "Content-Type": "application/json"
    },
    body: JSON.stringify(datosJSON)
  }).then(response => response.json());

  // Devuelve el JSON
   return datosJSON;
};