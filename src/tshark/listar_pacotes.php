<?php
require_once '../conexao.php';

if (!isset($_GET['captura_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'ID da captura não informado.']);
    exit;
}

$captura_id = intval($_GET['captura_id']);

$sql = "SELECT id, captura_id, src_ip, dest_ip, protocolo, tamanho
        FROM PACOTES
        WHERE captura_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $captura_id);
$stmt->execute();

$resultado = $stmt->get_result();
$pacotes = [];

while ($linha = $resultado->fetch_assoc()) {
    $pacotes[] = $linha;
}

echo json_encode([
    'status' => 'ok',
    'dados' => $pacotes
]);
