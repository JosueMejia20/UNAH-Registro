<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Docentes/Docentes.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$docentes = new Docentes();

// Responder a la peticion

//$idEstudiante = intval(explode("/",$_SERVER["PATH_INFO"])[1]);

$usuarioId = $_GET['usuarioId'];

header("Content-Type: application/json");

$numeroEmpleadoDocente = $docentes->getNumeroDocenteByUsuarioId($usuarioId);

echo json_encode($numeroEmpleadoDocente);