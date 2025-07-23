# Devuelve todas las solicitudes (Cambio Centro, Carrera, Cancelacion y Pago Repo) de un estudiante. Devuelve vacio si no hay nada
curl "http://localhost:3000/api/estudiantes/get/solicitudesRecientes?matricula=20201003849" | jq

#  Ejemplo estudiante = 20201003849.