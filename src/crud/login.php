<?php
include("conexao.php");

$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';
$senha_hash = hash('sha256', $senha);

$sql = "SELECT * FROM usuarios WHERE usuario = ? AND senha = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usuario, $senha_hash);
$stmt->execute();
$result = $stmt->get_result();

$response = [];

if ($result->num_rows > 0) {
  $response['status'] = 'ok';
} else {
  $response['status'] = 'erro';
}

echo json_encode($response);