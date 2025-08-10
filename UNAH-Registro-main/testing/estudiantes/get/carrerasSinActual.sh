# Devuelve todas las carreras del centro regional segun el estudiante, menos la carrera en la que esta inscrito el estudiante. Ejemplo de id de estudiante = 20201003849. Devuelve vacio si no hay nada
curl http://localhost:3000/api/estudiantes/get/carrerasSinActual?matricula=20201003849 | jq

