<?php
$host = "localhost";     // ou 127.0.0.1
$usuario = "root";       // substitua se necessário
$senha = "";             // senha do banco
$banco = "wirefish";     // nome do banco de dados

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
  die("Falha na conexão: " . $conn->connect_error);
}
?>
