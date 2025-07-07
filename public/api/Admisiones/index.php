<?php

require_once __DIR__ . '/../../../classes/Admisiones/Admisiones.php';

require_once __DIR__ . '/../../../classes/db/DataBase.php';


// Obtener metodo HTTP y la URI
$metodo = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Limpieza uri (quita el / del inicio)
$ruta = trim($uri, '/public/');

//$ruta = $uri;

// Instancia de la clase de servicios para Admisiones
$admisiones = new Admisiones();

// Responder a las peticiones

if ($ruta === 'api/Admisiones/estadoCivil' && $metodo === 'GET') {
    $estadosCivil = $admisiones->getEstadoCivil();
    echo json_encode($estadosCivil);
    exit;
}

if ($ruta === 'api/Admisiones/departamentoPais' && $metodo === 'GET') {
    $departamentosPais = $admisiones->getDepartamentoPais();
    echo json_encode($departamentosPais);
    exit;
}

if ($ruta === 'api/Admisiones/pais' && $metodo === 'GET') {
    $paises = $admisiones->getPais();
    echo json_encode($paises);
    exit;
}

if ($ruta === 'api/Admisiones/centroRegional' && $metodo === 'GET') {
    $centros = $admisiones->getCentroRegional();
    echo json_encode($centros);
    exit;
}

if ($ruta === 'api/Admisiones/carreras' && $metodo === 'GET') {
    $carreras = $admisiones->getCarreras();
    echo json_encode($carreras);
    exit;
}


// Si no coincide ninguna ruta:
echo json_encode(['error' => 'Ruta no encontrada']);
