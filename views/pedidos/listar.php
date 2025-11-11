<?php 
include __DIR__ . '/../admin/navbar_admin.php'; 
include 'conexao.php'; 


$stmt = $pdo->query("
    SELECT pedidos.id, pedidos.cliente_id, pedidos.produto_nome, pedidos.data_pedido, pedidos.status,
           clientes.nome AS cliente_nome
    FROM pedidos
    LEFT JOIN clientes ON clientes.id = pedidos.cliente_id
    ORDER BY pedidos.data_pedido DESC
");
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="admin.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="page-pedidos">
  <div class="main-container">
    <div class="card">
      <div class="card-header">
        <h2>Pedidos</h2>
        <div class="search-box">
          <input type="text" placeholder="Pesquisar...">
          <a class="btn-new" href="index.php?page=pedidos_cadastrar">Novo Pedido</a>
        </div>
      </div>

      <table class="orders-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Produto</th>
            <th>Data</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pedidos as $p): ?>
            <tr id="pedido-<?= $p['id'] ?>">
              <td><?= str_pad($p['id'], 3, "0", STR_PAD_LEFT) ?></td>
              <td><?= htmlspecialchars($p['cliente_nome'] ?? 'N/A') ?></td>
              <td>
                <?= htmlspecialchars($p['produto_nome'] ?? '-') ?>
              </td>
              <td><?= date('d/m/Y H:i', strtotime($p['data_pedido'])) ?></td>
              <td class="text-center actions">
              <div class="action-buttons">
    <a href="index.php?page=pedidos_editar&id=<?= $p['id'] ?>" title="Editar">
       <i class="fa-solid fa-pen-to-square" style="color:pink;"></i>
    </a>

    <a href="index.php?page=pedidos_excluir&id=<?= $p['id'] ?>" title="Excluir">
        <i class="fa-solid fa-xmark" style="color:red;"></i>
    </a>
</div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../admin/footer_admin.php'; ?>
