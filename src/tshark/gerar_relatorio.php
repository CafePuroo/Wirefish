<?php
require_once '../conexao.php';

$idCaptura = $_GET['id_captura'] ?? null;
$filtroProtocolo = $_GET['protocolo'] ?? null;

if (!$idCaptura) {
    echo json_encode(['erro' => 'ID da captura não informado']);
    exit;
}

// Monta a consulta com filtro opcional
$sql = "SELECT protocolo, ip_origem, ip_destino, info, tamanho
        FROM PACOTES
        WHERE id_captura = ?";
$params = [$idCaptura];
$tipos = "i";

if ($filtroProtocolo) {
    $sql .= " AND protocolo = ?";
    $params[] = $filtroProtocolo;
    $tipos .= "s";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param($tipos, ...$params);
$stmt->execute();
$resultado = $stmt->get_result();

$relatorio = [];

while ($linha = $resultado->fetch_assoc()) {
    $relatorio[] = $linha;
}

echo json_encode([
    'status' => 'ok',
    'dados' => $relatorio
]);
