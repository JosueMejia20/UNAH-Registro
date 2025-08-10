<?php
$pathToRoot = '/../../';
require_once __DIR__ . $pathToRoot . 'classes/Estudiantes/Estudiantes.php';
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
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body {
            font-family: Arial;
            margin: 40px;
            color: #a0457a;
            position: relative;
        }

        .background-logo {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            height: 400px;
            opacity: 0.09;
            z-index: -1;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 20px;
            margin-bottom: 20px;
        }

        .logo-unah {
            width: 80px;
            height: 80px;
            flex-shrink: 0;
        }

        .logo-unah img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .titulo-container {
            flex: 1;
            text-align: center;
        }

        h1 {
            margin: 0;
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

        @media print {
            body {
                margin: 20px;
            }

            .background-logo {
                position: fixed !important;
                top: 50% !important;
                left: 50% !important;
                transform: translate(-50%, -50%) !important;
                opacity: 0.05 !important;
                z-index: -1 !important;
            }

            .header-container {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>

    <div class="background-logo">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a6/Escudo_de_la_UNAH.svg/640px-Escudo_de_la_UNAH.svg.png" alt="UNAH Background">
    </div>

    <div class="header-container">
        <div class="logo-unah">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a6/Escudo_de_la_UNAH.svg/640px-Escudo_de_la_UNAH.svg.png" style="width: 100%; height: 100%; object-fit: contain;">
        </div>
        <div class="titulo-container">
            <h1>UNIVERSIDAD NACIONAL AUTONOMA DE HONDURAS</h1>
        </div>
    </div>

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