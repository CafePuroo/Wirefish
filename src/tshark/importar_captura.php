<?php
require_once '../conexao.php';

// Espera o nome do arquivo e o ID da captura
$nomeArquivo = $_GET['arquivo'] ?? '';
$idCaptura = $_GET['id_captura'] ?? '';

if (empty($nomeArquivo) || empty($idCaptura)) {
    echo json_encode(['erro' => 'Parâmetros ausentes']);
    exit;
}

$caminho = "../../output/" . basename($nomeArquivo);

if (!file_exists($caminho)) {
    echo json_encode(['erro' => 'Arquivo não encontrado']);
    exit;
}

// Lê o conteúdo JSON
$jsonData = file_get_contents($caminho);
$pacotes = json_decode($jsonData, true);

// Insere cada pacote no banco
$sql = "INSERT INTO PACOTES (id_captura, protocolo, ip_origem, ip_destino, info, tamanho)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

$contador = 0;
foreach ($pacotes as $pacote) {
    $protocolo = $pacote['protocol'] ?? 'desconhecido';
    $ip_origem = $pacote['source'] ?? 'N/D';
    $ip_destino = $pacote['destination'] ?? 'N/D';
    $info = $pacote['info'] ?? '';
    $tamanho = $pacote['length'] ?? 0;

    $stmt->bind_param("issssi", $idCaptura, $protocolo, $ip_origem, $ip_destino, $info, $tamanho);
    $stmt->execute();
    $contador++;
}

$stmt->close();

echo json_encode([
    'status' => 'ok',
    'mensagem' => "Importação concluída com $contador pacotes."
]);
