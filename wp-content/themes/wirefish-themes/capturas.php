<?php
/* Template Name: Dashboard Capturas */
require_once(ABSPATH . 'wp-load.php');
require_once(ABSPATH . 'wp-blog-header.php');

// Conexão com banco do XAMPP
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "nome_do_banco"; // Substitua pelo nome real
$conexao = new mysqli($host, $usuario, $senha, $banco);
if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}
$sql = "SELECT src_ip, dest_ip, protocolo, tamanho FROM PACOTES ORDER BY id DESC LIMIT 50";
$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pacotes Capturados</title>
  <style>
    body { font-family: Arial; padding: 20px; }
    table { border-collapse: collapse; width: 100%; }
    th, td { padding: 8px; border: 1px solid #ccc; text-align: center; }
    th { background: #f4f4f4; }
  </style>
</head>
<body>
  <h1>Pacotes Capturados</h1>
  <table>
    <thead>
      <tr>
        <th>IP Origem</th>
        <th>IP Destino</th>
        <th>Protocolo</th>
        <th>Tamanho</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($linha = $resultado->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($linha['src_ip']) ?></td>
          <td><?= htmlspecialchars($linha['dest_ip']) ?></td>
          <td><?= htmlspecialchars($linha['protocolo']) ?></td>
          <td><?= htmlspecialchars($linha['tamanho']) ?> bytes</td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>

<?php $conexao->close(); ?>
