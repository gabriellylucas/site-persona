<?php include __DIR__ . '/../admin/navbar_admin.php'; ?>
<link rel="stylesheet" href="admin.css">

<body class="page-edit-client">

<div class="edit-container">

<h1>Editar Cliente</h1>

<form method="post">
  
  <div class="form-group">
      <label>Nome:</label>
      <input type="text" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required>
  </div>

  <div class="form-group">
      <label>Email:</label>
      <input type="email" name="email" value="<?= htmlspecialchars($cliente['email']) ?>" required>
  </div>

  <button type="submit" class="btn-submit">Atualizar</button>

</form>

</div>

<?php include __DIR__ . '/../admin/footer_admin.php'; ?>
