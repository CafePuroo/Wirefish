<?php
include 'db.php';
$id = $_POST['id'];
$src = $_POST['src_ip'];
$dest = $_POST['dest_ip'];
$protocolo = $_POST['protocolo'];
$tamanho = $_POST['tamanho'];
$stmt = $conn->prepare("UPDATE pacotes SET src_ip=?, dest_ip=?, protocolo=?, tamanho=? WHERE id=?");
$stmt->bind_param("sssii", $src, $dest, $protocolo, $tamanho, $id);
$stmt->execute();
echo json_encode(["status" => "ok"]);
?>