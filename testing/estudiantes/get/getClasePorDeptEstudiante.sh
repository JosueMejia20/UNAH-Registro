#  Devuelve todas las clases segun el departamento y segun estudiante. Ejemplo de id de estudiante = 20201003849 y departamento = 1. Devuelve vacio si no hay nada
curl "http://localhost:3000/api/estudiantes/get/getClasePorDeptEstudiante?estudiante=20201003849&departamento=1" | jq

# Se obtiene de Clases_Carrera, el estudiante es para verificar cual carrera verificar y las clases pertenecen a un departamento