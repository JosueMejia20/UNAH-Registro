<?php
$pathToRoot = '/../../';

require_once __DIR__ . $pathToRoot.'classes/Estudiantes/Estudiantes.php';

$estudiantes = new Estudiantes();

$cuenta = $_GET['cuenta'] ?? '';

$datos = $estudiantes->obtenerHistorial($cuenta);

//var_dump($datos);

$estudiante = $datos[0]["nombre_completo"];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Historial Académico</title>
    <style>
        body {
            font-family: Arial;
            margin: 40px;
        }
        h1 {
            text-align: center;
        }
        h2 {
            text-align: center;
        }
        h3 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
        }
        th {
            border-bottom: 2px solid #000;
            background-color: #f0f0f0;
        }
        td {
            border-bottom: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        .datos {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <h1>UNIVERSIDAD NACIONAL AUTONOMA DE HONDURAS</h1>
    <h3>DIRECCION DE INGRESO PERMANENCIA Y PROMOCION</h3>
    <h3>SECCION DE CALIFICACIONES</h3>
    <div class="datos">
        <strong>El suscrito director de la Direccion de Ingreso Permanencia y Promocion de la Universidad Nacional Autonoma de Honduras CERTFICA QUE: <?= $estudiante ?> matriculado con numero de cuenta: <?= $cuenta ?> para la carrera de: </strong> <br>
        <strong>Obtuvo las siguientes calificaciones: </strong><br><br>
    </div>

    <table>
        <thead>
            <tr>
                <th>CODIGO</th>
                <th>ASIGNATURA</th>
                <th>CALIFICACION</th>
                <th>UV</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $fila): ?>
                <tr>
                    <td><?= $fila["codigo"] ?></td>
                    <td><?= $fila["nombre_clase"] ?></td>
                    <td><?= $fila["nota"] ?></td>
                    <td><?= $fila["unidades_valorativas"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>