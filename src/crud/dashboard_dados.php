<?php
header('Content-Type: application/json; charset=utf-8');
include 'db.php';

// Consulta: quantidade de pacotes por protocolo
$protocolos = [];
$query1 = "SELECT protocolo, COUNT(*) AS total FROM PACOTES GROUP BY protocolo";
$result1 = $conn->query($query1);

while ($row = $result1->fetch_assoc()) {
    $protocolos[$row['protocolo']] = (int)$row['total'];
}

// Consulta: quantidade de pacotes por IP de origem
$src_ips = [];
$query2 = "SELECT src_ip, COUNT(*) AS total FROM PACOTES GROUP BY src_ip";
$result2 = $conn->query($query2);

while ($row = $result2->fetch_assoc()) {
    $src_ips[$row['src_ip']] = (int)$row['total'];
}

// Retorno em JSON
echo json_encode([
    'protocolos' => $protocolos,
    'src_ips' => $src_ips
