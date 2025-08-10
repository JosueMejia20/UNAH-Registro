<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot . 'classes/Docentes/Docentes.php';
require_once __DIR__ . $pathToRoot . 'classes/db/DataBase.php';

$docentes = new Docentes();

header("Content-Type: application/json");

$postData = json_decode(file_get_contents("php://input"), true);

$idSeccion = $postData["idSeccion"];
$linkVideo = $postData["linkVideo"];
$base64PDF = $postData["base64PDF"];

if (!isset($idSeccion, $linkVideo, $base64PDF)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Faltan datos obligatorios.'
    ]);
    exit;
}

try {
    $resultado = $docentes->insertarRecursosDeSeccion($idSeccion, $linkVideo, $base64PDF);
    if ($resultado) {
        echo json_encode([
            'success' => true,
            'message' => 'Solicitud insertada correctamente'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error al insertar solicitud'
        ]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Excepcion: ' . $e->getMessage()
    ]);
}
