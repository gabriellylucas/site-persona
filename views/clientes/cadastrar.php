<?php include __DIR__ . '/../admin/navbar_admin.php'; ?>

<h1>Cadastrar Cliente</h1>
<form method="post">
  Nome: <input type="text" name="nome" required><br>
  Email: <input type="email" name="email" required><br>
  <button type="submit">Salvar</button>
</form>

<?php include __DIR__ . '/../admin/footer_admin.php'; ?>
