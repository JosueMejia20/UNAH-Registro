<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Docentes/Docentes.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$docentes = new Docentes();

// Responder a la peticion

//$idEstudiante = intval(explode("/",$_SERVER["PATH_INFO"])[1]);

$idSeccion = $_GET['idSeccion'];

header("Content-Type: application/json");

$info = $docentes->getEstudiantesNotas($idSeccion);

echo json_encode($info);