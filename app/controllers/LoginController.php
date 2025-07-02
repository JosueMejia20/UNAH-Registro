<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$usuario = $data['usuario'] ?? '';
$password = $data['password'] ?? '';
$tipo = $data['tipo'] ?? '';

$response = ['success' => false, 'message' => 'Credenciales inválidas'];

// Aquí haces conexión a DB y validas según $tipo (estudiante, docente, etc.)

// Ejemplo simplificado:
if ($tipo === 'estudiante' && $usuario === '20202000001' && $password === '1234') {
    $response = ['success' => true, 'redirect' => '?page=estudiantes'];
} elseif ($tipo === 'docente' && $usuario === 'correo@unah.edu.hn' && $password === '1234') {
    $response = ['success' => true, 'redirect' => '?page=docente'];
}
// ... otros roles

echo json_encode($response);
