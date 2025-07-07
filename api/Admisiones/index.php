<?php

require_once __DIR__ . '/../../classes/Admisiones/Admisiones.php';

require_once __DIR__ . '/../../classes/db/DataBase.php';


// Obtener metodo HTTP y la URI
$metodo = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Limpieza uri (quita el / del inicio)
$ruta = trim($uri, '/');

// Instancia de la clase de servicios para Admisiones
$admisiones = new Admisiones();

// Responder a las peticiones
if ($ruta === 'api/Admisiones/usuarios' && $metodo === 'GET') {
    $usuarios = $admisiones->getUsuarios();
    echo json_encode($usuarios);
    exit;
}

if ($ruta === 'api/Admisiones/estadoCivil' && $metodo === 'GET') {
    $usuarios = $admisiones->getEstadoCivil();
    echo json_encode($usuarios);
    exit;
}

if ($ruta === 'api/Admisiones/departamentoPais' && $metodo === 'GET') {
    $usuarios = $admisiones->getDepartamentoPais();
    echo json_encode($usuarios);
    exit;
}

if ($ruta === 'api/Admisiones/pais' && $metodo === 'GET') {
    $usuarios = $admisiones->getPais();
    echo json_encode($usuarios);
    exit;
}

if ($ruta === 'api/Admisiones/centroRegional' && $metodo === 'GET') {
    $usuarios = $admisiones->getCentroRegional();
    echo json_encode($usuarios);
    exit;
}

if ($ruta === 'api/Admisiones/carreras' && $metodo === 'GET') {
    $usuarios = $admisiones->getCarreras();
    echo json_encode($usuarios);
    exit;
}


// Si no coincide ninguna ruta:
echo json_encode(['error' => 'Ruta no encontrada']);
