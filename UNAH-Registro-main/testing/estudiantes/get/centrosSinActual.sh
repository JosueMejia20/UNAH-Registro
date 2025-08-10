# Devuelve todos los centros regionales, menos el centro regional del estudiante. Ejemplo de id de estudiante = 20201003849. Devuelve vacio si no hay nada
curl http://localhost:3000/api/estudiantes/get/centrosSinActual?matricula=20201003849 | jq

