# Devuelve toda la informacion de un estudiante. Ejemplo de id de estudiante = 20201003849. Devuelve vacio si no hay nada
curl "http://localhost:3000/api/estudiantes/get/getInfoEstudiante?matricula=20201003849" | jq

