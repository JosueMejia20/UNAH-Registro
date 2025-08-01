<?php

session_start();

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Admisiones/Admisiones.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';
require_once __DIR__ . $pathToRoot.'classes/Utilities/Utilities.php';

$admisiones = new Admisiones();

// Responder a la peticion

$json = file_get_contents('php://input');

$data = json_decode($json, true);

//echo $json;

//VER COMO LO VA A DEVOLVER EL PROCEDIMIENTO ALMACENADO
$username = $data['username'] ?? null;
$password = $data['password'] ?? null;

header("Content-Type: application/json");

//echo $data['password'];


try{
    //VER COMO OBTENGO DE RESULTADOLOGIN EL OUT DEL SP
    $resultadoLogin = Utilities::login($username, $password);
    if($resultadoLogin){
        
        if($admisiones->verificarUsuarioRevisor($resultadoLogin)){
            //iniciando session )(variables de session)
            $_SESSION['usuario_id'] = $resultadoLogin;
            $_SESSION['rol'] = 'revisor';
            $_SESSION['estado'] = true;
            echo json_encode([
            'success'=> true,
            'message'=> 'Se ha iniciado sesion correctamente',
            'idRevisor'=> $resultadoLogin
        ]);
        } else{
            echo json_encode([
                'success'=> false,
                'message'=> 'El usuario ingresado no es un revisor'
            ]);
        }
       // echo $resultadoLogin;
    } else{
        echo json_encode([
            'success'=>false,
            'message'=>'Error al iniciar sesion',
            'test'=>$resultadoLogin
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
