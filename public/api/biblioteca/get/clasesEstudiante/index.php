<?php
//ELIMINAR
$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Biblioteca/Biblioteca.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$biblioteca = new Biblioteca();

// Responder a la peticion

$idEstudiante = intval(explode("/",$_SERVER["PATH_INFO"])[1]);


header("Content-Type: application/json");

$clasesEstudiante = $biblioteca->obtenerClasesEstudiante($idEstudiante);

echo json_encode($clasesEstudiante);