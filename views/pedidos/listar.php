<?php include __DIR__ . '/../admin/navbar_admin.php'; ?>

<link rel="stylesheet" href="admin.css">

<div class="page-pedidos">
  <div class="main-container">
    <div class="card">
      <div class="card-header">
        <h2>Orders</h2>
        <div class="search-box">
          <input type="text" placeholder="Pesquisar...">
          <a class="btn-new" href="index.php?page=pedidos_cadastrar">Novo Pedido</a>
        </div>
      </div>

      <div class="summary">
        <h3>Summary</h3>
        <div class="big-number"><?= count($pedidos) ?></div>
        <p>Total Orders</p>
      </div>

      <table class="orders-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pedidos as $p): ?>
            <tr>
              <td><span class="highlight"><?= str_pad($p['id'], 3, "0", STR_PAD_LEFT) ?></span></td>
              <td><?= htmlspecialchars($p['cliente_nome'] ?? 'N/A') ?></td>
              <td>R$ <?= number_format($p['total'], 2, ',', '.') ?></td>
              <td>
                <a class="btn-delete" href="index.php?page=pedidos_excluir&id=<?= $p['id'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../admin/footer_admin.php'; ?>