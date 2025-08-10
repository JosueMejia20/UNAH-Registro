# Recupera las inscripciones asignadas al revisor con id=1. Si no hay, no devuelve nada
curl http://localhost:3000/api/admisiones/get/solicitudesByRevisor/1 | jq