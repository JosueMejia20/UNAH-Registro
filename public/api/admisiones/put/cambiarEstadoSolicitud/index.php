<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Admisiones/Admisiones.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$admisiones = new Admisiones();

// Responder a la peticion

$idInscripcion = intval(explode("/",$_SERVER["PATH_INFO"])[1]);
$valor = intval(explode("/",$_SERVER["PATH_INFO"])[2]);

//header("Content-Type: application/json");

//$inscripcionesByRevisor = $admisiones->getInscripcionesByRevisor($idRevisor);
//echo $idInscripcion;
//echo $valor;

$admisiones->cambiarEstadoInscripcion($idInscripcion,$valor);