<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: ../index.php?page=login");
    exit;
}
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Painel do Admin</title>
</head>
<body>
  <h1>Bem-vinda, Admin <?php echo htmlspecialchars($_SESSION['nome']); ?>!</h1>
  <p>Esta é a área administrativa de teste.</p>
  <p><a href="../index.php?page=sair">Sair</a></p>
</body>
</html>
