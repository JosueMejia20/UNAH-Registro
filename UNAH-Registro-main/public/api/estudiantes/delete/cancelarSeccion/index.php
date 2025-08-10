<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Estudiantes/Estudiantes.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$estudiantes = new Estudiantes();

// Responder a la peticion

$json = file_get_contents('php://input');

$data = json_decode($json, true);

//echo $json;

$idEstudiante= $data['estudiante'] ?? null;
$secciones = $data['secciones'] ?? null;

header("Content-Type: application/json");

$counter = 0;

/*foreach($secciones as $seccion){
    echo $seccion;
}*/
//echo $secciones[0];

// Todas las apis de insertar deberian ser asi. Manejo de errores y mensajes de exito o fracaso.

foreach($secciones as $seccion){
    try{
        $resultado = $estudiantes->deleteEstudianteMatricula($idEstudiante, $seccion);
        if($resultado){
            $counter += 1;
        }
    } catch(Exception $e){
        http_response_code(500);
        echo json_encode([
            'status'=>'error',
            'message'=> 'Excepcion: '. $e->getMessage()
        ]);
    }

}
if($counter == count($secciones)){
            echo json_encode([
                'success'=> true,
                'message'=> 'Solicitud actualizada correctamente',
                'result'=> $resultado
            ]);

            
    
} else{
    echo json_encode([
                'success'=>false,
                'message'=>'Error al actualizar la solicitud',
                'result'=> $resultado
            ]);
}

//$carrerasByCentro = $admisiones->getCarrerasByCentro($idCentro);
//echo json_encode($carrerasByCentro);