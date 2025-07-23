# Recupera todas las asignaturas del periodo actual que imparte el docente con id=1002. Devuelve vacio si no hay nada
curl http://localhost:3000/api/estudiantes/get/asignaturasDocente?idDocente=1002 | jq
