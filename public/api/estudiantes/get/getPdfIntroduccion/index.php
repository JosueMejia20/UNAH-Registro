<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot . 'classes/Estudiantes/Estudiantes.php';
require_once __DIR__ . $pathToRoot . 'classes/db/DataBase.php';
require_once __DIR__ . $pathToRoot . 'classes/Utilities/Utilities.php';

$estudiantes = new Estudiantes();

// Responder a la peticion

//$idEstudiante = intval(explode("/",$_SERVER["PATH_INFO"])[1]);

$idSeccion = $_GET['idSeccion'];

header("Content-Type: application/json");

$info = $estudiantes->getPdfIntroduccionClase($idSeccion);

if ($info['archivo_pdf']) {
    $pdfBase64 = base64_encode($info['archivo_pdf']);
    echo json_encode(['archivo_pdf' => $pdfBase64]);
} else {
    echo json_encode(['archivo_pdf' => null]);
}
