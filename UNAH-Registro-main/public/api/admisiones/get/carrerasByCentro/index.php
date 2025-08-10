<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Admisiones/Admisiones.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$admisiones = new Admisiones();

// Responder a la peticion

$idCentro = intval(explode("/",$_SERVER["PATH_INFO"])[1]);

header("Content-Type: application/json");

$carrerasByCentro = $admisiones->getCarrerasByCentro($idCentro);
echo json_encode($carrerasByCentro);