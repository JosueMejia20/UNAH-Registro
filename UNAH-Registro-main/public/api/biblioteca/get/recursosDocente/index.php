<?php
//ELIMINAR
$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Biblioteca/Biblioteca.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$biblioteca = new Biblioteca();

// Responder a la peticion

//$idEstudiante = intval(explode("/",$_SERVER["PATH_INFO"])[1]);

$idDocente = $_GET['idDocente'];

header("Content-Type: application/json");

$recursosDocente = $biblioteca->obtenerRecursosDocente($idDocente);

echo json_encode($recursosDocente);