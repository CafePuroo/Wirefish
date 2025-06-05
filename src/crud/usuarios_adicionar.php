<?php
include 'db.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$senha_hash = hash('sha256', $senha);

// Verifica se o email já existe
$check = $conn->prepare("SELECT id_usuario FROM USUARIOS WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo json_encode(["status" => "erro", "mensagem" => "Email já cadastrado"]);
    exit;
}

// Insere novo usuário
$stmt = $conn->prepare("INSERT INTO USUARIOS (nome, email, senha_hash) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $email, $senha_hash);
$stmt->execute();

echo json_encode(["status" => "ok"]);
?>
