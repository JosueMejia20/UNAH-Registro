<?php
$vista = $_GET['vista'] ?? 'dashboard'; // Por defecto carga dashboard

$ruta = __DIR__ . '/' . $vista . '.php';

if (file_exists($ruta)) {
    include $ruta;
} else {
    echo "La vista '$vista' no existe.";
}
