#  Devuelve todos los departamentos de la clases del plan de estudios (Clase_Carrera) segun la carrera del estudiante. Ejemplo de id de estudiante = 20201003849. Devuelve vacio si no hay nada
curl "http://localhost:3000/api/estudiantes/get/getDeptPorClaseCarrera?estudiante=20201003849" | jq

