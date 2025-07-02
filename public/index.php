<?php
$page = $_GET['page'] ?? 'landing';
$rol = $_GET['rol'] ?? null;

switch ($page) {
    case 'login':
        include '../views/login.php'; // login leerá $rol por GET
        break;
    case 'registro':
        include '../views/registro.php';
        break;
    case 'formulario':
        include '../views/admision_formulario.php';
        break;
    case 'estudiantes':
        include '../views/estudiante.php';
        break;
    case 'revisor':
        include '../views/revisores.php';
        break;
    default:
        include '../views/landing.php';
}
?>
