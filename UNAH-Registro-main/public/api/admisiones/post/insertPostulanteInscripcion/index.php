<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Admisiones/Admisiones.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$admisiones = new Admisiones();

// Responder a la peticion

$json = file_get_contents('php://input');

$data = json_decode($json, true);

//echo $json;

$nombre_completo = $data['nombre_completo'] ?? null;
$apellido_completo = $data['apellido_completo'] ?? null;
$fecha_nacimiento = $data['fecha_nacimiento'] ?? null;

if($data['genero'] == "masculino"){
    $genero = "M";
} elseif($data['genero'] == "femenino"){
    $genero = "F";
} else{
    $genero = "O";
}

$estado_civil = $data['estado_civil'] ?? null;
$departamento = $data['departamento'] ?? null;
$direccion = $data['direccion'] ?? null;
$telefono = $data['telefono'] ?? null;
$email = $data['email'] ?? null;
$instituto_educacion_media = $data['instituto_educacion_media'] ?? null;
$anio_graduacion = $data['anio_graduacion'] ?? null;
$pais_estudios = $data['pais_estudios'] ?? null;
$centro_regional = $data['centro_regional'] ?? null;
$carrera_interes_primera = $data['carrera_interes_primera'] ?? null;
$carrera_interes_secundaria = $data['carrera_interes_secundaria'] ?? null;



$imagen_base64 = $data['documentos'] ?? null;

$numero_identificacion = $data['numero_identificacion'] ?? null;

header("Content-Type: application/json");

$admisiones->insertPostulanteInscripcion($departamento, $direccion, $numero_identificacion, $nombre_completo,
$apellido_completo, $telefono, $email, $genero, $fecha_nacimiento, $estado_civil, $instituto_educacion_media,
$anio_graduacion, $pais_estudios, $carrera_interes_primera,$carrera_interes_secundaria, $centro_regional,
$imagen_base64);

//$carrerasByCentro = $admisiones->getCarrerasByCentro($idCentro);
//echo json_encode($carrerasByCentro);

// Respuesta OK
echo json_encode([
    "success" => true,
    "message" => "Inscripción registrada correctamente."
]);
