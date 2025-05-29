<?php
include 'db.php';

$result = $conn->query("SELECT * FROM PACOTES");
$pacotes = [];

while ($row = $result->fetch_assoc()) {
    $pacotes[] = $row;
}

echo json_encode($pacotes);
?>
