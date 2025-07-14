<?php

$pathToRoot = '/../../../';

//require_once __DIR__ . $pathToRoot.'classes/Admisiones/Admisiones.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

//$admisiones = new Admisiones();

// Responder a la peticion

$db = new DataBase();

header("Content-Type: application/json");

//$carreras = $admisiones->getCarreras();
$inscripcionId = 2;
$resultDni = $db->executeQuery("SELECT obtener_dni_de_inscripcion($inscripcionId) AS dni");
$dni = strval($resultDni[0]['dni']);
$examenes = $db->executeQuery("SELECT obtener_examenes_postulante('$dni') AS examenes");
echo $examenes[0]['examenes'];