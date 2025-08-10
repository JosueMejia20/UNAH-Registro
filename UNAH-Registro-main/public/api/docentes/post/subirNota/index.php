<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot . 'classes/Docentes/Docentes.php';
require_once __DIR__ . $pathToRoot . 'classes/db/DataBase.php';

$docentes = new Docentes();

header("Content-Type: application/json");

$postData = json_decode(file_get_contents("php://input"), true);

$idSeccion = intval($postData["idSeccion"]);
$idEstudiante = $postData["idEstudiante"];
$nota = intval($postData["nota"]);

if (!isset($idSeccion, $idEstudiante, $nota)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Faltan datos obligatorios.'
    ]);
    exit;
}

try {
    $resultado = $docentes->insertarEstudiantesSecciones($idSeccion, $idEstudiante, $nota);
    if ($resultado) {
        echo json_encode([
            'success' => true,
            'message' => 'Nota insertada correctamente'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error al insertar nota'
        ]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Excepcion: ' . $e->getMessage()
    ]);
}
