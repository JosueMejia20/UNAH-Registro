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

$correo = $putData["correo"];
$telefono = $putData["telefono"];
$direccion = $putData["direccion"];
$foto_perfil_b64 = $putData["foto_perfil"];
$matricula = $putData["matricula"];


try{
    $resultado = $estudiantes->updateEstudiante($matricula,$correo,$telefono,$direccion,$foto_perfil_b64);
    if($resultado){
        echo json_encode([
            'success'=> true,
            'message'=> 'Perfil actualizado correctamente'
        ]);


    } else{
        echo json_encode([
            'success'=>false,
            'message'=>'Error al actualizar el perfil'
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