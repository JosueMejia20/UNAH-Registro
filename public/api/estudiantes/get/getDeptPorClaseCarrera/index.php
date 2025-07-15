<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Estudiantes/Estudiantes.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$estudiantes = new Estudiantes();

// Responder a la peticion

//$idEstudiante = intval(explode("/",$_SERVER["PATH_INFO"])[1]);

$idEstudiante = $_GET['estudiante'];

header("Content-Type: application/json");

$info = $estudiantes->getDeptPorClaseCarrera($idEstudiante);

echo json_encode($info);