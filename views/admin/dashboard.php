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
   <link rel="stylesheet" href="admin.css">
</head>
<body>

<nav class="admin-navbar">
  <div class="admin-container">
    <h2>Lia: Bolos e Cia - Admin</h2>
    <ul class="admin-menu">
      <li><a href="index.php?page=clientes_listar">Clientes</a></li>
      <li><a href="index.php?page=produtos_listar">Produtos</a></li>
      <li><a href="index.php?page=pedidos_listar">Pedidos</a></li>
      <li><a href="index.php?page=pedido_itens_listar">Itens do Pedido</a></li>
    </ul>
  </div>
</nav>

<div class="container">
  <h1>Bem-vinda, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</h1>
  <p>Esta é a área administrativa do site Lia:Bolos e Cia </p>

  <p><a href="views/admin/index.php?page=produtos_cadastrar">Adicionar Novo Produto</a></p>
  <p><a href="admin_produtos.php">Listar Produtos</a></p>
  <p><a href="index.php?page=admin_categorias_list">Gerenciar Categorias</a></p>
  <p><a href="../index.php?page=sair">Sair</a></p>
</div>

<footer class="admin-footer">
  <div class="admin-footer-container">
    <p>&copy; 2025 Lia: Bolos e Cia - Área Administrativa. Todos os direitos reservados.</p>
  </div>
</footer>

</body>
</html>
