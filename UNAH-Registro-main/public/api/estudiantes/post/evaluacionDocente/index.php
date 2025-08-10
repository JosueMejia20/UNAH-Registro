<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Estudiantes/Estudiantes.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$estudiantes = new Estudiantes();

// Responder a la peticion

$json = file_get_contents('php://input');

$data = json_decode($json, true);

//echo $json;

$idEstudiante= $data['idEstudiante'] ?? null;
$idSeccion = $data['idSeccion'] ?? null;
$observacion = $data['observaciones'] ?? null;
$archivoPDF = $data['archivo_pdf'] ?? null;
$jsonEvaluacion = $data['jsonEvaluacion'] ?? null;
$jsonEvaluacion = json_encode($jsonEvaluacion);

header("Content-Type: application/json");

// Todas las apis de insertar deberian ser asi. Manejo de errores y mensajes de exito o fracaso.

try{
    $resultado = $estudiantes->insertEvaluacionDocente($idEstudiante, $idSeccion, $observacion, $archivoPDF, $jsonEvaluacion);
    if($resultado){
        echo json_encode([
            'success'=> true,
            'message'=> 'Solicitud actualizada correctamente',
            'result'=> $resultado,
            'evaluacion'=>$jsonEvaluacion
        ]);


    } else{
        echo json_encode([
            'success'=>false,
            'message'=>'Error al actualizar la solicitud',
            'result'=> $resultado,
            'evaluacion'=>$jsonEvaluacion
        ]);
    }
} catch(Exception $e){
    http_response_code(500);
    echo json_encode([
        'status'=>'error',
        'message'=> 'Excepcion: '. $e->getMessage()
    ]);
}

//$carrerasByCentro = $admisiones->getCarrerasByCentro($idCentro);
//echo json_encode($carrerasByCentro);