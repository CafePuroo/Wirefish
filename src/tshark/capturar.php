<?php
require_once '../crud/conexao.php';
require_once 'config.php';
require_once 'funcoes.php';

$comando = construirComandoTshark($interfacePadrao, $limitePacotes, $tsharkPath);
$saida = shell_exec($comando);

$pacotes = parsearSaidaTshark($saida);

foreach ($pacotes as $pacote) {
    $sql = "INSERT INTO pacotes (src_ip, dest_ip, protocolo, tamanho)
            VALUES (:src_ip, :dest_ip, :protocolo, :tamanho)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':src_ip' => $pacote['src_ip'],
        ':dest_ip' => $pacote['dest_ip'],
        ':protocolo' => $pacote['protocolo'],
        ':tamanho' => $pacote['tamanho']
    ]);
}

echo json_encode(['status' => 'sucesso', 'pacotes_inseridos' => count($pacotes)]);
?>
