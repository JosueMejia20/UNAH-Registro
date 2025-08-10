# Devuelve todos los mensajes segun el estudiante y el contacto con el que esta hablando. Devuelve vacio si no hay nada
curl "http://localhost:3000/api/estudiantes/get/mensajes?estudiante_id=20201003849&contacto_id=20201004567" | jq

#  Ejemplo estudiante = 20201003849. Ejemplo contacto = 20201004567