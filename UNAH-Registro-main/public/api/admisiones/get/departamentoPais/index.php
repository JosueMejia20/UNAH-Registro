<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Admisiones/Admisiones.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$admisiones = new Admisiones();

// Responder a la peticion

header("Content-Type: application/json");

$departamentosPais = $admisiones->getDepartamentoPais();
echo json_encode($departamentosPais);
