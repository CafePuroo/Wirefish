<?php
require_once '../conexao.php'; // ajuste se estiver em outro caminho

// Verifica se os dados vieram via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $interface = $_POST['interface'] ?? '';
    $filtro = $_POST['filtro'] ?? '';
    $usuario = $_POST['usuario'] ?? 'desconhecido';

    if (empty($interface)) {
        echo json_encode(['erro' => 'Interface de rede não especificada']);
        exit;
    }

    // Gera nome do arquivo de captura e caminho de saída
    $timestamp = date('Ymd_His');
    $nome_arquivo = "captura_{$timestamp}.json";
    $output_path = "../../output/{$nome_arquivo}";

    // Cria pasta se não existir
    if (!file_exists('../../output')) {
        mkdir('../../output', 0777, true);
    }

    // Monta comando de execução
    $cmd = escapeshellcmd("bash ../../resources/capturar.sh '$interface' \"$filtro\" '$output_path'");

    // Executa o shell script
    $saida = shell_exec($cmd);

    // Insere na tabela CAPTURA
    $sql = "INSERT INTO CAPTURA (usuario, data_hora_inicio, interface, filtro_usado, arquivo_saida)
            VALUES (?, NOW(), ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $usuario, $interface, $filtro, $nome_arquivo);
    $stmt->execute();
    $idCaptura = $stmt->insert_id;
    $stmt->close();

    echo json_encode([
        'status' => 'ok',
        'mensagem' => 'Captura iniciada com sucesso',
        'arquivo_saida' => $nome_arquivo,
        'id_captura' => $idCaptura,
        'saida_tshark' => $saida
    ]);
} else {
    echo json_encode(['erro' => 'Requisição inválida']);
}
