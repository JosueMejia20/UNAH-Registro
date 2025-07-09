<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Admisiones/Admisiones.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$admisiones = new Admisiones();

// Responder a la peticion

$json = file_get_contents('php://input');

$data = json_decode($json, true);

echo json_encode($json);


header("Content-Type: application/json");

//$carrerasByCentro = $admisiones->getCarrerasByCentro($idCentro);
//echo json_encode($carrerasByCentro);