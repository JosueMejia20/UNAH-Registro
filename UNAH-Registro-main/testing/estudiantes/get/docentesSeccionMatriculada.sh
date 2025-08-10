#Devuelve todos los docentes segun la clase matriculada por el estudiante . Ejemplo de id de estudiante = 20201003849. Devuelve vacio si no hay nada
curl http://localhost:3000/api/estudiantes/get/docentesSeccionMatriculada?matricula=20201003849 | jq

