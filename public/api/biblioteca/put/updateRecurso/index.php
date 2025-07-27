<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Biblioteca/Biblioteca.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';
require_once __DIR__. $pathToRoot.'classes/Utilities/Utilities.php';

$biblioteca = new Biblioteca();

// Responder a la peticion

//$idInscripcion = intval(explode("/",$_SERVER["PATH_INFO"])[1]);
//$valor = intval(explode("/",$_SERVER["PATH_INFO"])[2]);

header("Content-Type: application/json");

//$inscripcionesByRevisor = $admisiones->getInscripcionesByRevisor($idRevisor);
//echo $idInscripcion;
//echo $valor;

$putData = json_decode(file_get_contents("php://input"),true);
//echo json_encode($putData);

$anio = $putData["edit_anio"];
$archivo = $putData["edit_archivo"];
$autores = $putData["edit_autores"];
$categoria = $putData["edit_categoria"];
$cursos = $putData["edit_cursos"];
$descripcion = $putData["edit_descripcion"];
$portada = $putData["edit_portada"];
$tags = $putData["edit_tags"];
$titulo = $putData["edit_titulo"];
$idRecurso = $putData["recurso_id"];


try{
    //aqui cambiarlo
    $resultado = $biblioteca->updateRecurso($anio, $archivo, $autores,$categoria,$cursos,$descripcion,$portada,$tags, $titulo, $idRecurso);
    if($resultado){
        echo json_encode([
            'success'=> true,
            'message'=> 'Recurso actualizado correctamente'
        ]);


    } else{
        echo json_encode([
            'success'=>false,
            'message'=>'Error al actualizar el recurso'
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