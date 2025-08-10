<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Biblioteca/Biblioteca.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$biblioteca = new Biblioteca();

// Responder a la peticion

$json = file_get_contents('php://input');

$data = json_decode($json, true);

//echo $json;

$idRecurso = $data['idRecurso'] ?? null;

header("Content-Type: application/json");


try{
    $resultado = $biblioteca->deleteRecurso($idRecurso);
} catch(Exception $e){
    http_response_code(500);
    echo json_encode([
        'status'=>'error',
        'message'=> 'Excepcion: '. $e->getMessage()
    ]);
}

echo json_encode([
    'success'=> true,
    'message'=> 'Recurso eliminado correctamente'
]);