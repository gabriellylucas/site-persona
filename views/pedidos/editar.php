<?php
include __DIR__ . '/../admin/navbar_admin.php';
include 'conexao.php';

if(!isset($_GET['id'])){
    echo "ID não informado!";
    exit;
}

$id = $_GET['id'];

// pega dados do pedido
$stmt = $pdo->prepare("SELECT * FROM pedidos WHERE id = ?");
$stmt->execute([$id]);
$pedido = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$pedido){
    echo "Pedido não encontrado!";
    exit;
}

// quando enviar o form
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $produto_nome = $_POST['produto_nome'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE pedidos SET produto_nome=?, status=? WHERE id=?");
    $stmt->execute([$produto_nome, $status, $id]);

    echo "<script>alert('Pedido atualizado com sucesso!');</script>";
    echo "<script>location.href='index.php?page=pedidos';</script>";
}
?>

<link rel="stylesheet" href="admin.css">

<div class="page-pedidos">
  <div class="main-container form-container">

    <div class="card">
      <div class="card-header">
        <h2>Editar Pedido</h2>
      </div>

      <form method="POST">

        <div class="mb-3">
          <label>Produto:</label>
          <input type="text" class="form-control" name="produto_nome" value="<?= htmlspecialchars($pedido['produto_nome']) ?>" required>
        </div>

        <div class="mb-3">
          <label>Status:</label>
          <select class="form-select" name="status" required>
            <option value="Pendente"   <?= ($pedido['status']=="Pendente")   ? "selected" : "" ?>>Pendente</option>
            <option value="Finalizado" <?= ($pedido['status']=="Finalizado") ? "selected" : "" ?>>Finalizado</option>
            <option value="Cancelado"  <?= ($pedido['status']=="Cancelado")  ? "selected" : "" ?>>Cancelado</option>
          </select>
        </div>

        <button type="submit" class="btn-new">Salvar Alterações</button>
        <a href="index.php?page=pedidos" class="btn-cancel">Cancelar</a>

      </form>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../admin/footer_admin.php'; ?>
