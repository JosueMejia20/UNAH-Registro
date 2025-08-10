<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Docentes/Docentes.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$docentes = new Docentes();

// Responder a la peticion

//$idEstudiante = intval(explode("/",$_SERVER["PATH_INFO"])[1]);

$idDocente = $_GET['idDocente'];

header("Content-Type: application/json");

$info = $docentes->getFotoPerfilDocente($idDocente);

echo json_encode($info);