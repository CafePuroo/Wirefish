<?php
include 'db.php';
$src = $_POST['src_ip'];
$dest = $_POST['dest_ip'];
$protocolo = $_POST['protocolo'];
$tamanho = $_POST['tamanho'];
$stmt = $conn->prepare("INSERT INTO pacotes (src_ip, dest_ip, protocolo, tamanho) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $src, $dest, $protocolo, $tamanho);
$stmt->execute();
echo json_encode(["status" => "ok"]);
?>