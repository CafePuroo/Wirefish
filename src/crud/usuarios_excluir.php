<?php
include 'db.php';

$id = $_POST['id_usuario'];

$stmt = $conn->prepare("DELETE FROM USUARIOS WHERE id_usuario = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode(["status" => "ok"]);
?>
