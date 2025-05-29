<?php
require_once '../conexao.php';

$sql = "SELECT id, nome_arquivo, timestamp FROM CAPTURAS ORDER BY timestamp DESC";
$resultado = $conn->query($sql);

$capturas = [];

while ($linha = $resultado->fetch_assoc()) {
    $capturas[] = $linha;
}

echo json_encode([
    'status' => 'ok',
    'dados' => $capturas
]);
