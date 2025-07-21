<?php

require_once __DIR__ .'/Utilities.php';

$util = new Utilities();

$util->csvGenerarInscripcionesAceptadas();

Utilities::insertarResultados();
