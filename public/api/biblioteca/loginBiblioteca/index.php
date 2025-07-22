<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Biblioteca/Biblioteca.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';
require_once __DIR__ . $pathToRoot.'classes/Utilities/Utilities.php';

$biblioteca = new Biblioteca();

// Responder a la peticion

$json = file_get_contents('php://input');

$data = json_decode($json, true);

$correo = $data['username'] ?? null;
$password = $data['password'] ?? null;

header("Content-Type: application/json");


try{
    $resultadoLogin = Utilities::login($correo, $password);
    //si $resultadoLogin = 0 false; si es = 1 true; esto valida que las credenciales existan en la tabla Usuario
    if($resultadoLogin){
        
        if($biblioteca->verificarUsuarioBiblioteca($resultadoLogin)==1){
            echo json_encode([
            'success'=> true,
            'message'=> 'Se ha iniciado sesion correctamente',
            'idEstudiante'=> $resultadoLogin,
            'tipoUsuario'=> 1
        ]);
        } elseif($biblioteca->verificarUsuarioBiblioteca($resultadoLogin)==2){
            echo json_encode([
            'success'=> true,
            'message'=> 'Se ha iniciado sesion correctamente',
            'idSuperior'=> $resultadoLogin,
            'tipoUsuario'=> 2
        ]);
        }else {
            echo json_encode([
                'success'=> false,
                'message'=> 'El usuario ingresado no es un usuario valido para biblioteca'
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