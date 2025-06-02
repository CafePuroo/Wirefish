<?php
require_once '../crud/conexao.php';

// Define interface e duração
$interface = isset($_GET['interface']) ? $_GET['interface'] : 'eth0';
$duracao = isset($_GET['duracao']) ? intval($_GET['duracao']) : 10;

// Caminho do script
$script = realpath('../resources/capturar.sh');

// Executa o shell script e coleta a saída
$comando = escapeshellcmd("bash $script $interface $duracao");
$output = shell_exec($comando);

if (!$output) {
    die("Falha na captura ou nenhuma saída gerada.");
}

// Divide linhas e processa
$linhas = explode("\n", trim($output));

foreach ($linhas as $linha) {
    // Remove aspas duplas e divide por vírgula
    $valores = str_getcsv($linha, ',', '"');
    if (count($valores) !== 4) continue;

    list($src_ip, $dest_ip, $protocolo, $tamanho) = $valores;

    // Insere no banco
    $stmt = $pdo->prepare("INSERT INTO PACOTES (src_ip, dest_ip, protocolo, tamanho) VALUES (?, ?, ?, ?)");
    $stmt->execute([$src_ip, $dest_ip, $protocolo, (int)$tamanho]);
}

echo "Captura finalizada e pacotes inseridos.";
?>
