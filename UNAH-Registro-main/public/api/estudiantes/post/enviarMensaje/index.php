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

$postData = json_decode(file_get_contents("php://input"),true);
//echo json_encode($putData);

$mensaje = $postData["mensaje"];
$emisor_id = $postData["emisor_id"];
$receptor_id = $postData["receptor_id"];

//echo $postData['receptor_id'];


try{
    $resultado = $estudiantes->enviarMensaje($emisor_id, $receptor_id,$mensaje);
    if($resultado){
        echo json_encode([
            'success'=> true,
            'message'=> 'Mensaje insertado correctamente'
        ]);


    } else{
        echo json_encode([
            'success'=>false,
            'message'=>'Error al insertar mensaje'
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