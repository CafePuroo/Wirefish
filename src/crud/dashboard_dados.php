<?php
include 'db.php';

// Contagem por protocolo
$protocolos = [];
$result = $conn->query("SELECT protocolo, COUNT(*) as total FROM PACOTES GROUP BY protocolo");
while ($row = $result->fetch_assoc()) {
    $protocolos[$row['protocolo']] = (int)$row['total'];
}

// Contagem por IP de origem
$ips = [];
$result = $conn->query("SELECT src_ip, COUNT(*) as total FROM PACOTES GROUP BY src_ip");
while ($row = $result->fetch_assoc()) {
    $ips[$row['src_ip']] = (int)$row['total'];
}

echo json_encode([
    'protocolos' => $protocolos,
    'src_ips' => $ips
]);
?>
