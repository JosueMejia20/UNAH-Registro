<?php
$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Biblioteca/Biblioteca.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$biblioteca = new Biblioteca();


header("Content-Type: application/json");

$recursos = $biblioteca->obtenerRecursos();

echo json_encode($recursos);