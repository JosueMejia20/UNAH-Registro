<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Admisiones/Admisiones.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$admisiones = new Admisiones();

// Responder a la peticion

//$idInscripcion = intval(explode("/",$_SERVER["PATH_INFO"])[1]);
//$valor = intval(explode("/",$_SERVER["PATH_INFO"])[2]);

header("Content-Type: application/json");

//$inscripcionesByRevisor = $admisiones->getInscripcionesByRevisor($idRevisor);
//echo $idInscripcion;
//echo $valor;

$putData = json_decode(file_get_contents("php://input"),true);
$idInscripcion = $putData["idInscripcion"];
$valorInscripcion = $putData["valorInscripcion"];
$justificacion = $putData["justificacion"];
$correo = $putData["correo"];

try{
    $resultado = $admisiones->cambiarEstadoInscripcion($idInscripcion,$valorInscripcion,$justificacion,$correo);
    if($resultado){
        echo json_encode([
            'success'=> true,
            'message'=> 'Solicitud actualizada correctamente'
        ]);


    } else{
        echo json_encode([
            'success'=>false,
            'message'=>'Error al actualizar la solicitud'
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