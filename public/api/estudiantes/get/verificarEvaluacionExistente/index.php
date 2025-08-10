<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Estudiantes/Estudiantes.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$estudiantes = new Estudiantes();

// Responder a la peticion

//$idEstudiante = intval(explode("/",$_SERVER["PATH_INFO"])[1]);

$idEstudiante = $_GET['idEstudiante'];
$idSeccion = $_GET['idSeccion'];

header("Content-Type: application/json");

//Devuelve 1 si hay conflicto, y 0 si no hay conflicto
$info = $estudiantes->verificarEvaluacionExistente($idEstudiante, $idSeccion);

echo $info;