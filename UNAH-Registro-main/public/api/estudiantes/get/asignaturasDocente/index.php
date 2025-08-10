<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Estudiantes/Estudiantes.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$estudiantes = new Estudiantes();

// Responder a la peticion

//$idEstudiante = intval(explode("/",$_SERVER["PATH_INFO"])[1]);

$idDocente = $_GET['idDocente'];

header("Content-Type: application/json");

$info = $estudiantes->obtenerAsignaturasActualesDocente($idDocente);

echo json_encode($info);