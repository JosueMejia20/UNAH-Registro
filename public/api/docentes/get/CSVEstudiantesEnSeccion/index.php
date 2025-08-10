<?php

$pathToRoot = '/../../../../../';

require_once __DIR__ . $pathToRoot.'classes/Docentes/Docentes.php';
require_once __DIR__ . $pathToRoot.'classes/db/DataBase.php';
require_once __DIR__ . $pathToRoot.'classes/Utilities/Utilities.php';

$docente = new Docentes();
$utilidad = new Utilities();

ob_clean();

$idSeccion = isset($_GET['idSeccion']) ? intval($_GET['idSeccion']) : 0;

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="seccion_' . $idSeccion . '_Estudiantes.csv"');

$estudiates = $docente->getEstudiantes($idSeccion);
$encabezado = ['Número de Cuenta', 'Nombre del Estudiante', 'Nombre de Carrera', 'Correo Institucional'];

$csv = $utilidad->CSVEstudiantesSeccion($estudiates, $encabezado);

echo $csv;

exit;


