<?php

$pathToRoot = '/../../../../../';


require_once __DIR__ . $pathToRoot.'classes/Biblioteca/Biblioteca.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$biblioteca = new Biblioteca();

// Responder a la peticion


header("Content-Type: application/json");



$postData = json_decode(file_get_contents("php://input"),true);



$titulo = $postData["titulo"];
$tags = $postData["tags"];
$descripcion = $postData["descripcion"];
$categoria = $postData["categoria"];
$autores = $postData["autores"];
$anio = $postData["anio"];
$idDocente = $postData["idDocente"];
$archivoPdf = $postData["archivo_pdf"];
$portada = $postData["portada"];
$cursos = $postData["cursos"];

try{
    $resultado = $biblioteca->insertarRecursoCompleto($titulo, $tags, $descripcion, $categoria, $autores, $anio, $idDocente, $archivoPdf, $portada,$cursos);
    if($resultado){
        echo json_encode([
            'success'=> true,
            'message'=> 'Solicitud insertada correctamente'
        ]);


    } else{
        echo json_encode([
            'success'=>false,
            'message'=>'Error al insertar solicitud'
        ]);
    }
} catch(Exception $e){
    http_response_code(500);
    echo json_encode([
        'status'=>'error',
        'message'=> 'Excepcion: '. $e->getMessage()
    ]);
}
