<?php
include 'db.php';

$result = $conn->query("SELECT id_usuario, nome, email FROM USUARIOS");
$usuarios = [];

while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
}

echo json_encode($usuarios);
?>
