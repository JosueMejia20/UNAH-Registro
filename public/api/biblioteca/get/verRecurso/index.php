<?php
$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Biblioteca/Biblioteca.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';
require_once __DIR__. $pathToRoot.'classes/Utilities/Utilities.php';

$biblioteca = new Biblioteca();


header("Content-Type: application/json");

$idRecurso= intval(explode("/",$_SERVER["PATH_INFO"])[1]);


$recursos = $biblioteca->verRecurso($idRecurso);

foreach ($recursos as &$recurso) {
    if (isset($recurso['archivo'])) {
        $recurso['archivo'] = base64_encode($recurso['archivo']);
    }
}

$json = json_encode($recursos);

if ($json === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al codificar JSON: ' . json_last_error_msg()]);
    exit;
}

echo $json;