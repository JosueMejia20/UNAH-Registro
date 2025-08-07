<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Biblioteca/Biblioteca.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';

$biblioteca = new Biblioteca();

header("Content-Type: application/json");

$todoTitulos = $biblioteca->obtenerTodoTitulo();

echo json_encode($todoTitulos);



$metodo = $_SERVER['REQUEST_METHOD'];
$tipo = $_GET['tipo'] ?? '';

if ($metodo === 'GET') {
    $biblioteca = new Biblioteca();

    switch ($tipo) {
        case 'autores':
            $data = $biblioteca->obtenerTodoAutor();
            break;
        case 'titulos':
            $data = $biblioteca->obtenerTodoTitulo();
            break;
        default:
            $data = [];
    }

    echo json_encode($data);
}
