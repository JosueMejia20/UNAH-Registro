<?php
$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Biblioteca/Biblioteca.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';
require_once __DIR__. $pathToRoot.'classes/Utilities/Utilities.php';

$biblioteca = new Biblioteca();


header("Content-Type: application/json");

$idUsuario= intval(explode("/",$_SERVER["PATH_INFO"])[1]);


$resultado = $biblioteca->obtenerNombreUsuario($idUsuario);

$json = json_encode($resultado);

echo $json;