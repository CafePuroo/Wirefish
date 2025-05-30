<?php
header('Content-Type: application/json; charset=utf-8');
include 'db.php';

$action = $_POST['action'] ?? $_GET['action'] ?? 'listar';

if ($action === 'adicionar') {
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

    $stmt = $conn->prepare("INSERT INTO USUARIOS (nome, email, senha_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senha_hash);
    $stmt->execute();

    echo json_encode(["status" => "ok"]);
}

elseif ($action === 'listar') {
    $result = $conn->query("SELECT id_usuario, nome, email FROM USUARIOS");
    $usuarios = [];

    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }

    echo json_encode($usuarios);
}

elseif ($action === 'excluir') {
    $id = $_POST['id_usuario'];

    $stmt = $conn->prepare("DELETE FROM USUARIOS WHERE id_usuario = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo json_encode(["status" => "ok"]);
}

else {
    echo json_encode(["status" => "erro", "mensagem" => "Ação inválida"]);
}
?>
