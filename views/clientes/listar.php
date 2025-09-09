<?php include __DIR__ . '/../admin/navbar_admin.php'; ?>

<div class="container mt-4">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Clientes</h1>
    <a href="index.php?page=clientes_cadastrar" class="btn btn-success">
      + Novo Cliente
    </a>
  </div>

 
  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle shadow-sm">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nome</th>
          <th scope="col">Email</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($clientes)): ?>
          <?php foreach ($clientes as $c): ?>
            <tr>
              <td><?= $c['id'] ?></td>
              <td><?= htmlspecialchars($c['nome']) ?></td>
              <td><?= htmlspecialchars($c['email']) ?></td>
              <td>
                <a href="index.php?page=clientes_editar&id=<?= $c['id'] ?>" 
                   class="btn btn-sm btn-primary">
                   Editar
                </a>
                <a href="index.php?page=clientes_excluir&id=<?= $c['id'] ?>" 
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Tem certeza que deseja excluir este cliente?')">
                   Excluir
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="text-center text-muted">
              Nenhum cliente cadastrado
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include __DIR__ . '/../admin/footer_admin.php'; ?>
