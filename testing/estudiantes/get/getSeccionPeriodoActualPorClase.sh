# Devuelve todas las secciones del periodo actual segun la clase. Ejemplo asignatura = 1.Devuelve vacio si no hay nada
curl "http://localhost:3000/api/estudiantes/get/getSeccionPeriodoActualPorClase?asignatura=1" | jq

