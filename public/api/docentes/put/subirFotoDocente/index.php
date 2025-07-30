<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Docentes/Docentes.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$docentes = new Docentes();


header("Content-Type: application/json");

$putData = json_decode(file_get_contents("php://input"),true);

$foto_perfil = $putData["foto_perfil"];
$idDocente = $putData["idDocente"];


try{
    $resultado = $docentes->subirFotoDocente($foto_perfil, $idDocente);
    if($resultado){
        echo json_encode([
            'success'=> true,
            'message'=> 'Foto subida correctamente',
            'result'=>$resultado
        ]);


    } else{
        echo json_encode([
            'success'=>false,
            'message'=>'Error al subir foto',
            'result'=>$resultado
        ]);
    }
} catch(Exception $e){
    http_response_code(500);
    echo json_encode([
        'status'=>'error',
        'message'=> 'Excepcion: '. $e->getMessage()
    ]);
}
