<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Estudiantes/Estudiantes.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$estudiantes = new Estudiantes();

// Responder a la peticion

//$idInscripcion = intval(explode("/",$_SERVER["PATH_INFO"])[1]);
//$valor = intval(explode("/",$_SERVER["PATH_INFO"])[2]);

header("Content-Type: application/json");

//$inscripcionesByRevisor = $admisiones->getInscripcionesByRevisor($idRevisor);
//echo $idInscripcion;
//echo $valor;

$putData = json_decode(file_get_contents("php://input"),true);
//echo json_encode($putData);

$idSolicitud = $putData["idSolicitud"];

try{
    $resultado = $estudiantes->rechazarSolicitudContacto($idSolicitud);
    if($resultado){
        echo json_encode([
            'success'=> true,
            'message'=> 'Solicitud rechazada correctamente'
        ]);


    } else{
        echo json_encode([
            'success'=>false,
            'message'=>'Error al rechazar solicitud'
        ]);
    }
} catch(Exception $e){
    http_response_code(500);
    echo json_encode([
        'status'=>'error',
        'message'=> 'Excepcion: '. $e->getMessage()
    ]);
}

//echo $putData;

//$admisiones->cambiarEstadoInscripcion($idInscripcion,$valor);