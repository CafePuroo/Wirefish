<?php
include 'db.php';
$id = $_POST['id'];
$stmt = $conn->prepare("DELETE FROM pacotes WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
echo json_encode(["status" => "ok"]);
?>