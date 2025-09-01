<h1>Editar Cliente</h1>
<form method="post">
  Nome: <input type="text" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required><br>
  Email: <input type="email" name="email" value="<?= htmlspecialchars($cliente['email']) ?>" required><br>
  <button type="submit">Atualizar</button>
</form>
