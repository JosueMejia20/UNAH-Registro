<?php

session_start();

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Estudiantes/Estudiantes.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';
require_once __DIR__ . $pathToRoot.'classes/Utilities/Utilities.php';

$estudiantes = new Estudiantes();

// Responder a la peticion

$json = file_get_contents('php://input');

$data = json_decode($json, true);

$cuenta = $data['userName'] ?? null;
$password = $data['password'] ?? null;

header("Content-Type: application/json");

try{

    $resultadoLogin = Utilities::login($cuenta, $password);
    if($resultadoLogin){
        
        if($estudiantes->verificarUsuarioEstudiante($resultadoLogin)){
            //iniciando session )(variables de session)
            $_SESSION['usuario_id'] = $resultadoLogin;
            echo json_encode([
            'success'=> true,
            'message'=> 'Se ha iniciado sesion correctamente'
        ]);
        } else{
            echo json_encode([
                'success'=> false,
                'message'=> 'El usuario ingresado no es un docente'
            ]);
        }
       // echo $resultadoLogin;
    } else{
        echo json_encode([
            'success'=>false,
            'message'=>'Error al iniciar sesion'
        ]);
    }
} catch(Exception $e){
    http_response_code(500);
    echo json_encode([
        'status'=>'error',
        'message'=> 'Excepcion: '. $e->getMessage()
    ]);
}